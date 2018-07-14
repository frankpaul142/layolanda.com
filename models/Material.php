<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property integer $id
 * @property string $creation_date
 * @property string $description
 *
 * @property Product[] $products
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'material';
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
                default:
                    return $current;
            }
    }
    public function rules()
    {
        return [
            [['creation_date', 'description'], 'required'],
            [['creation_date'], 'safe'],
            [['description','description_en'], 'string', 'max' => 150],
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
            'description' => 'Material',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['material_id' => 'id']);
    }
}
