<?php

use yii\db\Migration;

/**
 * Class m190506_112841_activity
 */
class m190506_112841_activity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity', [
            'id_activity'         => $this->primaryKey(),
            'event_name'          => $this->text(),
            'location'            => $this->text(),
            'start_date_and_time' => $this->dateTime(),
            'end_date_and_time'   => $this->dateTime(),
            'event_agenda'        => $this->text(),
            'chairman_event'      => $this->text(),
            'event_secretary'     => $this->text(),
            'id_kollegial'        => $this->integer()
        ]);

        $this->createIndex(
            'idx-activity-id_kollegial',
            'activity',
            'id_kollegial'
        );

        $this->addForeignKey(
            'fk-activity-id_kollegial',
            'activity',
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
        echo "m190506_112841_activity cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190506_112841_activity cannot be reverted.\n";

        return false;
    }
    */
}
