<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $type
 * @property string $creation_date
 * @property string $city
 * @property string $province
 * @property integer $country_id
 * @property string $zip
 * @property string $phone
 * @property integer $user_id
 *
 * @property Country $country
 * @property User $user
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_line_1', 'type', 'creation_date', 'city', 'province', 'country_id', 'zip', 'phone', 'user_id'], 'required'],
            [['type'], 'string'],
            [['creation_date'], 'safe'],
            [['country_id', 'user_id'], 'integer'],
            [['address_line_1', 'address_line_2'], 'string', 'max' => 255],
            [['city', 'province'], 'string', 'max' => 150],
            [['zip', 'phone'], 'string', 'max' => 45],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address_line_1' => Yii::t('address', 'Address Line 1'),
            'address_line_2' => Yii::t('address', 'Address Line 2'),
            'type' => Yii::t('address', 'Type'),
            'creation_date' => Yii::t('address', 'Creation Date'),
            'city' => Yii::t('address', 'City'),
            'province' => Yii::t('address', 'Province'),
            'country_id' => Yii::t('address', 'Country'),
            'zip' => Yii::t('address', 'Zip'),
            'phone' => Yii::t('address', 'Phone'),
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
