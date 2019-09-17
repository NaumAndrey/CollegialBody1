<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kollegial_members".
 *
 * @property int $id_kollegial
 * @property int $id_members
 *
 * @property Kollegial $kollegial
 * @property Members $members
 */
class Kollegial_Members extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kollegial_members';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kollegial', 'id_members'], 'required'],
            [['id_kollegial', 'id_members'], 'default', 'value' => null],
            [['id_kollegial', 'id_members'], 'integer'],
            [['id_kollegial', 'id_members'], 'unique', 'targetAttribute' => ['id_kollegial', 'id_members']],
            [['id_kollegial'], 'exist', 'skipOnError' => true, 'targetClass' => Kollegial::className(), 'targetAttribute' => ['id_kollegial' => 'id_kollegial']],
            [['id_members'], 'exist', 'skipOnError' => true, 'targetClass' => Members::className(), 'targetAttribute' => ['id_members' => 'id_members']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kollegial' => 'Id Kollegial',
            'id_members' => 'Id Members',
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
    public function getMembers()
    {
        return $this->hasOne(Members::className(), ['id_members' => 'id_members']);
    }
}
