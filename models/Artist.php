<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artist".
 *
 * @property integer $id
 * @property string $creation_date
 * @property string $name
 * @property string $birthday
 * @property string $death_date
 * @property integer $country_id
 *
 * @property Country $country
 * @property Product[] $products
 */
class Artist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artist';
    }

    /**
     * @inheritdoc
     */
    public function __get($name) {
            $current = parent::__get($name);
            switch($name){
                case 'description':
                    if(Yii::$app->language=="en_EN"){
                        return $this->description_en;
                    }
                    else{
                        return $current;
                    }
                    break;
                case 'picture':
                    if(!$current){
                        return 'avatar.png';
                    }
                    else{
                        return $current;
                    }
                    break;
                default:
                    return $current;
            }
        }
    public function rules()
    {
        return [
            [['creation_date', 'name', 'birthday', 'country_id'], 'required'],
            [['creation_date', 'birthday', 'death_date'], 'safe'],
            [['country_id'], 'integer'],
            [['name','picture'], 'string', 'max' => 150],
            [['description','description_en'], 'string'],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creation_date' => Yii::t('artist', 'Creation Date'),
            'name' => Yii::t('artist', 'Name'),
            'birthday' => Yii::t('artist', 'birthday'),
            'death_date' => Yii::t('artist', 'Death Date'),
            'description' => Yii::t('artist', 'description'),
            'country_id' => 'Country ID',
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
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['artist_id' => 'id']);
    }
}
