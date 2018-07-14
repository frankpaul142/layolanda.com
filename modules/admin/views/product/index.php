<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= $exportmenu ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
             'artist_id',
             [
             'attribute' => 'artist',
             'value' => 'artist.name',
             'label' =>'Artista'
             ],
            'category_id',
             [
             // 'attribute' => 'artist',
             'value' => 'category.description',
             'label' =>'Categoría'
             ],
                         [
             'attribute' => 'technique',
             'value' => 'technique.description',
             'label' =>'Técnica'
             ],
             [
             'attribute' => 'flowing',
             'value' => 'flowing.description',
             'label' =>'Corriente'
             ],
            'important',
            'creation_date',
            'description',
            'code',
            // 'product_date',
            // 'technique_id',
            // 'material_id',
            // 'flowing_id',
            // 'support',
            // 'title',
             'important',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
