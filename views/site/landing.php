<?php
use yii\helpers\Url;
function issetor(&$var, $default = false) {
    return isset($var) ? $var : $default;
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>La Yolanda</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="La Yolanda">
    <meta property="fb:app_id" content="1314153345311081" />
    <meta property="og:url" content="<?= URL::base(true).Yii::$app->request->url ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="La Yolanda Concept Store" />
    <meta property="og:image" content="<?=URL::base(true).'/images/background-photo.jpg' ?>" />
    <meta property="og:description" content="<?= issetor($this->params['description-face'],'La Yolanda') ?>" />
  <link rel="icon" href="http://sixrevisions.com/favicon.ico" type="image/x-icon" />
  
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- Not required: presentational-only.css only contains CSS for prettifying the demo -->
  <link rel="stylesheet" href="<?= URL::base()?>/presentational-only/presentational-only.css">

  <!-- responsive-full-background-image.css stylesheet contains the code you want -->
  <link rel="stylesheet" href="<?= URL::base()?>/responsive-full-background-image.css">
  
  <!-- Not required: jquery.min.js and presentational-only.js is only used to demonstrate scrolling behavior of the viewport  -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="<?= URL::base()?>/presentational-only/presentational-only.js"></script>
</head>
<body>
  <div class="logo">
  <img src="<?= URL::base()?>/images/logo.svg">
  </div>
  <header class="container" >
    <section class="content" style="vertical-align: bottom;">
      <a class="button"  href="/site/setlang?lang=es">Spanish</a>
      <a class="button"  href="/site/setlang?lang=en_EN">English</a>
    </section>
  </header>
</body>
</html>
</html>