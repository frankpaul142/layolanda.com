<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\assets\AppAsset;
use yii\web\View;
use yii\widgets\ActiveForm;
use sjaakp\alphapager\AlphaPager;
use yii\data\Sort;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Type;
use app\models\Content;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

$content=Content::find()->where(['section'=>'SIDEBAR'])->orderBy(['sort' => SORT_ASC])->all();
$prices_select=[''=>Yii::t('prices', 'All'),10=>10,20=>20,50=>50,100=>100,200=>200,300=>300,500=>500,1000=>1000,1500=>1500,3000=>3000,5000=>5000,10000=>10000,20000=>20000,50000=>50000];
$types=ArrayHelper::map(type::find()->orderBy(['description' => SORT_DESC])->andWhere(['id'=>[1,3]])->all(), 'id', 'title');
$resulttypes= ArrayHelper::merge([''=>Yii::t('size', 'All')], $types);
/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->description;
$findUrl = 'category/subcategory?id='.$model->id;
$sort->route = $findUrl;
// $this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$script=<<< JS
var aux=$( ".selected" ).attr( "parent_cat" );
$( ".category-"+aux ).click();
$(".filter-title").click(function(){
  if($( ".arrow-down" ).length){
   $(".arrow-down").addClass('arrow-up');
  $(".arrow-up").removeClass('arrow-down');
  }else{
       $(".arrow-up").addClass('arrow-down');
  $(".arrow-down").removeClass('arrow-up');
  }

    $(".links-filters").toggle(700);
});
if ( $( ".asc" ).length ) {
    
  $(".arrow-down").addClass('arrow-up');
  $(".arrow-up").removeClass('arrow-down');
    $(".links-filters").toggle(700);
 
}
if ( $( ".desc" ).length ) {
     $(".arrow-down").addClass('arrow-up');
  $(".arrow-up").removeClass('arrow-down');
    $(".links-filters").toggle(700);
 
}
$( "#search" ).click(function() {
  $( "#search-product" ).submit();
});
// $('body').on('click', function(event) {
//   var target = $(event.target);
//   if (target.parents('.bootstrap-select').length) {
//         console.log("sop");
//     event.stopPropagation();
//     $('.bootstrap-select').toggleClass('open');
//   }
// }); 
$(".chosen-select").chosen({
  no_results_text: "No se encontraron coincidencias",
width: "100%"}); 
$( document ).ready(function() {
    $(".pager-wrapper-category").children().hide(); 
    $(".summary").show();
    $(".pagination").show();
    
});
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<div class="row container-category-product">
  <div class="col-sm-2 sidebar">
    <h2 class="category-title"><?= $model->category->category->descriptiont ?></h2>
    <div class="sidebar-nav">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button  type="button" class="navbar-toggle button-menu3" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
        <span class="icon-bar top-bar"></span>
        <span class="icon-bar middle-bar"></span>
        <span class="icon-bar bottom-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse vertical-menu">
          <ul class="nav navbar-nav">
            <?php foreach($categories as  $category): ?>
            <li ><a class="category-<?= $category->id ?> parent-category" data-toggle="collapse" data-target="#sub-menu-<?= $category->id ?>" href="javascript:void(0)"><?= $category->description ?></a>
                <?php if($category->categories): ?>
                <div id="sub-menu-<?= $category->id ?>" class="collapse internal-sub-menu">
                <ul class="nav nav-sidebar sub-category">
                    <?php foreach($category->categories as $k => $subcategory): ?>
                    <?php $selected = ($subcategory->id == $model->id) ? 'selected' : ''; ?>
                    <li class="<?= $selected ?>" parent_cat="<?= $category->id ?>" ><a class="subcategory" id="<?= $subcategory->id ?>" href="<?= Url::to(['category/subcategory','id'=>$subcategory->id]) ?>"><?= $subcategory->description ?></a></li>
                    <?php endforeach; ?>
                </ul>
              </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
          </ul>
          <ul class="nav navbar-nav politics collapse">
          <?php foreach($content as $cont): ?>
                <li><a href="<?= Url::to(['site/content','id'=>$cont->id]) ?>"><?= $cont->title ?></a></li>
           <?php endforeach; ?>
          </ul>
          <ul class="nav social collapse">
                <li><a href="https://www.facebook.com/Layolanda-123756124859223/"><img src="<?= URL::base() ?>/images/facebook.png" /></a></li>
                <li><a href="https://twitter.com/layolanda_cs"><img src="<?= URL::base() ?>/images/twitter.png" /></a></li>
                <li><a href="https://www.instagram.com/layolanda_cs/"><img src="<?= URL::base() ?>/images/instagram.png" /></a></li> 
                <li><a href="https://www.pinterest.com/layolanda_cs/"><img src="<?= URL::base() ?>/images/pinterest.png" /></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <div class="col-sm-10 container-right">
    <div class="row filters">
      <div class="row"><a class="filter-title" href="javascript:void(0)"><div class="box"><div class="arrow-down"></div></div><?= Yii::t('sort', 'Sort and Filter') ?></a></div>
