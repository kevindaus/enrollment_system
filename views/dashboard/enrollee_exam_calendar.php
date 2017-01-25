<?php
/**
 * @var $testScheduleCollection mixed
 */
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->registerCss('
    .fc-title {
        cursor: pointer !important;
    }
')


?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Examination Schedule</h3>
		</div>
		<div class="panel-body">
			<?=

            yii2fullcalendar\yii2fullcalendar::widget([
			      'ajaxEvents' => Url::to(['/examination-log/json']),
				  'clientOptions' => [
					    'editable' => true,
					    'droppable' => true,
					    'eventClick'=> new \yii\web\JsExpression('
                            function(calEvent, jsEvent, view) {
                            	window.location.href = "/schedule/"+$.datepicker.formatDate( "yy-mm-dd", new Date(calEvent.start));
                            }
					    ')
				    ],
			    ]);
			?>
		</div>
	</div>
</div>	