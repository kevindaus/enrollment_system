<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Course;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\StudentInformation */
/* @var $form ActiveForm */
/* @var $allAchievements array */


?>

<div class="enrollment-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Personal Information</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'title')->dropDownList([
                    'Mr'=>'Mr',
                    'Mrs'=>'Mrs',
                    'Ms'=>'Ms',
                ]); ?>
                <?= $form->field($model, 'firstName') ?>
                <?= $form->field($model, 'middleName') ?>
                <?= $form->field($model, 'lastName') ?>
                <?= 
                    $form
                    ->field($model, 'birthday')
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
                <h3 class="panel-title">Contact Information</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'emailAddress') ?>
                <?= $form->field($model, 'phoneNumber') ?>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Address Information</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'houseNumber')->hint("e.g #018") ?>
                <?= $form->field($model, 'street')->hint("e.g Gaddang Street") ?>
                <?= $form->field($model, 'barangay')->hint("e.g Quirino") ?>
                <?= $form->field($model, 'postalCode')->hint("e.g 3709") ?>
                <?= $form->field($model, 'city')->label("City (optional)") ?>
                <?= $form->field($model, 'province')->hint("e.g Nueva Vizcaya") ?>
                <?= $form->field($model, 'country')->hint("e.g Philippines") ?>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Other Information</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'height') ?>
                <?= $form->field($model, 'weight') ?>
                <?= 
                $form
                ->field($model, 'bloodType') 
                ->radioList([
                    'A'=>'A',
                    'B'=>'B',
                    'AB'=>'AB',
                    'O'=>'O',
                ]);
                ?>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Education </h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'elementary_graduated') ?>
                <?= $form->field($model, 'highschool_graduated') ?>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Course to take</h3>
            </div>
            <div class="panel-body">
                <!-- Course here -->
                <?= 
                    Html::dropDownList(
                            'courseToTake', 
                            null, 
                            ArrayHelper::map(Course::find()->all(), 'id', 'name'),
                            [
                                'class'=>'form-control'
                            ]
                        );
                ?>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Achievements</h3>
            </div>
            <div class="panel-body">
            <?= 
                Select2::widget([
                    'name' => 'achievements',
                    'data' => $allAchievements,
                    // 'data' => [1 => "First", 2 => "Second", 3 => "Third", 4 => "Fourth", 5 => "Fifth"],
                    'size' => Select2::MEDIUM,
                    'options' => ['placeholder' => 'Select a state ...', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
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
