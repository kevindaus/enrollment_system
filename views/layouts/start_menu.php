<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$navItems = [
  ['label' => 'Home', 'url' => ['/site/index']],
  ['label' => 'Enroll', 'url' => ['/enroll']],
  ['label' => 'Reminder', 'url' => ['/reminder']],
  ['label' => 'Dashboard', 'url' => ['/dashboard'] , 'visible'=> \Yii::$app->user->can('admin') ]
];

$navItems[] =  ['label' => 'Search', 'url' => ['/student-login']];
if (!Yii::$app->user->isGuest) {
  $navItems[] =  ['label' => "Logout (".Yii::$app->user->identity->username.")", 'url' => ['/logout'] , 'visible'=> !Yii::$app->user->isGuest ];
}
?>
  <section id="mu-menu">
    <nav class="navbar navbar-default" role="navigation">  
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->              
          <!-- TEXT BASED LOGO -->
          <a class="navbar-brand" href="index.html"><i class="fa fa-university"></i><span><?= Yii::$app->name ?></span></a>
          <!-- IMG BASED LOGO  -->
          <!-- <a class="navbar-brand" href="index.html"><img src="assets/img/logo.png" alt="logo"></a> -->
        </div>
       <?php
      NavBar::begin([
          'id'=>"topNav",
          'options' => [
              'class' => 'navbar',
              // 'class' => 'navbar-collapse collapse',
          ],
      ]);
      echo Nav::widget([
          'options' => ['class' => 'navbar-nav navbar-right'],
          'items' => $navItems,
      ]);
      NavBar::end();
      ?>
      </div>     
    </nav>
  </section>
