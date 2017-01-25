<?php
/* @var $this yii\web\View */
/* @var $dataCollection \yii\data\ActiveDataProvider */


use yii\grid\GridView;
use yii\helpers\Html;

$date = strtotime($date);

$this->title = 'Examinee scheduled for '. Html::encode(Yii::$app->formatter->asDate($date));
// $this->title = 'View Examinee';

$this->params['breadcrumbs'][] = 'Exam Schedule';
?>
<div class="row">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <br>
        <div class="examination-log-view">
            <h1><?= Html::encode($this->title) ?></h1>
            <?= GridView::widget([
                'dataProvider' => $dataCollection,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'Name',
                        'format'    => 'raw',
                        'value'     => function ($model, $key, $index, $column) {
                            $studentModel = $model->getStudent();
                            return sprintf("%s %s %s",$studentModel->title , $studentModel->firstName,$studentModel->lastName);
                        }
                    ],
                ]
            ]);?>
        </div>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    </div>
</div>
