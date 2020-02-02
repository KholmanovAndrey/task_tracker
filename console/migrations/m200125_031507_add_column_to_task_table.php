<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%task}}`.
 */
class m200125_031507_add_column_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%task}}', 'priority_id', 'integer');
        $this->addColumn('{{%task}}', 'is_template', 'boolean');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%task}}', 'priority_id');
        $this->dropColumn('{{%task}}', 'is_template');
    }
}
