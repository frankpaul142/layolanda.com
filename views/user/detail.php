<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('user_detail', 'Order').'#'.$model->id;
?>
<div class="user-view">
 <?= $this->render('../site/sidebar') ?>
      <div class="Absolute-Center is-Responsive">
    <div id="logo-container"><h3><?= Html::encode($this->title) ?></h3></div>

    <p style="text-align: center;">
        <?= Html::a(Yii::t('user_button', 'My Profile'), ['user/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('user_button', 'Addresses'), ['address'], [
            'class' => 'btn'
        ]) ?>
                <?= Html::a(Yii::t('user_button', 'Purchases'), ['orders'], [
            'class' => 'btn'
        ]) ?>
    </p>
<div class="row">
    <div class="card">
    <h4><?= Yii::t('user_detail', 'Shipping Address') ?></h4>
    <p><strong><?= Yii::t('user_detail', 'Street') ?> 1:</strong><span><?= $model->deliveryAddress->address_line_1 ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'Street') ?> 2:</strong><span><?= $model->deliveryAddress->address_line_2 ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'City') ?>:</strong><span><?= $model->deliveryAddress->city ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'Province') ?>:</strong><span><?= $model->deliveryAddress->province ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'Country') ?>:</strong><span><?= $model->deliveryAddress->country->country_name ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'ZipCode') ?>:</strong><span><?= $model->deliveryAddress->zip ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'Phone') ?>:</strong><span><?= $model->deliveryAddress->phone ?></span></p>
    </div>
    <div class="card">
    <h4><?= Yii::t('user_detail', 'Billing Address') ?></h4>
    <p><strong><?= Yii::t('user_detail', 'Street') ?> 1:</strong><span><?= $model->billingAddress->address_line_1 ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'Street') ?> 2:</strong><span><?= $model->billingAddress->address_line_2 ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'City') ?>:</strong><span><?= $model->billingAddress->city ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'Province') ?>:</strong><span><?= $model->billingAddress->province ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'Country') ?>:</strong><span><?= $model->billingAddress->country->country_name ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'ZipCode') ?>:</strong><span><?= $model->billingAddress->zip ?></span></p>
    <p><strong><?= Yii::t('user_detail', 'Phone') ?>:</strong><span><?= $model->billingAddress->phone ?></span></p>
    </div>
</div>
<div class="row">
<h3><?= Yii::t('user_detail', 'Purchase Detail') ?>:</h3>
<?php foreach($model->details as $detail): ?>
    <div class="card">
        <p><strong><?= Yii::t('user_detail', 'Product') ?>:</strong><span><?= $detail->productmt->product->title ?></span></p>
        <p><strong><?= Yii::t('user_detail', 'Mesure') ?>:</strong><span><?= $detail->productmt->mesure->description ?></span></p>
        <p><strong><?= Yii::t('user_detail', 'Type') ?>:</strong><span><?= $detail->productmt->type->description ?></span></p>
        <p><strong><?= Yii::t('user_detail', 'Price') ?>:</strong><span><?= $detail->productmt->price ?></span></p>
        <p><strong><?= Yii::t('user_detail', 'Quantity') ?>:</strong><span><?= $detail->quantity ?></span></p>
         <img  class="img-responsive" src="<?= URL::base() ?>/images/products/<?= $detail->productmt->product->pictures[0]->description ?>">
    </div>
<?php endforeach; ?>
</div>
</div>
</div>