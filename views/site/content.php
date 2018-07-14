<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = $model->title;

?>
<div class="site-index">

	 <?= $this->render('sidebar') ?>
    <div class="col-sm-10 container-right">
    	 <h3 style="text-align: center;"><?= Html::encode($this->title) ?></h3>
        <div class="row">
        <?= $model->description ?>
        </div>

    </div>
</div>
