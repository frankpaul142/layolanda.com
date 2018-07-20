<?php 
use yii\helpers\Url;
?>
<div class="row cart-mobile-container">
  <div class="product-image col-xs-12 padding-0">
    <img src="<?= URL::base() ?>/images/products/<?= $position->product->pictures[0]->description ?>" alt="producto"/>
  </div>
  <div class="col-xs-12 padding-0">
    <div class="product-title"><?= $position->product->title ?></div>
    <p class="product-description"><?= $position->mesure->description ?>-<?= $position->type->description ?></p>
  </div>
  <div class="product-price col-xs-2 padding-0">$<?= $position->getPrice() ?></div>
  <div class="product-quantity col-xs-2 padding-0">
    <?php if($position->type->description=='ORIGINAL'){ ?>
      <input type="text" class="change_q mobile_input_cart" readonly="readonly" posid="<?= $position->id ?>" value="<?= $position->quantity ?>" />
        <?php }else{ ?>
      <input type="number" class="change_q mobile_input_cart" posid="<?= $position->id ?>" value="<?= $position->quantity ?>" />
        <?php } ?>
  </div>
  <div class="product-removal col-xs-2 padding-0">
    <a class="remove-product" href="<?= Url::to(['site/removefromcart','id'=>$position->id]) ?>">
        Eliminar
    </a>
  </div>
  <div class="product-line-price col-xs-2 padding-0">$<?= number_format((float)($position->getPrice()*$position->quantity)+($position->getPrice()*$position->quantity*0.12), 2, '.', '') ?></div>
</div>