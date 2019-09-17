<?php

use yii\db\Migration;

/**
 * Class m190506_111652_kollegial_members
 */
class m190506_111652_kollegial_members extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('kollegial_members', [
            'id_kollegial'      => $this->integer(),
            'id_members'        => $this->integer(),
            'PRIMARY KEY(id_kollegial, id_members)'
        ]);

        $this->createIndex(
            'idx-kollegial_members-id_kollegial',
            'kollegial_members',
            'id_kollegial'
        );

        $this->addForeignKey(
            'fk-kollegial_members-id_kollegial',
            'kollegial_members',
            'id_kollegial',
            'kollegial',
            'id_kollegial',
            'CASCADE'
        );

        $this->createIndex(
            'idx-kollegial_members-id_members',
            'kollegial_members',
            'id_members'
        );

        $this->addForeignKey(
            'fk-kollegial_members-id_members',
            'kollegial_members',
            'id_members',
            'members',
            'id_members',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190506_111652_kollegial_members cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190506_111652_kollegial_members cannot be reverted.\n";

        return false;
    }
    */
}
