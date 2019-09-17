<?php

use yii\db\Migration;

/**
 * Class m180329_080610_set_db_date_format
 */
class m180329_080610_set_db_date_format extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $dbName = substr(Yii::$app->db->dsn, strpos(Yii::$app->db->dsn, ';dbname=') + 8);
        if (isset($dbName)) {
            $this->execute("ALTER DATABASE {$dbName} SET DATESTYLE TO 'German, dmy';");
        } else {
            throw new ErrorException('Не удалось выбрать имя бд?');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180329_080610_set_db_date_format cannot be reverted.\n";

        return false;
    }
}
