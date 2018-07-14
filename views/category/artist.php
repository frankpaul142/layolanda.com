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

$this->title = 'Artistas';
// $this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$script=<<< JS
var aux=$( ".selected" ).attr( "parent_cat" );
$( ".category-"+aux ).click();
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<div style="text-align: center;margin-bottom: 50px;">
<?= AlphaPager::widget([
    'dataProvider' => $dataProvider
]) ?>
</div>

<div class="container-right col-sm-10" >
<div class="row">
<?php 
foreach($dataProvider->getModels() as $artist) { ?>
   <p>
        <a href="<?= Url::to(['site/artist','id'=>$artist->id]) ?>">
            <span><?= $artist->name ?></span>
        </a>
  </p>
<?php 
  }   
  ?>       
  </div>
</div>
