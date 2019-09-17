<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property int $id_organization
 * @property string $full_name_organization
 * @property string $name
 * @property int $inn
 * @property int $ogrn
 * @property string $phone_organization
 * @property string $email_organization
 * @property string $fio_leader
 * @property string $phone_leader
 * @property string $email_organization_leader
 * @property int $id_kollegial
 *
 * @property Kollegial $kollegial
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name_organization', 'name', 'phone_organization', 'email_organization', 'fio_leader', 'phone_leader', 'email_organization_leader'], 'string'],
            [['inn', 'ogrn', 'id_kollegial'], 'default', 'value' => null],
            [['inn', 'ogrn', 'id_kollegial'], 'integer'],
            [['id_kollegial'], 'exist', 'skipOnError' => true, 'targetClass' => Kollegial::className(), 'targetAttribute' => ['id_kollegial' => 'id_kollegial']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_organization' => 'Id Organization',
            'full_name_organization' => 'Full Name Organization',
            'name' => 'Name',
            'inn' => 'Inn',
            'ogrn' => 'Ogrn',
            'phone_organization' => 'Phone Organization',
            'email_organization' => 'Email Organization',
            'fio_leader' => 'Fio Leader',
            'phone_leader' => 'Phone Leader',
            'email_organization_leader' => 'Email Organization Leader',
            'id_kollegial' => 'Id Kollegial',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKollegial()
    {
        return $this->hasOne(Kollegial::className(), ['id_kollegial' => 'id_kollegial']);
    }
}
