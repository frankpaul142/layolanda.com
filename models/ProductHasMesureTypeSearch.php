<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductHasMesureType;

/**
 * ProductHasMesureTypeSearch represents the model behind the search form about `app\models\ProductHasMesureType`.
 */
class ProductHasMesureTypeSearch extends ProductHasMesureType
{
    /**
     * @inheritdoc
     */
    public $product;
    public $mesure;
    public $type;
    public function rules()
    {
        return [
            [['id', 'product_id', 'mesure_id', 'type_id'], 'integer'],
            [['price'], 'number'],
            [['creation_date','product','mesure','type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProductHasMesureType::find()->joinWith(['product','mesure','type']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'mesure_id' => $this->mesure_id,
            'price' => $this->price,
            'type_id' => $this->type_id,
            'creation_date' => $this->creation_date,
        ]);
        $query->andFilterWhere(['like', 'product.title', $this->product])
            ->andFilterWhere(['like', 'mesure.description', $this->mesure])
            ->andFilterWhere(['like', 'type.description', $this->type]);

        return $dataProvider;
    }
}
