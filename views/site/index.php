<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use app\assets\AppAsset;
use yii\web\View;
$this->title = 'LAYOLANDA | CONCEPT_STORE';
$number_b=count($backgrounds);
$back=array();
foreach($backgrounds as $k => $background){
$back[$k]=$background->value;
}
$back=json_encode($back);
$script=<<< JS
var counter = 1;
window.setInterval(changeB, 8000);
    function changeB() { 
    var max=$number_b;
    if(counter==max){
        counter=0;
    }
    var grounds=$back;
    var rand = grounds[counter];
    if(max>1){
        $('.parallax')
        .animate({opacity: 0}, 'slow', function() {
            $(this)
            .css({'background-image': 'url(/images/'+rand+')'})
            .animate({opacity: 1});
            counter++;
        });
    }
}

JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<div class="site-index">


    <div class="body-content">
        <img  class="visible-xs visible-md" src='<?= URL::base() ?>/images/<?= $backgrounds[0]->value ?>'/>
    <div class="parallax hidden-xs hidden-md" style='background-image: url("<?= URL::base() ?>/images/<?= $backgrounds[0]->value ?>");'>
        
<!--      <h1 style="color:white;text-align: center;">Bienvenido</h1> -->
<!--   <span class="scroll-btn">
    <a href="#">
        <span class="mouse">
            <span>
            </span>
        </span>
    </a>
</span> -->
    </div>
<!--       <main style="height: auto">
      <div>Texto de Prueba</div>
    <video class="bv-video"></video>
  </main> -->
        <div class="row products-home">
        <!-- <h2>DESTACADOS</h2> -->
            <?php foreach($products as $product): ?>
            <div class="col-md-4 col-xs-4 img-home">
                <a  href="<?= Url::to(['product/view','id'=>$product->id]) ?>">
            <?php foreach($product->pictures as $picture): ?>
                        <div class="image">
            <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" />
            <!-- <img class="bag2" src="<?= URL::base() ?>/images/bag2.png" /> -->
              <div class="middle">
                <div class="hover-text"><?= $product->title ?></div>

              </div>
              <img class="bag3" src="<?= URL::base() ?>/images/bag2.png" />
          </div>
            <?php break; endforeach; ?>
               
                </a>
            </div>

            <?php endforeach; ?>
        </div>

    </div>
</div>
