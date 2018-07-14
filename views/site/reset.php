<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title =Yii::t('reset', 'Reset your password');

?>
<div id="registro" class="background-registro">
    <?= $this->render('sidebar') ?>
    <div class="Absolute-Center is-Responsive">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
    <div class="cont-titulos" style='text-align: center;'>
        <h3><?= $this->title ?></h3>

    </div>
    <div class="cont-formulario">
            <?php $form = ActiveForm::begin(); ?>
       
            <?= $form->field($model,'password')->input('password')->label('Contraseña.') ?>
            <?= $form->field($model,'confirmpassword')->input('password')->label('Repita su contraseña.') ?>

            
        <div class="form-group">    
      <?= Html::submitButton('Recuperar', ['class' => 'btn btn-def btn-block']) ?>
      </div>
           <?php ActiveForm::end(); ?>
        <div class="div-registro">
        </div>

    </div>
    </div>
    </div>
</div>
<!-- -->
