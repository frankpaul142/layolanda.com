<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\AppAsset;
use yii\web\View;
use yii\helpers\Url;
use app\models\Content;
$content=Content::find()->where(['section'=>'SIDEBAR'])->orderBy(['sort' => SORT_ASC])->all();
/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'La Yolanda Concept Store |'.$model->title;
$this->params['title-face'] = 'La Yolanda Concept Store | '.$model->title;
$this->params['description-face'] = $model->artist->name;
$this->params['img-face'] = Url::base(true).'/images/products/'.$model->pictures[0]->description;
$id=$model->id;
$script=<<< JS
  var freeMasonry = $('.grid');
  freeMasonry.imagesLoaded()
    .done(function(){
      freeMasonry.masonry({
          itemSelector: '.grid-item',
percentPosition: true,
      });
    });
   $("#type").change(function(){
        $("#mesure option").hide();
        var product_id=$id;
        var type=$(this).val();
        $('#mesure option[value=""]').show();
        $('#mesure option:eq(0)').prop('selected', true);
         $.ajax( {
              type: "POST",
              url: "consult-mesures",
              data: {product_id:product_id,type:type},
              dataType:'json',
              success: function( data ) {
                console.log(data);
                
              $.map(data, function( val, i ) {
                        $('#mesure').append('<option value="'+val.id+'" price="'+val.price+'">'+val.description+'</option>');
                    });
                    $('#mesure option:eq(0)').prop('selected', true);
                    $('#mesure').selectpicker('refresh');
                }

        });
    });
$("#mesure").change(function(){
        $(".price-product").hide();
        var id=$(this).val();
        $("#mtype-"+id).show();

      });
// $( document ).ready(function() {
// $('.grid').masonry({
//   // options
//   itemSelector: '.grid-item',
// percentPosition: true,
// });
// });
var aux=$( ".selected" ).attr( "parent_cat" );
$( ".category-"+aux ).click();
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<div class="row container-category-product">
  <div class="col-sm-2 sidebar">
    <h2 class="category-title"><?= $model->category->category->category->descriptiont ?></h2>
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
            <li >
              <a class="category-<?= $category->id ?> parent-category" data-toggle="collapse" data-target="#sub-menu-<?= $category->id ?>" href="javascript:void(0)"><?= $category->description ?></a>
                <?php if($category->categories): ?>
                <div id="sub-menu-<?= $category->id ?>" class="collapse internal-sub-menu">
                <ul class="nav nav-sidebar sub-category">
                    <?php foreach($category->categories as $k => $subcategory): ?>
                    <?php $selected = ($subcategory->id == $model->category_id) ? 'selected' : ''; ?>
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
    <div class="col-sm-9 grid">
        <?php foreach($model->pictures as $k => $picture): ?>
        <?php if($k%2){ ?>
        <div class="grid-item grid-item--width2">
          <a href="<?= URL::base() ?>/images/products/<?= $picture->description ?>" data-toggle="lightbox" data-gallery="example-gallery"><img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" /></a>
        </div>
        <?php }else{ ?>
        <div class="grid-item">
          <a href="<?= URL::base() ?>/images/products/<?= $picture->description ?>" data-toggle="lightbox" data-gallery="example-gallery"><img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" /></a>
          </div>
        <?php } ?>
    <?php endforeach; ?>
    </div> 
    <div class="col-sm-3 detail">
        <div class="description-product">
        <h3><?= $model->title ?></h3>
        <span><?= Yii::t('product', 'Category') ?></span>
        <p><?= $model->category->category->description ?></p>
        <span><?= Yii::t('product', 'Code') ?></span>
        <p><?= $model->code ?></p>
        <?php if($model->category->category->category_id!=3): ?>
        <span>Autor</span>
        <p><a href='<?= Url::to(['site/artist','id'=>$model->artist->id]) ?>'><?= $model->artist->name ?></a></p>
        <p><?= $model->artist->country->country_name ?></p>
        <p><?= date('Y',strtotime($model->artist->birthday)) ?><?php if($model->artist->death_date) echo "-".date('Y',strtotime($model->artist->death_date)); ?> </p>
      <?php endif; ?>
        <?php if($model->origin): ?>
        <span><?= Yii::t('product', 'Origin') ?></span>
        <p><?= $model->origin ?></p>
        <?php endif; ?>
