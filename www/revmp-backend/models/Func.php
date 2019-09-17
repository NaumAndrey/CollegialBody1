<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "func".
 *
 * @property int $id_func
 * @property string $authority
 * @property string $name
 * @property int $id_kollegial
 *
 * @property Kollegial $kollegial
 */
class Func extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'func';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['authority'], 'number'],
            [['name'], 'string'],
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
            'id_func' => 'Id Func',
            'authority' => 'Authority',
            'name' => 'Name',
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
