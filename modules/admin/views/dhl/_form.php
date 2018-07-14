<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dhl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dhl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'zone')->textInput() ?>

    <?= $form->field($model, 'kg')->textInput() ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
