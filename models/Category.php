<?php
namespace app\models;

use Yii;
/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $creation_date
 * @property string $description
 *
 * @property Category $category
 * @property Category[] $categories
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    /**
     * @var Returning the 'description' attribute on the site's own language.
     */
    public function behaviors()
    {
        return [
            [
                'class' => \lajax\translatemanager\behaviors\TranslateBehavior::className(),
                'translateAttributes' => ['description'],
            ],

            // or If the category is the database table name.
            // [
            //     'class' => \lajax\translatemanager\behaviors\TranslateBehavior::className(),
            //     'translateAttributes' => ['name', 'description'],
            //     'category' => static::tableName(),
            // ],
        ];
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
                default:
                    return $current;
            }
        }

    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id','sort'], 'integer'],
            [['creation_date', 'description'], 'required'],
            [['creation_date'], 'safe'],
            [['description','code','description_en'], 'string', 'max' => 150],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'creation_date' => 'Creation Date',
            'description' => Yii::t('category', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescriptiont() {
        if(Yii::$app->language=="en_EN"){
            return $this->description_en;
        }
        return $this->description;
       
        // or If the category is the database table name.
        // return Language::t(static::tableName(), $this->description, $params, $language);
    }
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['category_id' => 'id'])->orderBy(['sort' => SORT_ASC]);;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id'])->where(['status'=>'ACTIVE']);
    }
}
