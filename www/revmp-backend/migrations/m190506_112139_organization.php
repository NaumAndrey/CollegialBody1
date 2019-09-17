<?php

use yii\db\Migration;

/**
 * Class m190506_112139_organization
 */
class m190506_112139_organization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('organization', [
            'id_organization'        => $this->primaryKey(),
            'full_name_organization' => $this->text(),
            'name'                   => $this->text(),
            'inn'                    => $this->integer(),
            'ogrn'                   => $this->integer(),
            'phone_organization'     => $this->text(),
            'email_organization'     => $this->text(),
            'fio_leader'             => $this->text(),
            'phone_leader'           => $this->text(),
            'email_organization_leader' => $this->text(),
            'id_kollegial'  => $this->integer()
        ]);

        $this->createIndex(
            'idx-organization-id_kollegial',
            'organization',
            'id_kollegial'
        );

        $this->addForeignKey(
            'fk-organization-id_kollegial',
            'organization',
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
        echo "m190506_112139_organization cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190506_112139_organization cannot be reverted.\n";

        return false;
    }
    */
}
