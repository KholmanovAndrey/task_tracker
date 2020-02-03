<?php

use yii\db\Migration;

/**
 * Class m200126_033027_add_column_parent_id_to_project
 */
class m200126_033027_add_column_parent_id_to_project extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%project}}', 'parent_id', 'integer');
        $this->addForeignKey(
            'fk-project-parent_id',
            '{{%project}}',
            'parent_id',
            '{{%project}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-project-parent_id', '{{%project}}');
        $this->dropColumn('{{%project}}', 'parent_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200126_033027_add_column_parent_id_to_project cannot be reverted.\n";

        return false;
    }
    */
}
