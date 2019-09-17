<?php

use yii\db\Migration;

/**
 * Class m190506_120312_orders
 */
class m190506_120312_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id_orders'             => $this->primaryKey(),
            'protocol_item_number'  => $this->text(),
            'data_protokol'         => $this->timestamp(),
            'description_order'     => $this->text(),
            'period_of_execution'   => $this->timestamp(),
            'responsible'           => $this->text(),
            'execution_of_instructions' => $this->text(),
            'file'                  => $this->text(),
            'id_kollegial'          => $this->integer()
        ]);

        $this->createIndex(
            'idx-orders-id_kollegial',
            'orders',
            'id_kollegial'
        );

        $this->addForeignKey(
            'fk-orders-id_kollegial',
            'orders',
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
        echo "m190506_120312_orders cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190506_120312_orders cannot be reverted.\n";

        return false;
    }
    */
}
