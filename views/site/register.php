<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title =Yii::t('user', 'Register');
?>
<div class="user-create">

    <?= $this->render('sidebar') ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
