<?php

use yii\db\Migration;

/**
 * Class m190506_121056_agenda
 */
class m190506_121056_agenda extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('agenda', [
            'id_agenda' => $this->primaryKey(),
            'name'      => $this->text(),
            'listeners' => $this->text(),
            'decided'   => $this->text(),
            'term'      => $this->timestamp(),
            'responsible'  => $this->text(),
            'id_activity'  => $this->integer()
        ]);

        $this->createIndex(
            'idx-agenda-id_activity',
            'agenda',
            'id_activity'
        );

        $this->addForeignKey(
            'fk-agenda-id_activity',
            'agenda',
            'id_activity',
            'activity',
            'id_activity',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190506_121056_agenda cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190506_121056_agenda cannot be reverted.\n";

        return false;
    }
    */
}
