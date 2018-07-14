<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\View;
use yii\helpers\Url;
use kartik\widgets\Typeahead;
use yii\web\JsExpression;
use app\models\Category;
use app\models\Content;
$categories=Category::find()->where(['category_id'=>NULL])->orderBy(['sort' => SORT_ASC])->all();
$contents=Content::find()->where(['section'=>'FOOTER','type'=>'POLITICS'])->orderBy(['sort' => SORT_ASC])->all();
$contents2=Content::find()->where(['section'=>'FOOTER','type'=>'BUSINESS'])->orderBy(['sort' => SORT_ASC])->all();
function issetor(&$var, $default = false) {
    return isset($var) ? $var : $default;
}
/* @var $this \yii\web\View */
/* @var $content string */

$script=<<< JS
(function(){ var widget_id = 'GQI9lZPPo4';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
   $(".btn-cerrarw").click(function(){
       $(".flash_message_warning").fadeOut();
       $(".flash_message_success").fadeOut();
       });
$(document).ready(function () {
        $(".navbar-toggle").on("click", function () {
            $(this).toggleClass("active");
        });
    });
$(document).ready(function(){
  var altura = $('.main-menu').offset().top;
  
  // $(window).on('scroll', function(){
  //   if ( $(window).scrollTop() > altura ){
  //     $('.main-menu').addClass('menu-fixed');
  //   } else {
  //     $('.main-menu').removeClass('menu-fixed');
  //   }
  // });
  var isMobile = /Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
  if(!isMobile) {
    $(".container-right").css('float','right');
 $("#top-menu2").sticky({topSpacing:0,responsiveWidth:true,zIndex:10});
 $('#top-menu2').on('sticky-start', function() { $('#top-menu2').addClass('sticky');$('.logosticky').css({'visibility':'visible','opacity':1}); });
 $('#top-menu2').on('sticky-end', function() { $('#top-menu2').removeClass('sticky');$('.logosticky').css({'visibility':'hidden','opacity':0}); });
$('.sidebar').affix({
  offset: {
    top: 235,
       bottom: function () {
      return (this.bottom = $('footer').outerHeight(true))
    }
  }
});
  }
$(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show'); 
});
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=1314153345311081";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="fb:app_id" content="1314153345311081" />
    <meta property="og:url" content="<?= URL::base(true).Yii::$app->request->url ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= issetor($this->params['title-face'],'La Yolanda Concept Store') ?>" />
    <meta property="og:image" content="<?= issetor($this->params['img-face'],'http://layolanda.com/web/images/logo.png') ?>" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="400" />
    <meta property="og:description" content="<?= issetor($this->params['description-face'],'La Yolanda') ?>" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    <?= Html::csrfMetaTags() ?>
    <title>LAYOLANDA | <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<div id="fb-root"></div>
<?php $this->beginBody() ?>
    <div class="wrap">
<?php if(Yii::$app->getSession()->getFlash('success')){ ?>
<div class="flash_message_success">
 <?= Yii::$app->getSession()->getFlash('success'); ?>
 <div class="btn-cerrarw"><img src="<?= URL::base() ?>/images/btn-cerrarw.svg"/></div>
</div>
    <?php } ?>
    <?php if(Yii::$app->getSession()->getFlash('warning')){ ?>
<div class="flash_message_warning">
 <?= Yii::$app->getSession()->getFlash('warning'); ?>
  <div class="btn-cerrarw"><img src="<?= URL::base() ?>/images/btn-cerrarw.svg"/></div>
</div>
    <?php } ?>
        <nav  id="nav-menu2"class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
             <a class="navbar-brand" href="<?= Url::to(['/site/home']) ?>">
                <img alt="Brand" src="<?= URL::base() ?>/images/logo.svg">
              </a>
    </div>
          <div id="top-menu" class="container-fluid">
            
   <!--            <a class="navbar-brand" href="<?= URL::base() ?>">
                <img alt="Brand" src="<?= URL::base() ?>/images/logo.png">
              </a> -->

                <div class=" row container-search-user">  
                  <div class="row user-nav">

                    <ul class="nav navbar-nav user-container-nav">

                        <!-- <li><a class="bag-layout" href="#"><img src="<?= URL::base() ?>/images/es.png" /></a></li> -->
                        <?php if(Yii::$app->language=="es"): ?>
                        <li><a class="bag-layout" href="<?= Url::to(['site/setlang','lang'=>'en_EN']) ?>"><img src="<?= URL::base() ?>/images/es1.svg" /></a></li>
                         <?php else: ?>
                          <li><a class="bag-layout" href="<?= Url::to(['site/setlang','lang'=>'es']) ?>"><img src="<?= URL::base() ?>/images/en1.svg"/></a></li>
                         <?php endif; ?>

                        <li><a class="bag-layout" href="<?= Url::to(['site/viewcart']) ?>"><img src="<?= URL::base() ?>/images/bag1.svg" /><span class="hidden-xs"><?=Yii::t('label', 'Bag') ?></span></a></li>
                         <?php if(Yii::$app->user->isGuest){ ?>
                        <li><a class="bag-layout" href="<?= Url::to(['site/login']) ?>"><img src="<?= URL::base() ?>/images/user.svg" /><span class="hidden-xs"><?=Yii::t('label', 'Log In') ?></span></a></li>
                        <?php }else{ ?>
                        <li><a class="bag-layout" style="margin-top:3px;"href="<?= Url::to(['site/logout']) ?>"><span><?=Yii::t('label', 'Log Out') ?></span></a></li>
                        <li><a class="bag-layout" href="<?= Url::to(['user/index']) ?>"><img src="<?= URL::base() ?>/images/user.svg" /><span class="hidden-xs"><?= Yii::$app->user->identity->names ?></span></a></li>
                        
                        <?php } ?>
                    
                    </ul>
                  </div>
                      <div class="search-container row">
                                <?= Typeahead::widget([
                  'name' => 'search',
                  'options' => ['placeholder' => ''],
                  'scrollable' => true,
                  'pluginOptions' => ['highlight'=>true],
                  'dataset' => [
                      [
                          'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                          'display' => 'value',
                           'templates' => [
                            'suggestion' => new JsExpression("Handlebars.compile('<a href=\'".URL::base()."/product/view?id={{id}}\' >{{value}}</a>')")
                          ],
                          'remote' => [
                            'url' => Url::to(['site/search2']) . '?q=%QUERY',
                            'wildcard' => '%QUERY'
                          ]
                      ]
                   ]
                ]); ?>
                <img class="img-search" src="<?= URL::base() ?>/images/lupa.svg" />
              </div>
            </div>
          </div>
        </nav>
        <nav class="navbar navbar-default" role="navigation">
               <div class="navbar-header">
      <button id="button-menu2" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-menu2" aria-expanded="false">
        <span class="icon-bar top-bar"></span>
        <span class="icon-bar middle-bar"></span>
        <span class="icon-bar bottom-bar"></span>
      </button>
    </div>
          <div id="top-menu2" class="container-fluid collapse navbar-collapse collapse-center">
                           <a class="navbar-brand logosticky" href="<?= URL::base() ?>">
                <img alt="Brand" src="<?= URL::base() ?>/images/logosticky.svg">
              </a>
        <ul class="nav navbar-nav main-menu">
            <?php foreach($categories as $category): $id=$category->categories[0]->categories[0]->id ?>

              <li><a href="<?= Url::to(['category/subcategory','id'=>$category->categories[0]->categories[0]->id]) ?>"><?= $category->description ?></a></li>
            <?php endforeach; ?>
            <li><a href="<?= Url::to(['category/artist']) ?>"><?= Yii::t('category', 'Artist') ?></a></li>
        </ul>
          </div>
        </nav>
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
<!--         <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a> -->
    </div>

    <footer class="footer">
        <div class="container row">
        <div class="col-sm-3">
          <h4><?= Yii::t('footer', 'Follow Us') ?></h4>
            <p><a href="https://www.facebook.com/Layolanda-123756124859223/">Facebook</a></p>
            <p><a href="https://twitter.com/layolanda_cs">Twitter</a></p>
            <p><a href="https://www.instagram.com/layolanda_cs/">Instagram</a></p>
            <p><a href="https://www.pinterest.com/layolanda_cs/">Pinterest</a></p>
        </div>
          <div class="col-sm-3">
          <h4><?= Yii::t('footer', 'Politics') ?></h4>
          <?php foreach($contents as $cont): ?>
            <p><a href="<?= Url::to(['site/content','id'=>$cont->id]) ?>"><?= $cont->titlet ?></a></p>
        <?php endforeach ?>
          </div>
          <div class="col-sm-3">
          <h4><?= Yii::t('footer', 'Business') ?></h4>
          <?php foreach($contents2 as $cont): ?>
            <p><a href="<?= Url::to(['site/content','id'=>$cont->id]) ?>"><?= $cont->titlet ?></a></p>
        <?php endforeach ?>
          </div>
        </div>
        <div class="footer2 row">
          <div class="col-sm-6">
            <p>ECUADOR</p>
            <p>LA YOLANDA <?= date('Y') ?> <?= Yii::t('footer', 'Al Rights Reserved') ?></p>
            </div>
            <div class="col-sm-6" style="text-align: right;">
            <p><a href="<?= Url::to(['site/setlang','lang'=>'es']) ?>">ESPAÑOL</a></p>
            <p><a href="<?= Url::to(['site/setlang','lang'=>'en_EN']) ?>">INGLÉS</a></p>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
