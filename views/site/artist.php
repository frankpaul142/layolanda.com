<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\assets\AppAsset;
use yii\web\View;
use sjaakp\alphapager\AlphaPager;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = Yii::t('artist', 'Artist');
// $this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$script=<<< JS
var aux=$( ".selected" ).attr( "parent_cat" );
$( ".category-"+aux ).click();
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
	 <?= $this->render('sidebar') ?>
        <div class="Absolute-Center is-Responsive">
      <div class="col-sm-12 col-md-10 col-md-offset-1">
      <div id="logo-container"><h3><?= $model->name ?></h3></div>
      <p style="text-align: center;
    margin-top: 20px;"><img class="img-circle" style='max-width: 150px;width: 150px;height: 150px;' src="<?= URL::base() ?>/images/artist/<?= $model->picture ?>" /></p>
      <p><?= $model->country->country_name ?></p>
      <p><?= date('Y',strtotime($model->birthday)) ?><?php if($model->death_date) echo "-".date('Y',strtotime($model->death_date)); ?> </p>
      <div>
      	<?= $model->description ?>
      </div>   
      </div> 

    </div>
    <div class="col-sm-10 container-right">
                <div class="row more-products">
        <h3><?= Yii::t('artist', 'Last Works') ?></h3>
        <?php foreach($model->products as $p => $product):
            if($p>2) break;
          ?>

   <div class="col-sm-3 gallery">
        <a href="<?= Url::to(['product/view','id'=>$product->id]) ?>">
            <?php foreach($product->pictures as $picture): ?>
            <div class="image">
            <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" />
            <img class="bag2" src="<?= URL::base() ?>/images/bag2.png" />
          </div>
        <?php break; endforeach; ?>
            <span><?= $product->title ?> (<?= date('Y',strtotime($product->product_date)) ?>)<br><?= $product->artist->name ?></span>
            <?php if($product->minorprice['discount']){ ?>
            <p><span style="text-decoration:line-through;">$<?= $product->minorprice['price'] ?></span> - <span>$<?= $product->minorprice['price']-$product->minorprice['discount'] ?></span></p>
            <?php }else{ ?>
            <p>$<?= $product->minorprice['price'] ?></p>
            <?php } ?>
        </a>
  </div>
        <?php endforeach; ?>
    </div>
        </div>
