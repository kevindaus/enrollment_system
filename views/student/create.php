<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StudentInformation */

$this->title = 'Create Student Information';
$this->params['breadcrumbs'][] = ['label' => 'Student Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-information-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
