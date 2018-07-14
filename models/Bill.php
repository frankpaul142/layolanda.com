<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $creation_date
 *
 * @property User $user
 * @property Detail[] $details
 */
class Bill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'creation_date','billing_id','delivery_id','subtotal'], 'required'],
            [['user_id','billing_id','delivery_id'], 'integer'],
            [['creation_date'], 'safe'],
            [['observation','pay_method','status'], 'string'],
            [['subtotal'], 'double'],
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
            'user_id' => 'User ID',
            'creation_date' => 'Creation Date',
            'observation' =>Yii::t('bill', 'Observation'),
            'pay_method' =>Yii::t('artist', 'Pay Method'),
            'status' =>Yii::t('artist', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(Detail::className(), ['bill_id' => 'id']);
    }
        public function getDeliveryAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'delivery_id']);
    }
        public function getBillingAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'billing_id']);
    }
}
