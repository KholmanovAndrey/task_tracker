<?php

namespace common\models;

use frontend\models\ChatLog;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property string $name
 * @property string|null $content
 * @property int|null $priority_id
 * @property int|null $status
 * @property int|null $started_at
 * @property int|null $finished_at
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $creator
 * @property Task[] $tasks
 */
class Project extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_DONE = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
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
            [['parent_id', 'creator_id', 'priority_id', 'status', 'started_at', 'finished_at', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent',
            'creator_id' => 'Creator ID',
            'name' => 'Name',
            'content' => 'Content',
            'priority_id' => 'Priority ID',
            'status' => 'Status',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Project::className(), ['id' => 'parent_id']);
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
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['project_id' => 'id']);
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
                'message' => 'Новый проект ' . $this->name . ' #' . $this->id,
                'type' => 2,
                'task_id' => null,
                'project_id' => $this->id
            ]);
        } else { // update
            ChatLog::create([
                'username' => Yii::$app->user->identity->username,
                'message' => 'Обновлен проект ' . $this->name . ' #' . $this->id,
                'type' => 2,
                'task_id' => null,
                'project_id' => $this->id
            ]);
        }
    }
}
