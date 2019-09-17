<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "members".
 *
 * @property int $id_members
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property string $position
 * @property int $organization
 * @property string $phone
 * @property string $email
 *
 * @property KollegialMembers[] $kollegialMembers
 * @property Kollegial[] $kollegials
 */
class Members extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'members';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'name', 'patronymic', 'position', 'phone', 'email'], 'string'],
            [['organization'], 'default', 'value' => null],
            [['organization'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_members' => 'Id Members',
            'surname' => 'Surname',
            'name' => 'Name',
            'patronymic' => 'Patronymic',
            'position' => 'Position',
            'organization' => 'Organization',
            'phone' => 'Phone',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKollegialMembers()
    {
        return $this->hasMany(KollegialMembers::className(), ['id_members' => 'id_members']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKollegials()
    {
        return $this->hasMany(Kollegial::className(), ['id_kollegial' => 'id_kollegial'])->viaTable('kollegial_members', ['id_members' => 'id_members']);
    }
}
