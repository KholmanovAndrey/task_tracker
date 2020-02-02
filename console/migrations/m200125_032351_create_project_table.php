<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m200125_032351_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'creator_id' => $this->integer(),
            'name' => $this->string(255)->notNull(),
            'content' => $this->text(),
            'priority_id' => $this->tinyInteger(),
            'status' => $this->tinyInteger(),
            'started_at' => $this->bigInteger(),
            'finished_at' => $this->bigInteger(),
            'created_at' => $this->bigInteger(),
            'updated_at' => $this->bigInteger(),
        ]);

        $this->addColumn('{{%task}}', 'project_id', 'integer');
        $this->addForeignKey(
            'fk-task-project_id',
            '{{%task}}',
            'project_id',
            '{{%project}}',
            'id'
        );
        $this->addForeignKey(
            'fk-project-creator_id',
            '{{%project}}',
            'creator_id',
            '{{%user}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-project-creator_id', '{{%project}}');
        $this->dropForeignKey('fk-task-project_id', '{{%task}}');
        $this->dropTable('{{%project}}');
        $this->dropColumn('{{%task}}', 'project_id');
    }
}
