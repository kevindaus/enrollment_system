<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


$this->registerJsFile('/assets/js/slick.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/assets/js/waypoints.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/assets/js/jquery.counterup.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/assets/js/jquery.counterup.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/assets/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


AppAsset::register($this);

$customCss = <<< SCRIPT
  #main-content {
    min-height: 550px;
  }
  #mu-menu > nav > div > div > a > span {
    font-size: 22px;
    position: relative;
    top: -5px;
  }
SCRIPT;
$this->registerCss($customCss);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->name ?> | <?= $this->title ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <!-- Font awesome -->
    <link href="/assets/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">   
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="/assets/css/slick.css">          
    <!-- Theme color -->
    <link id="switcher" href="/assets/css/theme-color/default-theme.css" rel="stylesheet">          

    <!-- Main style sheet -->
    <link href="/assets/css/style.css" rel="stylesheet">    

   
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php $this->head() ?>
  </head>
  <body> 
    <?php $this->beginBody() ?>
  <!--START SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="/#">
      <i class="fa fa-angle-up"></i>      
    </a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header  -->
  <?php require_once 'header.php'; ?>
  <!-- End header  -->
  <!-- Start menu -->
  <?php require_once 'start_menu.php'; ?>
  <!-- End menu -->
  <!-- Start search box -->
  <?php //require_once 'search.php'; ?>
  <!-- End search box -->

  <?php require_once 'bread_crumb.php'; ?>
  <div id="main-content">
    <?= $content ?>
  </div>

  <!-- Start footer -->
  <?php require_once 'footer.php'; ?>
  <!-- End footer -->
    
  <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>