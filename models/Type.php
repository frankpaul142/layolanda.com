<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property integer $id
 * @property string $creation_date
 * @property string $description
 * @property string $title
 *
 * @property ProductHasMesureType[] $productHasMesureTypes
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
    }
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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creation_date', 'description', 'title'], 'required'],
            [['creation_date'], 'safe'],
            [['description','description_en'], 'string', 'max' => 250],
            [['title','title_en'], 'string', 'max' => 50],
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
            'description' => 'Description',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHasMesureTypes()
    {
        return $this->hasMany(ProductHasMesureType::className(), ['type_id' => 'id']);
    }
}
