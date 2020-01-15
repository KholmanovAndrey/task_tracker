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
            'creator_id' => $this->integer(),
            'executor_id' => $this->integer(),
            'name' => $this->string(255)->notNull(),
            'content' => $this->text(),
            'status' => $this->tinyInteger(),
            'started_at' => $this->bigInteger(),
            'finished_at' => $this->bigInteger(),
            'created_at' => $this->bigInteger(),
            'updated_at' => $this->bigInteger(),
        ]);

        $this->createIndex('task_creator_index', '{{%task}}', 'creator_id');
        $this->createIndex('task_executor_index', '{{%task}}', 'executor_id');
        $this->createIndex('task_at_index', '{{%task}}', ['created_at', 'started_at']);

        $this->addForeignKey(
            'task_creator_id_foreign_key',
            '{{%task}}',
            'creator_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'task_executor_id_foreign_key',
            '{{%task}}',
            'executor_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
    }
}
