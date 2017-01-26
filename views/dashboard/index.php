<?php 
use yii\grid\GridView;
use kartik\tabs\TabsX;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;



$this->registerJsFile('/assets/vendor/raphael/raphael.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/assets/vendor/morrisjs/morris.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/assets/vendor/morrisjs/morris.css');

?>

<div class="row">
	<br>
	<?= $this->render('enrollee_exam_calendar'); ?>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">							
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
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<br>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Achievers</h3>
			</div>
			<div class="panel-body">
	            <?= 
		            TabsX::widget([
		                'items'=>[
		                    [
		                        'label'=>'Valedictorians',
		                        'content'=>$this->render('_achiever_template', ['dataProvider' => $valedictoriansDataProvider,'title'=>"Valedictorians"]),
		                        'active'=>true,
		                    ],
		                    [
		                        'label'=>'Salutatorians',
		                        'content'=>$this->render('_achiever_template', ['dataProvider' => $salutatoriansDataProvider,'title'=>"Salutatorians"]),
		                        'active'=>false,
		                    ],			                    
		                    [
		                        'label'=>'Atheletes',
		                        'content'=>$this->render('_achiever_template', ['dataProvider' => $athletesDataProvider,'title'=>"Atheletes"]),
		                        'active'=>false,
		                    ]
		                ],
		                'encodeLabels'=>false
		            ]); 
	            ?>
			</div>
		</div>			
	</div>
</div>


<div class="row">
	<?= $this->render('course_distribution', compact('courseEnrolleeDataProvider') ); ?>
</div>

<?php $this->beginBlock('additional_side_panel') ?>
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
<?php $this->endBlock() ?>