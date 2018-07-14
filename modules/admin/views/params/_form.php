<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\assets\AdminAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Params */
/* @var $form yii\widgets\ActiveForm */
$script=<<< JS
	$(document).ready(function(){
		if($('#params-description').val()=='IMG-HOME'){
				$('.value-text').hide();
				$('.value-file').show();	
			}else{
				$('.value-text').show();
				$('.value-file').hide();	
		}
		$('#params-description').change(function(){
			if($(this).val()=='IMG-HOME'){
				$('.value-text').hide();
				$('.value-file').show();	
			}else{
				$('.value-text').show();
				$('.value-file').hide();	
			}
		})
	});
JS;
$this->registerJs($script,View::POS_END);
AdminAsset::register($this);
?>

<div class="params-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	<?= $form->field($model, 'description')->dropDownList(
            ['IMG-HOME' => 'Imágen Home', 'WELCOME' => 'Video Welcome']) ?>
     <?= $form->field($model, 'value')->fileInput(['class'=>'value-file']) ?>
     <?= $form->field($model, 'value')->textInput(['style'=>'display:none;','class'=>'value-text'])->label('') ?>
    <?= Html::img('@web/images/'.$model->value,['width'=>'30%']);?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
