<?php

use yii\db\Migration;

/**
 * Class m190506_120812_authority
 */
class m190506_120812_authority extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('authority', [
            'id_authority' => $this->primaryKey(),
            'authority'    => $this->text(),
            'name'         => $this->text(),
            'id_kollegial' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-authority-id_kollegial',
            'authority',
            'id_kollegial'
        );

        $this->addForeignKey(
            'fk-authority-id_kollegial',
            'authority',
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
        echo "m190506_120812_authority cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190506_120812_authority cannot be reverted.\n";

        return false;
    }
    */
}
