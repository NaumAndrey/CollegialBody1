<?php

use yii\db\Migration;

/**
 * Class m190506_111549_members
 */
class m190506_111549_members extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('members', [
            'id_members'    => $this->primaryKey(),
            'surname'       => $this->text(),
            'name'          => $this->text(),
            'patronymic'    => $this->text(),
            'position'      => $this->text(),
            'organization'  => $this->text(),
            'phone'         => $this->text(),
            'email'         => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190506_111549_members cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190506_111549_members cannot be reverted.\n";

        return false;
    }
    */
}
