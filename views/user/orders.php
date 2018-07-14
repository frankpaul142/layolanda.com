<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('user', 'Purchases');
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
                <?= Html::a(Yii::t('user', 'Purchases'), ['orders'], [
            'class' => 'btn'
        ]) ?>
    </p>
<div class="row">
<?php foreach($model->bills as $bill): ?>
    <div class="card">
    <h4><?=  Yii::t('user', 'Order')?> # <?= $bill->id ?></h4>
        <p>Total: $<?= $bill->subtotal ?></p>
        <p><?=  Yii::t('user_purchase', 'Status')?>: <?= $bill->status ?></p>
        <p><?=  Yii::t('user_purchase', 'Pay Method')?>: <?= $bill->pay_method ?></p>
        <p><?= Html::a(Yii::t('user', 'See Details'), ['detail','id'=>$bill->id], [
            'class' => 'btn'
        ]) ?></p>
    </div>
<?php endforeach; ?>
</div>
</div>
</div>