<!--         <span><?= Yii::t('product', 'Style') ?></span>
        <p><?= $model->category->description ?></p>
        <span><?= Yii::t('product', 'Flowing') ?></span>
        <p><?= $model->flowing->description ?></p> -->
        <span><?= Yii::t('product', 'Technique') ?></span>
        <p><?= $model->technique->description ?></p>
        <?php if($model->color): ?>
        <span><?= Yii::t('product', 'Color') ?></span>
        <p><?= $model->color ?></p>
        <?php endif; ?>
        <span><?= Yii::t('product', 'Materials') ?></span>
        <p><?= $model->material->description ?></p>
        <?php if($model->support): ?>
        <span><?= Yii::t('product', 'Support') ?></span>
        <p><?= $model->support ?></p>
        <?php endif; ?>
    </div>
    <?php if($model->original): ?>
      <div class="original-container">
        <span>Original</span>
        <p><?= $model->original->mesure->description ?></p>
        <?php if($model->original->discount){ ?>
        <span id="mtype-<?= $model->original->id ?>" class="price-product-original" style="display:block;"><span style="text-decoration:line-through;">$<?= number_format((float)$model->original->price*1.12, 2, '.', '') ?></span> - $<?= (number_format((float)$model->original->price*1.12, 2, '.', ''))-$model->original->discount ?><a href="<?= Url::to(['site/addtocart','id'=>$model->original->id]) ?>"><img src="<?= URL::base() ?>/images/bag1.svg" /></a></span>
        <span>Medidas: </span><p><?= $model->original->mesure->description ?></p>
        <?php  }else{ ?>
        <span id="mtype-<?= $model->original->id ?>" class="price-product-original" style="display:block;">$<?= (number_format((float)$model->original->price*1.12, 2, '.', ''))-$model->original->discount ?><a href="<?= Url::to(['site/addtocart','id'=>$model->original->id]) ?>"><img src="<?= URL::base() ?>/images/bag1.svg" /></a></span>
        <span>Medidas: </span><p><?= $model->original->mesure->description ?></p>
        <?php } ?>
      </div>
    <?php endif; ?>
    <?php if($model->limited): ?>
      <div class="original-container">
        <span><?= Yii::t('product', 'Limited Edition') ?></span>
        <p><?= $model->limited->mesure->description ?></p>
        <?php if($model->limited->discount){ ?>
        <span id="mtype-<?= $model->limited->id ?>" class="price-product-original" style="display:block;"><span style="text-decoration:line-through;">$<?= number_format((float)$model->limited->price*1.12, 2, '.', '') ?></span> - $<?= (number_format((float)$model->limited->price*1.12, 2, '.', ''))-$model->limited->discount ?><a href="<?= Url::to(['site/addtocart','id'=>$model->limited->id]) ?>"><img src="<?= URL::base() ?>/images/bag1.svg" /></a></span>
        <span>Medidas: </span><p><?= $model->limited->mesure->description ?></p>
        <?php  }else{ ?>
        <span id="mtype-<?= $model->limited->id ?>" class="price-product-original" style="display:block;">$<?= (number_format((float)$model->limited->price*1.12, 2, '.', ''))-$model->limited->discount ?><a href="<?= Url::to(['site/addtocart','id'=>$model->limited->id]) ?>"><img src="<?= URL::base() ?>/images/bag1.svg" /></a></span>
        <span>Medidas: </span><p><?= $model->limited->mesure->description ?></p>
        <?php } ?>
      </div>
    <?php endif; ?>
    <?php if(count($model->types)==1 && !$model->limited && !$model->original): ?>
      <div class="original-container">
        <span><?= $model->types[0]->description ?></span>
        <?php if($model->mesuretypes[0]->discount){ ?>
        <span id="mtype-<?= $model->mesuretypes[0]->id ?>" class="price-product-original" style="display:block;"><span style="text-decoration:line-through;">$<?= number_format((float)$model->mesuretypes[0]->price*1.12, 2, '.', '') ?></span> - $<?= (number_format((float)$model->mesuretypes[0]->price*1.12, 2, '.', ''))-$model->mesuretypes[0]->discount ?><a href="<?= Url::to(['site/addtocart','id'=>$model->mesuretypes[0]->id]) ?>"><img src="<?= URL::base() ?>/images/bag1.svg" /></a></span>
        <span>Medidas: </span><p><?= $model->mesuretypes[0]->mesure->description ?></p>
        <?php  }else{ 

          ?>
        <span id="mtype-<?= $model->mesuretypes[0]->id ?>" class="price-product-original" style="display:block;">$<?= number_format((float)$model->mesuretypes[0]->price*1.12, 2, '.', '') ?><a href="<?= Url::to(['site/addtocart','id'=>$model->mesuretypes[0]->id]) ?>"><img src="<?= URL::base() ?>/images/bag1.svg" /></a></span>
        <span>Medidas: </span><p><?= $model->mesuretypes[0]->mesure->description ?></p>
        <?php } ?>
      </div>
    <?php endif; ?>
    <?php if(count($model->types)>1): ?>
    <div class="more-container">
    <span><?= Yii::t('product', 'Replicas') ?></span>
    <select id="type" class="selectpicker" data-style="combo-select" title="Escoge un tipo" data-width="80%" >
        <?php foreach($model->types as $type): ?>
        <?php if($type->id!=1 && $type->id!=3): ?>
        <option value="<?= $type->id ?>"><?= $type->description ?></option>
         <?php endif; ?>
    <?php endforeach; ?>
    </select>
    <span><?= Yii::t('product', 'Mesures') ?></span>
    <select id="mesure" class="selectpicker" data-style="combo-select" title="Escoge una medida" data-width="80%" >
    </select>
  </div>
  <?php endif; ?>
      <?php 
      if($model->mesuretypes):
      foreach($model->mesuretypes as $mtypes): ?>
    <?php if($mtypes->id!=1 || $mtypes->id!=3): ?>
    <span id="mtype-<?= $mtypes->id ?>" class="price-product">$<?= (number_format((float)$mtypes->price*1.12, 2, '.', ''))-$mtypes->discount ?><a href="<?= Url::to(['site/addtocart','id'=>$mtypes->id]) ?>"><img src="<?= URL::base() ?>/images/bag1.svg" /></a></p></span>
    <?php endif; ?>
    <?php endforeach;
     endif; ?>
    <div class="notes">
      <?= $model->description ?>
    </div>
    <br>
    <div class="social" style="display: inline-block;">
     <div style="float: left; margin-right: 6px;"><a href="https://www.pinterest.com/pin/create/button/" data-pin-lang="en"> </a></div>
      <div class="fb-share-button" data-href="<?= Url::current(); ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"><?= Yii::t('product', 'Share') ?></a></div>
      <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?= $model->title ?>">Tweet</a>
    </div>
    </div>
    <div class="row more-products">
        <h3><?= Yii::t('product', 'Other Works') ?></h3>
        <?php $count=0; foreach($model->artist->products as $product):  ?>
                        <?php if($product->id==$model->id){
                   continue; 
                }else{
                    if($count>2){
                        break;
                    }
                } ?>
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
            <p><span style="text-decoration:line-through;">$<?= number_format((float)$product->minorprice['price']*1.12, 2, '.', '') ?></span> - <span>$<?= (number_format((float)$product->minorprice['price']*1.12, 2, '.', ''))-$product->minorprice['discount'] ?></span></p>
            <?php }else{ ?>
            <p>$<?= number_format((float)$product->minorprice['price']*1.12, 2, '.', '') ?></p>
            <?php } ?>
        </a>
  </div>
        <?php $count++; endforeach; ?>
    </div>    
  </div>
</div>