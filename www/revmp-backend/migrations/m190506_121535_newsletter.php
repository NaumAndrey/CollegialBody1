<?php

use yii\db\Migration;

/**
 * Class m190506_121535_newsletter
 */
class m190506_121535_newsletter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable ('newsletter', [
            'id_newsletter'   => $this->primaryKey(),
            'message_text'    => $this->text(),
            'recipients'      => $this->text(),
            'date_receiving'  => $this->timestamp(),
            'periodicity'     => $this->text(),
            'data_time'       => $this->timestamp(),
            'card_documents'  => $this->text(),
            'additional_documents' => $this->text(),
            'id_activity' => $this->integer(),
            'id_orders'   => $this->integer()
        ]);

        $this->createIndex(
            'idx-newsletter-id_activity',
            'newsletter',
            'id_activity'
        );

        $this->addForeignKey(
            'fk-activity-id_activity',
            'newsletter',
            'id_activity',
            'activity',
            'id_activity',
            'CASCADE'
        );

        $this->createIndex(
            'idx-newsletter-id_orders',
            'newsletter',
            'id_orders'
        );

        $this->addForeignKey(
            'fk-activity-id_orders',
            'newsletter',
            'id_orders',
            'orders',
            'id_orders',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190506_121535_newsletter cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190506_121535_newsletter cannot be reverted.\n";

        return false;
    }
    */
}
