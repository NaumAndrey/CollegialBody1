<?php

use yii\db\Migration;

/**
 * Handles the creation of table `toris_user`.
 */
class m180417_062020_create_toris_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('toris_user', [
            'id' => $this->primaryKey(),
            'ebosp_id' => $this->integer()->notNull()->comment('ИОГВ'),
            'esov_uid' => $this->string()->comment('ЕСОВ ID'),
            'fio' => $this->string()->null()->comment('ФИО'),
            'aistoken' => $this->text()->notNull()->comment('aistoken'),
            'email' => $this->text()->comment('E-mail'),
            'is_http' => $this->boolean()->notNull()->defaultValue(false),
            'updated_at' => $this->timestamp()->notNull()->defaultValue('NOW()'),
        ]);

        // creates index for column `ebosp_id`
        $this->createIndex(
            'idx-toris_user-ebosp_id',
            'toris_user',
            'ebosp_id'
        );

        // add foreign key for table `ebosp`
        $this->addForeignKey(
            'fk-toris_user-ebosp_id',
            'toris_user',
            'ebosp_id',
            'ebosp',
            'id',
            'CASCADE'
        );

        // create function for trigger
        $this->execute('CREATE OR REPLACE FUNCTION trigger_set_timestamp()
RETURNS TRIGGER AS $$
BEGIN
  NEW.updated_at = NOW();
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;');

        // create trigger
        $this->execute('CREATE TRIGGER set_updated_at_trigger
BEFORE UPDATE ON toris_user
FOR EACH ROW
EXECUTE PROCEDURE trigger_set_timestamp();');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->execute('drop trigger set_updated_at_trigger on toris_user;');
        $this->dropTable('toris_user');
    }
}
