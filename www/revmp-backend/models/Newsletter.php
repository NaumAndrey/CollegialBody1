<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "newsletter".
 *
 * @property int $id_newsletter
 * @property string $message_text
 * @property string $recipients
 * @property string $date_receiving
 * @property string $periodicity
 * @property string $data_time
 * @property string $card_documents
 * @property string $additional_documents
 * @property int $id_activity
 * @property int $id_orders
 *
 * @property Activity $activity
 * @property Orders $orders
 */
class Newsletter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'newsletter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message_text', 'recipients', 'periodicity', 'card_documents', 'additional_documents'], 'string'],
            [['date_receiving', 'data_time'], 'safe'],
            [['id_activity', 'id_orders'], 'default', 'value' => null],
            [['id_activity', 'id_orders'], 'integer'],
            [['id_activity'], 'exist', 'skipOnError' => true, 'targetClass' => Activity::className(), 'targetAttribute' => ['id_activity' => 'id_activity']],
            [['id_orders'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['id_orders' => 'id_orders']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_newsletter' => 'Id Newsletter',
            'message_text' => 'Message Text',
            'recipients' => 'Recipients',
            'date_receiving' => 'Date Receiving',
            'periodicity' => 'Periodicity',
            'data_time' => 'Data Time',
            'card_documents' => 'Card Documents',
            'additional_documents' => 'Additional Documents',
            'id_activity' => 'Id Activity',
            'id_orders' => 'Id Orders',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activity::className(), ['id_activity' => 'id_activity']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['id_orders' => 'id_orders']);
    }
}
