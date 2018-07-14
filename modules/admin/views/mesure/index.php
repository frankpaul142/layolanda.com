<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MesureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mesures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesure-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mesure', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= $exportmenu ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'creation_date',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
