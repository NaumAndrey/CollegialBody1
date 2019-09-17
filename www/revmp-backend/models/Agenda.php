<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agenda".
 *
 * @property int $id_agenda
 * @property string $name
 * @property string $listeners
 * @property string $decided
 * @property string $term
 * @property string $responsible
 * @property int $id_activity
 *
 * @property Activity $activity
 */
class Agenda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agenda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'listeners', 'decided', 'responsible'], 'string'],
            [['term'], 'safe'],
            [['id_activity'], 'default', 'value' => null],
            [['id_activity'], 'integer'],
            [['id_activity'], 'exist', 'skipOnError' => true, 'targetClass' => Activity::className(), 'targetAttribute' => ['id_activity' => 'id_activity']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_agenda' => 'Id Agenda',
            'name' => 'Name',
            'listeners' => 'Listeners',
            'decided' => 'Decided',
            'term' => 'Term',
            'responsible' => 'Responsible',
            'id_activity' => 'Id Activity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activity::className(), ['id_activity' => 'id_activity']);
    }
}
