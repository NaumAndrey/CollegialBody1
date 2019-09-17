<?php

use yii\db\Migration;

/**
 * Class m190506_122309_func
 */
class m190506_122309_func extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable ('func', [
            'id_func'   => $this->primaryKey(),
            'authority' => $this->decimal(),
            'name'      => $this->text(),
            'id_kollegial' => $this->integer()
        ]);

        $this->createIndex(
            'idx-func-id_kollegial',
            'func',
            'id_kollegial'
        );

        $this->addForeignKey(
            'fk-func-id_kollegial',
            'func',
            'id_kollegial',
            'kollegial',
            'id_kollegial',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190506_122309_func cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190506_122309_func cannot be reverted.\n";

        return false;
    }
    */
}
