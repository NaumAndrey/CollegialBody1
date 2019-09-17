<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id_activity
 * @property string $event_name
 * @property string $location
 * @property int $start_date_and_time
 * @property int $end_date_and_time
 * @property string $event_agenda
 * @property string $chairman_event
 * @property string $event_secretary
 * @property int $id_kollegial
 *
 * @property Kollegial $kollegial
 * @property Agenda[] $agendas
 * @property Newsletter[] $newsletters
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_name', 'location', 'event_agenda', 'chairman_event', 'event_secretary'], 'string'],
            [['start_date_and_time', 'end_date_and_time', 'id_kollegial'], 'default', 'value' => null],
            [['start_date_and_time', 'end_date_and_time', 'id_kollegial'], 'integer'],
            [['id_kollegial'], 'exist', 'skipOnError' => true, 'targetClass' => Kollegial::className(), 'targetAttribute' => ['id_kollegial' => 'id_kollegial']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_activity' => 'Id Activity',
            'event_name' => 'Event Name',
            'location' => 'Location',
            'start_date_and_time' => 'Start Date And Time',
            'end_date_and_time' => 'End Date And Time',
            'event_agenda' => 'Event Agenda',
            'chairman_event' => 'Chairman Event',
            'event_secretary' => 'Event Secretary',
            'id_kollegial' => 'Id Kollegial'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKollegial()
    {
        return $this->hasOne(Kollegial::className(), ['id_kollegial' => 'id_kollegial']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendas()
    {
        return $this->hasMany(Agenda::className(), ['id_activity' => 'id_activity']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsletters()
    {
        return $this->hasMany(Newsletter::className(), ['id_activity' => 'id_activity']);
    }
}
