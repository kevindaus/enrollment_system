<?php 

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use hscstudio\chart\ChartNew;

?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">
            Course Distribution
        </h3>
    </div>
    <div class="panel-body">
                        <?= 
                        GridView::widget([
                            'layout' => "{items}\n{summary}{pager}",
                            'dataProvider' => $courseEnrolleeDataProvider,
                            'columns' => [
                                'course',
                                'enrollee_count'
                                // [
                                //     'value'=>function($model){
                                //         return sprintf("%s. %s %s %s" ,$model->title , $model->firstName,$model->middleName, $model->lastName);
                                //     },
                                //     'header'=>'Name',
                                // ],
                                // [
                                //     'value'=>function($model){
                                //         return Html::a("View Info.", '/enrollee/'.$model->id, ['class' => 'btn btn-link text-center btn-block']);
                                //     },
                                //     'header'=>'',
                                //     'format'=>'raw',
                                // ],
                            ],
                            'options'=>[
                            ]
                        ]);
                        ?>

    </div>
</div>