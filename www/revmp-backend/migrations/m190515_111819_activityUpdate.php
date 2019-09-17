<?php

use yii\db\Migration;

/**
 * Class m190515_111819_activityUpdate
 */
class m190515_111819_activityUpdate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('activity', 'start_date_and_time', $this->dateTime());
        $this->alterColumn('activity', 'end_date_and_time', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190515_111819_activityUpdate cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190515_111819_activityUpdate cannot be reverted.\n";

        return false;
    }
    */
}
