<?php

namespace app\models;

use Yii;
use yii\filters\AccessControl;
use kartik\password\StrengthValidator;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $creation_date
 * @property string $username
 * @property string $names
 * @property string $lastnames
 * @property string $birthday
 * @property string $sex
 * @property string $type
 * @property string $password
 * @property string $auth_key
 *
 * @property Address[] $addresses
 * @property Bill[] $bills
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public $accessToken;
    public $confirmPassword;
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creation_date', 'names', 'lastnames', 'birthday', 'sex', 'type', 'password','username'], 'required'],
            [['id'], 'integer'],
            [['creation_date', 'birthday'], 'safe'],
            [['sex', 'type'], 'string'],
            [['username', 'names', 'lastnames'], 'string', 'max' => 150],
            [['password', 'auth_key','password_reset_token'], 'string', 'max' => 255],
            [['username'], 'unique', 'message'=>"Ya existe ese email en el sistema."],
            [['username'], 'email'],
            ['confirmPassword', 'compare', 'compareAttribute'=>'password', 'on' => 'create', 'message'=>"Las contraseñas deben ser iguales" ],
            ['status', 'in', 'range' => ['ACTIVE','INACTIVE']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creation_date' => 'Creation Date',
            'username' => Yii::t('user', 'email'),
            'names' => Yii::t('user', 'Names'),
            'lastnames' => Yii::t('user', 'LastNames'),
            'birthday' => Yii::t('user', 'Birthday'),
            'sex' => Yii::t('user', 'Sex'),
            'type' => Yii::t('user', 'Type'),
            'password' => Yii::t('user', 'Password'),
            'confirmPassword' => Yii::t('user', 'Confirm Password'),
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" No está implementado.');
    }
    
    public function beforeSave($insert) {

         if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
                  if(isset($this->password)) 
                    $this->password = $this->hashPassword($this->password);
            }
        }
        return parent::beforeSave($insert);
    }
        public static function isUserClient($username)
    {
      if (static::findOne(['username' => $username, 'type' => 'CLIENT','status'=>'ACTIVE'])){
 
             return true;
      } else {
 
             return false;
      }
 
    }
        public static function isUserAdmin($username)
    {
      if (static::findOne(['username' => $username, 'type' => 'ADMIN','status'=>'ACTIVE'])){
 
             return true;
      } else {
 
             return false;
      }
 
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username,'status'=>'ACTIVE']);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = (1 * 4 * 60 * 60);
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
     public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
        public function validatePassword($password)
    {
         return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function hashPassword($password){

        //return hash('sha256',$password);
        return \Yii::$app->getSecurity()->generatePasswordHash($password);
    }
    
    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->getSecurity()->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = \Yii::$app->getSecurity()->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['user_id' => 'id']);
    }
    public function getDeliveryAddresses()
    {
        return $this->hasMany(Address::className(), ['user_id' => 'id'])->where(['type' => 'DELIVERY'])->orWhere(['type' => 'BILLING-DELIVERY']);
    }
        public function getBillingAddresses()
    {
        return $this->hasMany(Address::className(), ['user_id' => 'id'])->where(['type' => 'BILLING'])->orWhere(['type' => 'BILLING-DELIVERY']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bill::className(), ['user_id' => 'id']);
    }
}
