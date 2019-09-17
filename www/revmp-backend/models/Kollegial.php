<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kollegial".
 *
 * @property int $id_kollegial
 * @property string $type_of_collegial_body
 * @property string $name_of_authority
 * @property string $title_document
 * @property string $object
 * @property int $number_of_events
 * @property int $amount_members
 *
 * @property Activity[] $activities
 * @property Authority[] $authorities
 * @property Func[] $funcs
 * @property KollegialMembers[] $kollegialMembers
 * @property Members[] $members
 * @property Orders[] $orders
 * @property Organization[] $organizations
 */
class Kollegial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kollegial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_of_collegial_body', 'name_of_authority', 'title_document', 'object'], 'string'],
            [['number_of_events', 'amount_members'], 'default', 'value' => null],
            [['number_of_events', 'amount_members'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kollegial' => 'Id Kollegial',
            'type_of_collegial_body' => 'Type Of Collegial Body',
            'name_of_authority' => 'Name Of Authority',
            'title_document' => 'Title Document',
            'object' => 'Object',
            'number_of_events' => 'Number Of Events',
            'amount_members' => 'Amount Members',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['id_kollegial' => 'id_kollegial']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorities()
    {
        return $this->hasMany(Authority::className(), ['id_kollegial' => 'id_kollegial']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFuncs()
    {
        return $this->hasMany(Func::className(), ['id_kollegial' => 'id_kollegial']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKollegialMembers()
    {
        return $this->hasMany(KollegialMembers::className(), ['id_kollegial' => 'id_kollegial']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Members::className(), ['id_members' => 'id_members'])->viaTable('kollegial_members', ['id_kollegial' => 'id_kollegial']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['id_kollegial' => 'id_kollegial']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['id_kollegial' => 'id_kollegial']);
    }
}
