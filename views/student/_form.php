<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-information-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'college_admission_test_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'official_receipt_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_taken')->textInput() ?>

    <?= $form->field($model, 'profile_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'application_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_first_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_first_time_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middleName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'houseNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permanent_address_house_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permanent_address_street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permanent_address_purok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permanent_address_barangay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permanent_address_town')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permanent_address_province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permanent_address_postalCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'residential_address_house_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'residential_address_street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'residential_address_purok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'residential_address_barangay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'residential_address_town')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'residential_address_province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'residential_address_postalCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'place_of_birth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'civil_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ethnic_origin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'citizenship')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'signature_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
