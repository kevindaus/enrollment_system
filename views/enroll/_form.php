<?php
/* @var $this yii\web\View */
/* @var $newStudent app\models\StudentInformation */
/* @var $form ActiveForm */
/* @var $allAchievements array */


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Course;
use kartik\widgets\Select2;
use kartik\tabs\TabsX;
use yii\helpers\Url;


?>


<div class="enrollment-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"></h3>
            </div>
            <div class="panel-body">
                <?= Html::errorSummary($newStudent); ?>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Personal Information</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($newStudent, 'title')->dropDownList([
                    'Mr'=>'Mr',
                    'Mrs'=>'Mrs',
                    'Ms'=>'Ms',
                ]); ?>
                <?= $form->field($newStudent, 'firstName') ?>
                <?= $form->field($newStudent, 'middleName') ?>
                <?= $form->field($newStudent, 'lastName') ?>
                <?= 
                    $form
                    ->field($newStudent, 'birthday')
                    ->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Enter birth date ...'],
                        'pluginOptions' => [
                            'autoclose'=>true
                        ]
                    ]);

                ?>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Permanent Address</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($newStudent, 'permanent_address_house_number')->hint("e.g #018") ?>
                <?= $form->field($newStudent, 'permanent_address_street')->hint("e.g Gaddang Street") ?>
                <?= $form->field($newStudent, 'permanent_address_purok')->hint("e.g Purok Tres") ?>
                <?= $form->field($newStudent, 'permanent_address_barangay')->hint("e.g Barangay Roxas") ?>
                <?= $form->field($newStudent, 'permanent_address_town')->hint("e.g Solano") ?>
                <?= $form->field($newStudent, 'permanent_address_province')->hint("e.g Nueva Vizcaya") ?>
                <?= $form->field($newStudent, 'permanent_address_postalCode')->hint("e.g Philippines") ?>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Residential Address</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($newStudent, 'residential_address_house_number')->hint("e.g #018") ?>
                <?= $form->field($newStudent, 'residential_address_street')->hint("e.g Gaddang Street") ?>
                <?= $form->field($newStudent, 'residential_address_purok')->hint("e.g Purok Tres") ?>
                <?= $form->field($newStudent, 'residential_address_barangay')->hint("e.g Barangay Roxas") ?>
                <?= $form->field($newStudent, 'residential_address_town')->hint("e.g Solano") ?>
                <?= $form->field($newStudent, 'residential_address_province')->hint("e.g Nueva Vizcaya") ?>
                <?= $form->field($newStudent, 'residential_address_postalCode')->hint("e.g Philippines") ?>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Educational Attainment </h3>
            </div>
            <div class="panel-body">
            <?php $this->beginBlock('elementary') ?>
                <?= $form->field($elementaryEducationalAttainment, 'education')->textInput(['disabled' => 'disabled'])->label('Educational Attainment'); ?>
                <?= $form->field($elementaryEducationalAttainment, 'name_of_school')->textInput(); ?>
                <?= $form->field($elementaryEducationalAttainment, 'address_of_school')->textInput(); ?>
                <?= $form->field($elementaryEducationalAttainment, 'inclusive_dates_of_attendance')->textInput(); ?>
            <?php $this->endBlock() ?>

            <?php $this->beginBlock('secondary') ?>
                <?= $form->field($secondaryEducationalAttainment, 'education')->textInput(['disabled' => 'disabled'])->label('Educational Attainment'); ?>
                <?= $form->field($secondaryEducationalAttainment, 'name_of_school')->textInput(); ?>
                <?= $form->field($secondaryEducationalAttainment, 'address_of_school')->textInput(); ?>
                <?= $form->field($secondaryEducationalAttainment, 'inclusive_dates_of_attendance')->textInput(); ?>
            <?php $this->endBlock() ?>

            <?php $this->beginBlock('vocational') ?>
                <?= $form->field($vocationalEducationalAttainment, 'education')->textInput(['disabled' => 'disabled'])->label('Educational Attainment'); ?>
                <?= $form->field($vocationalEducationalAttainment, 'name_of_school')->textInput(); ?>
                <?= $form->field($vocationalEducationalAttainment, 'address_of_school')->textInput(); ?>
                <?= $form->field($vocationalEducationalAttainment, 'inclusive_dates_of_attendance')->textInput(); ?>
            <?php $this->endBlock() ?>

            <?php $this->beginBlock('ternary') ?>
                <?= $form->field($tertiaryEducationalAttainment, 'education')->textInput(['disabled' => 'disabled'])->label('Educational Attainment'); ?>
                <?= $form->field($tertiaryEducationalAttainment, 'name_of_school')->textInput(); ?>
                <?= $form->field($tertiaryEducationalAttainment, 'address_of_school')->textInput(); ?>
                <?= $form->field($tertiaryEducationalAttainment, 'inclusive_dates_of_attendance')->textInput(); ?>

            <?php $this->endBlock() ?>

            <?= Html::errorSummary($elementaryEducationalAttainment); ?>
            <?= Html::errorSummary($secondaryEducationalAttainment); ?>
            <?= Html::errorSummary($vocationalEducationalAttainment); ?>
            <?= Html::errorSummary($tertiaryEducationalAttainment); ?>
            <?= 
            TabsX::widget([
                'items'=>[
                    [
                        'label'=>'Elementary',
                        'content'=>$this->blocks['elementary'],
                        'active'=>true,
                    ],
                    [
                        'label'=>'Secondary',
                        'content'=>$this->blocks['secondary'],
                    ],
                    [
                        'label'=>'Vocational',
                        'content'=>$this->blocks['vocational'],
                    ],
                    [
                        'label'=>'Ternary',
                        'content'=>$this->blocks['ternary'],
                    ],
                ],
                'position'=>TabsX::POS_LEFT,
                'encodeLabels'=>false
            ]); 
            ?>

            </div>
        </div>

    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg pull-right']) ?>
        </div>
        <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div><!-- enroll-_form -->
