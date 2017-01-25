<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">
            <strong>Available Courses</strong>
        </h3>
    </div>
    <div class="panel-body">
        <div class="course-index">
            <p>
                <?= Html::a('Create Course', ['create'], ['class' => 'btn btn-success pull-right']) ?>
            </p>
            <div class="clearfix"></div>


            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id:ntext',
                    'course_name:ntext',
                    'course_description:ntext',
                    // 'created_at',
                    // 'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>

