<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "priority".
 *
 * @property int $id
 * @property string $name
 * @property int|null $order
 * @property int|null $type
 */
class Priority extends \yii\db\ActiveRecord
{
    const TYPE_PROJECT = 1;
    const TYPE_TASK = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'priority';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['order', 'type'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'order' => 'Order',
            'type' => 'Type',
        ];
    }
}
