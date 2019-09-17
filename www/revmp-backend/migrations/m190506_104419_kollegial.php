<?php

use yii\db\Migration;

/**
 * Class m190506_104419_kollegial
 */
class m190506_104419_kollegial extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('type_collegial_department', [
           'id_type_collegial_department'  => $this->primaryKey(),
           'type_collegial_department'     => $this->text()

        ]);

        $this->createTable('iogv', [
            'id_iogv'  => $this->primaryKey(),
            'name'     => $this->text()

        ]);

        $this->createTable('kollegial', [
            'id_kollegial'           => $this->primaryKey(),
            'name_of_authority'      => $this->text(),
            'chairman'               => $this->text(),
            'secretary'              => $this->text(),
            'document'               => $this->text(),
            'dataDoc'                => $this->date(),
            'numberDoc'              => $this->integer(),
            'link'                   => $this->text(),
            'file'                   => $this->text(),
            'goal'                   => $this->text(),
            'activites'              => $this->text(),
            'id_iogv'                => $this->integer(),
            'id_type_collegial_department' => $this->integer()
        ]);

        $this->createIndex(
            'idx-type_collegial_department-id_type_collegial_department',
            'type_collegial_department',
            'id_type_collegial_department'
        );

        $this->addForeignKey(
            'fk-type_collegial_department-id_type_collegial_department',
            'kollegial',
            'id_type_collegial_department',
            'type_collegial_department',
            'id_type_collegial_department',
            'CASCADE'
        );

        $this->createIndex(
            'idx-iogv-id_iogv',
            'iogv',
            'id_iogv'
        );

        $this->addForeignKey(
            'fk-iogv-id_iogv',
            'kollegial',
            'id_iogv',
            'iogv',
            'id_iogv',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190506_104419_kollegial cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190506_104419_kollegial cannot be reverted.\n";

        return false;
    }
    */
}
