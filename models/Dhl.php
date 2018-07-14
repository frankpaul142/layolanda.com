<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dhl".
 *
 * @property integer $zone
 * @property double $kg
 * @property integer $value
 */
class Dhl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dhl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zone', 'value'], 'integer'],
            [['kg'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'zone' => 'Zone',
            'kg' => 'Kg',
            'value' => 'Value',
        ];
    }
}
