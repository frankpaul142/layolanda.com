<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
$categories=Category::find()->all();
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

<!--     <?= $form->field($model, 'category_id')->DropDownList(ArrayHelper::map(Category::find()->orderBy(['description' => SORT_ASC])->all(), 'id', 'description'),['prompt'=>'Seleccione una Categoría si lo requiere']) ?> -->
	<label>Categoría</label>
    <select name=Category[category_id] id="category-category_id" class="form-control">
    <option value="">Seleccione una Categoría si lo requiere</option>
    	<?php foreach($categories as $category): ?>
    		<option value="<?= $category->id ?>"><?= $category->description ?>-<?= (isset($category->category->description)) ? $category->category->description : ""; ?></option>
    		<?php endforeach; ?>
    </select>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description_en')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
