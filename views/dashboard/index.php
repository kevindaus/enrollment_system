<?php
/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\widgets\Menu;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;


$this->registerJsFile('/assets/vendor/raphael/raphael.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/assets/vendor/morrisjs/morris.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/assets/vendor/morrisjs/morris.css');


?>
<style type="text/css">
	.side-panel ,.main-panel ,.right-panel{
		margin-top: 30px;
	}
	ul.quicksearchResult li{
		padding: 10px 3px;
	}
	ul.quicksearchResult li:before {
		content: "*";
	}
	#course-distribution > svg > text:nth-child(13) > tspan {
		display: none;
	}
</style>

<div class="page-content">
	<div class="row ">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 side-panel">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Side Menu</h3>
					</div>
					<div class="panel-body">
					  	<div class="sidebar" style="display: block;">
						  	<?=
							  	Menu::widget([
							  	    'items' => [
							  	        ['label' => '<i class="glyphicon glyphicon-home"></i> Dashboard', 'url' => ['/dashboard']],
							  	        ['label' => '<i class="glyphicon glyphicon-user"></i> Enrolee', 'url' => ['/dashboard/enrollee']],
							  	    ],
							  		'activeCssClass'=>'activeclass',
							  		'encodeLabels'=>false,
							  		'options'=>[
							  			'class'=>'nav'
							  		],
							  	]);
						  	?>
			            </div>
					</div>
				</div>
	            <div class="panel panel-default">
	            	<div class="panel-heading">
	            		<h3 class="panel-title"><i class="glyphicon glyphicon-search"></i> Search enrollee</h3>

	            	</div>
	            	<div class="panel-body">
	            		<?php if (Yii::$app->session->hasFlash('no_enrollee_found')): ?>
	            			<div class="alert">
	            				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            				<?= Yii::$app->session->getFlash('no_enrollee_found') ?>
	            			</div>
	            		<?php endif ?>
					    <?php 
					        $form = ActiveForm::begin([
					            'enableClientValidation'=>false
					        ]); 
					    ?>
					    <?= $form->field($searchEnrolleeForm, 'searchKey')->textInput()->label(""); ?>
					    <?php ActiveForm::end(); ?>
	            		<?php if ($foundEnrollees): ?>
	            			<strong>Search result : <br><?= count($foundEnrollees) ?> record(s) found</strong>
	            			<ul class="quicksearchResult">
	            			<?php foreach ($foundEnrollees as $currentFoundEnrollee): ?>
	            				<li>
	            					<?= Html::a( $currentFoundEnrollee->title.' '.$currentFoundEnrollee->firstName.' '.$currentFoundEnrollee->middleName.' '.$currentFoundEnrollee->lastName, ['/enrollee/'.$currentFoundEnrollee->id]); ?>
            					</li>
	            			<?php endforeach ?>
	            			</ul>
	            		<?php endif ?>
	            	</div>
	            </div>
			</div>
			<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
				<br>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Today's latest enrollees</h3>
					</div>
					<div class="panel-body">
						<?= 
						GridView::widget([
							'layout' => "{items}\n{summary}{pager}",
							'dataProvider' => $enroleeDataProvider,
							'columns' => [
								[
									'value'=>function($model){
										return sprintf("%s. %s %s %s" ,$model->title , $model->firstName,$model->middleName, $model->lastName);
									},
									'header'=>'Name',
								],
								[
									'value'=>function($model){
										return Html::a("View Info.", '/enrollee/'.$model->id, ['class' => 'btn btn-link text-center btn-block']);
									},
									'header'=>'',
									'format'=>'raw',
								],
							],
							'options'=>[
							]
						]);
						?>
					</div>
				</div>
				<?= $this->render('enrollee_statistics' , compact('maleCount','femaleCount')); ?>

			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<br>
				<h3>Valedictorians</h3>
				<?= 
					GridView::widget([
						'dataProvider' => $valedictoriansDataProvider,
						'columns' => [
							// ['class' => 'yii\grid\SerialColumn'],
							[
								'header'=>'Name',
								'value'=>function($model){
									return $model['title'] . '.' . $model['firstName'].' '.$model['lastName'];
								}
							],					
						],
					]);
				?>
				<hr>
				<h3>Salutatorians</h3>
				<?= 
					GridView::widget([
						'dataProvider' => $salutatoriansDataProvider,
						'columns' => [
							// ['class' => 'yii\grid\SerialColumn'],
							[
								'header'=>'Name',
								'value'=>function($model){
									return $model['title'] . '.' . $model['firstName'].' '.$model['lastName'];
								}
							],					
						]
					]);
				?>
				<hr>
				<h3>Atheletes</h3>
				<?= 
					GridView::widget([
						'dataProvider' => $athletesDataProvider,
						'columns' => [
							// ['class' => 'yii\grid\SerialColumn'],
							[
								'header'=>'Name',
								'value'=>function($model){
									return $model['title'] . '.' . $model['firstName'].' '.$model['lastName'];
								}
							],					
						]
					]);
				?>			
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			
		</div>

		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-right: 30px;">
			<hr>
			<?= $this->render('course_distribution', compact('courseDistributionDatasource') ); ?>
		</div>
	</div>
</div>