<?php
use yii\helpers\Html;
// use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Yii::t('register', 'Congrats ').$model->names;

?>
<div>
    <?= $this->render('sidebar') ?>
    <div class="col-sm-10 container-right">
	<div class="cont-titulos">
    	<h1><?= Yii::t('register', 'Register') ?></h1>
      
	</div>
    <div class="cont-formulario">
   		    <div class="cont-infocamposf2 conf-compra">
            	<?= Yii::t('register', 'THANKS FOR REGISTERING') ?><br/>
                <span> <?= strtoupper($model->names) ?> </span><br/>
                <font><?= Yii::t('register', 'Weve sent you an email so you can activate your account') ?></font>
                <?= Yii::$app->getSession()->getFlash('success'); ?>
	     		<?= Yii::$app->getSession()->getFlash('warning'); ?>
            </div> 

    </div>
    </div>
</div>