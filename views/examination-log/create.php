<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ExaminationLog */

$this->title = 'Create Examination Log';
$this->params['breadcrumbs'][] = ['label' => 'Examination Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="examination-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
