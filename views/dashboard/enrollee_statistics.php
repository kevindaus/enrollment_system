<?php 

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use hscstudio\chart\ChartNew;

$customScript = <<< SCRIPT
    Morris.Donut({
        element: 'enrolle_gender_stats',
        data: [{
            label: "Male",
            value: $maleCount
        }, {
            label: "Female",
            value: $femaleCount
        }],
        resize: true
    });  

SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_READY);
?>
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Gender Statistics</h3>
  </div>
  <div class="panel-body">
    <div class="" id="enrolle_gender_stats" style="height: 205px">
    </div>              
  </div>
</div>
