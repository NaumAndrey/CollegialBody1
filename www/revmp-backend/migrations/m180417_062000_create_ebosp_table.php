<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ebosp`.
 */
class m180417_062000_create_ebosp_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ebosp', [
            'id' => $this->primaryKey(),
            'ebosp_name' => $this->text()->notNull()->comment('Полное наименование'),
            'short_name' => $this->text()->comment('Сокращённое наименование'),
            'code' => $this->text()->notNull()->comment('Код ЕСОВ'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ebosp');
    }
}
