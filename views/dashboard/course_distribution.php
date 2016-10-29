<?php 

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use hscstudio\chart\ChartNew;

/*extract labels*/
$chartLabels = [];
$chartVals = [];
$chartDataSource = [];
foreach ($courseDistributionDatasource as $key => $currentCourseDistrib) {
    $chartDataSource[] =[
        'course_label'=>$currentCourseDistrib['course_name'],
        'course_count'=>floatval($currentCourseDistrib['course_count'])
    ];
    $chartLabels[] = $currentCourseDistrib['course_name'];
    $chartVals[] = floatval($currentCourseDistrib['course_count']);
}

$chartDataSource = yii\helpers\Json::encode($chartDataSource);

$customScript = <<< SCRIPT
    Morris.Bar({
        element: 'course-distribution',
        data: $chartDataSource,
        xkey: 'course_label',
        ykeys: ['course_count'],
        labels: ['Course'],
        hideHover: 'auto',
        resize: true,
        stacked: true
    });
SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_READY);



?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">
            Course Distribution
        </h3>
    </div>
    <div class="panel-body">
        <div id="course-distribution"></div>
    </div>
</div>