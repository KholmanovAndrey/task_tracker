<?php

namespace common\models;

use frontend\models\ChatLog;
use frontend\widgets\chat\Chat;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property int|null $executor_id
 * @property string $name
 * @property string|null $content
 * @property int|null $status
 * @property int|null $started_at
 * @property int|null $finished_at
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $priority_id
 * @property int|null $is_template
 * @property int|null $project_id
 *
 * @property Project $project
 * @property User $creator
 * @property User $executor
 */
class Task extends \yii\db\ActiveRecord implements Linkable
{
    const STATUS_NEW = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_DONE = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    public function behaviors()
    {
        return [TimestampBehavior::class => ['class' => TimestampBehavior::class]];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'executor_id', 'status', 'started_at', 'finished_at', 'created_at', 'updated_at', 'priority_id', 'is_template', 'project_id'], 'integer'],
            [['name'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => false, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['executor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creator_id' => 'Creator ID',
            'executor_id' => 'Executor ID',
            'name' => 'Name',
            'content' => 'Content',
            'status' => 'Status',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'priority_id' => 'Priority ID',
            'is_template' => 'Is Template',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
    }

    public static function getStatusName()
    {
        return [
            static::STATUS_NEW => 'Новый',
            static::STATUS_IN_PROGRESS => 'В работе',
            static::STATUS_DONE => 'Завершено',
        ];
    }

    public function afterSave($insert, $changedAttribute)
    {
        if ($insert) {
            ChatLog::create([
                'username' => Yii::$app->user->identity->username,
                'message' => 'Новая задача ' . $this->name . ' #' . $this->id,
                'type' => 2,
                'task_id' => $this->id,
                'project_id' => null
            ]);
        } else { // update
            ChatLog::create([
                'username' => Yii::$app->user->identity->username,
                'message' => 'Обновлена задача ' . $this->name . ' #' . $this->id,
                'type' => 2,
                'task_id' => $this->id,
                'project_id' => null
            ]);
        }
    }

    public function fields()
    {
        return array_merge(parent::fields(),[
            'id_clone' => function () {
                return $this->id;
            },

        ]);
    }

    public function extraFields()
    {
        return [
            'author',
            'authorEmail' => function () {
                return $this->creator->email;
            },

        ];
    }

    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['task/view', 'id' => $this->id]),
            'authorEmailLink' => Url::to(['user/view', 'id'=>$this->creator_id])
        ];
    }
}
