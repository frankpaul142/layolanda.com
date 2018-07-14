<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Mesure;
use app\models\Type;
use app\models\Product;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\ProductHasMesureType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-has-mesure-type-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= print_r($model->getErrors()) ?>
 <?= $form->field($model, 'product_id')->DropDownList(ArrayHelper::map(Product::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title'),['prompt'=>'Seleccione un producto']) ?>

 <?= $form->field($model, 'mesure_id')->DropDownList(ArrayHelper::map(Mesure::find()->orderBy(['description' => SORT_ASC])->all(), 'id', 'description'),['prompt'=>'Seleccione una medida']) ?>

 <?= $form->field($model, 'type_id')->DropDownList(ArrayHelper::map(Type::find()->orderBy(['description' => SORT_ASC])->all(), 'id', 'description'),['prompt'=>'Seleccione un tipo']) ?>
<?= $form->field($model, 'size')->dropDownList([ 'S' => 'Pequeño', 'M' => 'Mediano','L' => 'Grande' ], ['prompt' => 'Seleciona un Tamaño']) ?>
    <?= $form->field($model, 'price')->textInput() ?>
    <?= $form->field($model, 'weight')->textInput() ?>
    <label>Se acepta solo un decimal con punto.</label>>
    <?= $form->field($model, 'discount')->textInput() ?>
    <?= $form->field($model, 'stock')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
