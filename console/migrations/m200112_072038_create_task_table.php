<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m200112_072038_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string(255)->notNull(),
            'started_at' => $this->timestamp()->defaultExpression("now()"),
            'finished_at' => $this->timestamp()->defaultExpression("now()"),
            'created_at' => $this->timestamp()->defaultExpression("now()"),
            'updated_at' => $this->timestamp()->defaultExpression("now()"),
            'content' => $this->text(),
            'cycle' => $this->boolean()->defaultValue(false),
            'main' => $this->boolean()->defaultValue(false),
        ]);

        $this->createIndex('task_user_index', '{{%task}}', 'user_id');
        $this->createIndex('task_at_index', '{{%task}}', ['created_at', 'started_at']);

        $this->addForeignKey(
            'task_user_foreign_key',
            '{{%task}}',
            'user_id',
            '{{%user}}',
            'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('task_user_foreign_key', '{{%task}}');
        $this->dropTable('{{%task}}');
    }
}
