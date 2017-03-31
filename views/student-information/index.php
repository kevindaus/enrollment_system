<?php
use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $studentModel \app\models\StudentInformation */
?>

<div class="row">
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	</div>
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		<hr>
		<?php if (isset(Yii::$app->request->cookies['serial_number'])): ?>
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<b>
					Your LOGIN KEY IS : 
					<strong style='font-size: 15px'><?= Yii::$app->request->cookies['serial_number'] ?></strong>	
				</b> 
			</div>
		<?php endif ?>		
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Schedule</h3>
			</div>
			<div class="panel-body">
				<h1 class="text-center">
					Examination Date - <?= $examinationDate ?>
				</h1>
				<?php if ($examinationDate !== 'Not Set'): ?>
					<?= Html::a("<span class='glyphicon glyphicon-print' aria-hidden='true'></span>"." Print Permit", '/student-information/'.$studentModel->serial_number.'/print', ['class' => 'btn btn-primary btn-block','style'=>'font-size: 30px']); ?>			
				<?php endif ?>
			</div>
		</div>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Your Information</h3>
			</div>
			<div class="panel-body">
                <?=
                DetailView::widget([
                    'model' => $studentModel,
                    'attributes' => [
                        'id',
                        [
                            'label' => 'Date of Application',
                            'value' => \Yii::$app->formatter->asDate($studentModel->date_taken, 'long')
                        ],
                        'application_status',
                        'is_first_time',
                        [
                            'label'=>'NVSU-CAT (Location)',
                            'value'=>$studentModel->is_first_time_location
                        ],
                        'title',
                        'firstName',
                        'middleName',
                        'lastName',
                        'phoneNumber',
                        'houseNumber',
                        [
                            'label' => 'Birthday',
                            'value' => \Yii::$app->formatter->asDate($studentModel->birthday, 'long')
                        ],

						'permanent_address_house_number',
						'permanent_address_street',
						'permanent_address_purok',
						'permanent_address_barangay',
						'permanent_address_town',
						'permanent_address_province',
						'permanent_address_postalCode',
						// 'residential_address_house_number',
						// 'residential_address_street',
						// 'residential_address_purok',
						// 'residential_address_barangay',
						// 'residential_address_town',
						// 'residential_address_province',
						// 'residential_address_postalCode',
                        'place_of_birth',
                        'civil_status',
                        'gender',
                        'ethnic_origin',
                        'citizenship',
                        'serial_number',
                    ],
                ]) ?>				
			</div>
		</div>
	</div>
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	</div>
</div>