<!--       <div class="row links-filters"><?= $sort->link('title',['class'=>'sorter']) ?></div> -->
      <?php
  $form = ActiveForm::begin([ 'id'=>'search-product',
        'method' => 'get',
    ]);
 ?>
    <div class="col-xs-3 col-md-2 links-filters"><?=$form->field($searchModel,'price1')->label(Yii::t('sort', 'From'))->DropDownList($prices_select,['class'=>'chosen-select']); ?></div>

    <div class="col-xs-3 col-md-2 links-filters"><?=$form->field($searchModel,'price2')->label(Yii::t('sort', 'To'))->DropDownList($prices_select,['class'=>'chosen-select']); ?></div>

    <?php if($model->category->category_id!=3 && $model->category->category_id!=2): ?>
    <div class="col-xs-3 col-md-2 links-filters"><?= $form->field($searchModel, 'type')->label(Yii::t('sort', 'Type'))->DropDownList($resulttypes,['data-style'=>'combo-select','class'=>'selectpicker','data-width'=>'100%']) ?></div> 
    <?php endif; ?> 
    <?php if($model->category->category_id!=3): ?>
    <div class="col-xs-3 col-md-2 links-filters"><?= $form->field($searchModel, 'size')->label(Yii::t('sort', 'Size'))->DropDownList([''=>Yii::t('size', 'All'),'S'=>Yii::t('size', 'Small'),'M'=>Yii::t('size', 'Medium'),'L'=>Yii::t('size', 'Large')],['data-style'=>'combo-select','class'=>'selectpicker','data-width'=>'100%']) ?></div> 
    <?php endif; ?> 
    <div class="col-xs-3 col-md-2 links-filters"><p class="hidden-xs">&nbsp;</p><a id="search" href="javascript:void(0)"><span class="search-label"><?= Yii::t('sort', 'Search') ?></span><img class="img-search2" src="<?= URL::base() ?>/images/lupa.png" /></a></div>
<?php 
ActiveForm::end();
?>
    </div>
      <?= 
   ListView::widget([
     'dataProvider' => $dataProvider,
                       'options' => [
            'tag' => 'div',
            'class' => 'pager-wrapper-category',
            'id' => 'pager-container',
        ],
   ]); 
 ?>
    <?php foreach($dataProvider->getModels() as $product): ?>
   <div class="col-sm-3 gallery">
        <a href="<?= Url::to(['product/view','id'=>$product->id]) ?>">
            <?php foreach($product->pictures as $picture): ?>
            <div class="image">
            <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" />
            <img class="bag2" src="<?= URL::base() ?>/images/bag2.png" />
          </div>
        <?php break; endforeach; ?>
            <span><?= $product->title ?> (<?= date('Y',strtotime($product->product_date)) ?>)<br><?= $product->artist->name ?></span>
            <?php if($product->minorprice['discount']){ ?>
            <p><span style="text-decoration:line-through;">$<?= number_format((float)$product->minorprice['price']*1.12, 2, '.', '') ?></span> - <span>$<?= 
            (number_format((float)$product->minorprice['price']*1.12, 2, '.', ''))-$product->minorprice['discount'] ?></span></p>
            <?php }else{ ?>
            <p>$<?= number_format((float)$product->minorprice['price']*1.12, 2, '.', '') ?></p>
            <?php } ?>
        </a>
  </div>
  <?php endforeach; ?> 
      <?= 
   ListView::widget([
     'dataProvider' => $dataProvider,
                       'options' => [
            'tag' => 'div',
            'class' => 'pager-wrapper-category',
            'style' => 'float:left;',
            'id' => 'pager-container',
        ],
   ]); 
 ?>        
  </div>
</div>
