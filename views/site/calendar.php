<?php 
use yii\helpers\Url;

?>
<style type="text/css">
	span.fc-time {
		display: none;
	}
	#w0 > div.fc-view-container > div > table > tbody > tr > td > div > div > div:nth-child(2) > div.fc-content-skeleton > table > tbody > tr > td:nth-child(2) > a > div {
		cursor: pointer!important;
	}
</style>

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