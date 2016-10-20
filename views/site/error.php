<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;

?>
<div class="row">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h1 style="font-size: 100px" class="text-center">
            <?= Html::encode($exception->statusCode) ?>
            <br>
            <small>
                <?= nl2br(Html::encode($exception->getMessage())) ?>
            </small>
        </h1>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    </div>

</div>
