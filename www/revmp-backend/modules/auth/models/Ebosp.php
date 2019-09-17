<?php

namespace app\modules\auth\models;

/**
 * This is the model class for table "ebosp".
 *
 * @property int $id
 * @property string $ebosp_name
 * @property string $short_name
 * @property string $code
 */
class Ebosp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return 'ebosp';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['ebosp_name'], 'required'],
            [['ebosp_name', 'short_name', 'code'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'ebosp_name' => 'Наименование',
            'short_name' => 'Сокращение',
            'code' => 'Код ИОГВ',
            'pki_ids' => 'КПР'
        ];
    }
}
