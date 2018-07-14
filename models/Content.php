<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
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
                case 'title':
                    if(Yii::$app->language=="en_EN"){
                        return $this->title_en;
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
            [['description'], 'required'],
            [['description','section','type','description_en'], 'string'],
            [['sort'], 'integer'],
            [['title','title_en'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getTitlet() {
        if(Yii::$app->language=="en_EN"){
            return $this->title_en;
        }
        return $this->title;
       
        // or If the category is the database table name.
        // return Language::t(static::tableName(), $this->description, $params, $language);
    }
    public function getDescriptiont() {
        if(Yii::$app->language=="en_EN"){
            return $this->description_en;
        }
        return $this->description;
       
        // or If the category is the database table name.
        // return Language::t(static::tableName(), $this->description, $params, $language);
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }
}
