<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id_orders
 * @property string $protocol_item_number
 * @property string $data_protokol
 * @property string $description_order
 * @property string $period_of_execution
 * @property string $responsible
 * @property string $execution_of_instructions
 * @property string $file
 * @property int $id_kollegial
 *
 * @property Newsletter[] $newsletters
 * @property Kollegial $kollegial
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['protocol_item_number', 'description_order', 'responsible', 'execution_of_instructions', 'file'], 'string'],
            [['data_protokol', 'period_of_execution'], 'safe'],
            [['id_kollegial'], 'default', 'value' => null],
            [['id_kollegial'], 'integer'],
            [['id_kollegial'], 'exist', 'skipOnError' => true, 'targetClass' => Kollegial::className(), 'targetAttribute' => ['id_kollegial' => 'id_kollegial']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_orders' => 'Id Orders',
            'protocol_item_number' => 'Protocol Item Number',
            'data_protokol' => 'Data Protokol',
            'description_order' => 'Description Order',
            'period_of_execution' => 'Period Of Execution',
            'responsible' => 'Responsible',
            'execution_of_instructions' => 'Execution Of Instructions',
            'file' => 'File',
            'id_kollegial' => 'Id Kollegial',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsletters()
    {
        return $this->hasMany(Newsletter::className(), ['id_orders' => 'id_orders']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKollegial()
    {
        return $this->hasOne(Kollegial::className(), ['id_kollegial' => 'id_kollegial']);
    }
}
