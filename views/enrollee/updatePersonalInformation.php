<?php
/**
 * @var $enrolleeObj \app\models\StudentInformation
 */
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\bootstrap\Html;

?>

<div class="container">
	<div class="row">
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			
		</div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<br>
			<?php if (Yii::$app->session->hasFlash('success')): ?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Success!</strong> <?= Yii::$app->session->getFlash('success') ?>
				</div>
			<?php endif ?>
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $enrolleeObj->title.' '.$enrolleeObj->firstName.' '.$enrolleeObj->lastName ?></h3>
				</div>
				<div class="panel-body">
					<div class="student-information-form">

					    <?php $form = ActiveForm::begin(); ?>

					    <?= 
						    $form
						    ->field($enrolleeObj, 'application_status')
						    ->dropDownList([
						        'New Student'=> 'New Student',
						        'Old Student'=> 'Old Student',
						        'Transferee'=> 'Transferee',
						    ], ['class' => 'form-control'])
						    ->label("Application");
					    ?>

		                <?= 
		                    $form
		                    ->field($enrolleeObj, 'is_first_time')
		                    ->dropDownList([
		                        'Yes'=>'Yes',
		                        'No'=>'No'
		                    ], ['class' => 'form-control','onchange'=>'toggleFirstTimeLocation(this)','prompt'=>'-- Please Select --'])
		                    ->label("Is this your first time to take NVSU-CAT?");
		                ?>
	                    <?= 
	                        $form
	                        ->field($enrolleeObj, 'is_first_time_location')
	                        ->dropDownList([
	                                'Bayombong'=>'Bayombong',
	                                'Bambang'=>'Bambang'
	                            ])
	                        ->label("Where ? ")
	                        ; 
	                    ?>

	                    <?= $form->field($enrolleeObj, 'title')->dropDownList([
	                        'Mr'=>'Mr',
	                        'Mrs'=>'Mrs',
	                        'Ms'=>'Ms',
	                    ]); ?>
	                    <?= $form->field($enrolleeObj, 'firstName') ?>
	                    <?= $form->field($enrolleeObj, 'middleName') ?>
	                    <?= $form->field($enrolleeObj, 'lastName') ?>
	                    <?= $form->field($enrolleeObj, 'phoneNumber') ?>
	                    <?= 
	                        $form
	                        ->field($enrolleeObj, 'birthday')
	                        ->widget(DatePicker::classname(), [
	                            'options' => ['placeholder' => 'Enter birth date ...'],
	                            'pluginOptions' => [
	                                'autoclose'=>true
	                            ]
	                        ]);
	                    ?>
	                    <?= 
	                    $form
	                        ->field($enrolleeObj, 'place_of_birth')
	                        ->label("Place of birth(Town,Province)")
	                        ->textInput(); 
	                    ?>                
	                    <?= 
	                    $form
	                        ->field($enrolleeObj, 'age')
	                        ->label("Age")
	                        ->textInput(); 
	                    ?>
	                    <?= 
	                        $form
	                        ->field($enrolleeObj, 'civil_status')
	                        ->dropDownList([
	                            'Single'=>'Single',
	                            'Married'=>'Married',
	                            'Widowed'=>'Widowed',
	                            'Separated'=>'Separated',
	                            'Divorced'=>'Divorced'
	                        ]); 
	                    ?>
	                    <?= 
	                        $form
	                        ->field($enrolleeObj, 'gender')
	                        ->dropDownList([
	                            'Male'=>'Male',
	                            'Female'=>'Female'
	                        ]); 
	                    ?>
	                    <?= 
	                        $form
	                        ->field($enrolleeObj, 'ethnic_origin')
	                        ->textInput()
	                    ?>                
	                    <?= 
	                        $form
	                        ->field($enrolleeObj, 'citizenship')
	                        ->textInput()
	                    ?>


	                    <legend>Permanent Address</legend>
					    <?= $form->field($enrolleeObj, 'permanent_address_house_number')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'permanent_address_street')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'permanent_address_purok')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'permanent_address_barangay')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'permanent_address_town')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'permanent_address_province')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'permanent_address_postalCode')->textInput(['maxlength' => true]) ?>

					    <br>
					    <br>
					    <legend>Residential Address</legend>

					    <?= $form->field($enrolleeObj, 'residential_address_house_number')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'residential_address_street')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'residential_address_purok')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'residential_address_barangay')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'residential_address_town')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'residential_address_province')->textInput(['maxlength' => true]) ?>

					    <?= $form->field($enrolleeObj, 'residential_address_postalCode')->textInput(['maxlength' => true]) ?>
					    <div class="form-group">
					    	<?= Html::submitButton("Update", ['class' => 'btn btn-success btn-block']); ?>
					    </div>
					    <?php ActiveForm::end(); ?>

					</div>

					
				</div>
			</div>
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			
		</div>
	</div>
</div>
