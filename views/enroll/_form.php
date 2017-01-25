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
use kartik\widgets\TypeaheadBasic;

use kartik\file\FileInput;


?>
<script type="text/javascript">
    function toggleFirstTimeLocation(currentDom) {
        currentDom = jQuery(currentDom);
        if (currentDom.val() == 'Yes') {
            //show first time location
            jQuery("#firstTimeLocationContainer").show();
        } else {
            jQuery("#firstTimeLocationContainer").hide();
        }
    }
</script>
<div class="enrollment-form">
<?php
        $form = ActiveForm::begin([
            'enableClientValidation' => false,
            'options' => ['enctype' => 'multipart/form-data']]
        );
?>
<?php if ($newStudent->hasErrors()): ?>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">Error:</h3>
        </div>
        <div class="panel-body">
            <?= Html::errorSummary($newStudent); ?>
        </div>
    </div>
<?php endif ?>


<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Basic Requirement</h3>
    </div>
    <div class="panel-body">
        <label>Student Picture</label>
        <?=
        FileInput::widget([
            'model' => $newStudent,
            'attribute' => 'student_picture',
        ]);
        ?>
        <hr>
        <label>Transcsript of Record or ALS certificate</label>
        <?=
        FileInput::widget([
            'model' => $newStudent,
            'attribute' => 'requirement_certificate',
        ]);
        ?>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">APPLICATION STATUS </h3>
    </div>
    <div class="panel-body">
        <?=
        $form
            ->field($newStudent, 'application_status')
            ->dropDownList([
                'New Student' => 'New Student',
                'Old Student' => 'Old Student',
                'Transferee' => 'Transferee',
            ], ['class' => 'form-control'])
            ->label("");
        ?>
        <?=
        $form
            ->field($newStudent, 'is_first_time')
            ->dropDownList([
                'Yes' => 'Yes',
                'No' => 'No'
            ], ['class' => 'form-control', 'onchange' => 'toggleFirstTimeLocation(this)', 'prompt' => '-- Please Select --'])
            ->label("Is this your first time to take NVSU-CAT?");
        ?>
        <div id="firstTimeLocationContainer" style="display: none">
            <?=
            $form
                ->field($newStudent, 'is_first_time_location')
                ->dropDownList([
                    'Bayombong' => 'Bayombong',
                    'Bambang' => 'Bambang'
                ])
                ->label("Where ? ");
            ?>
        </div>


    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Preferred Course</h3>
    </div>
    <div class="panel-body">
        <label>1st Preferred Course</label>
        <?= Html::activeDropDownList($preferredCourseForm, 'firstPreferredCourse', $allAvailableCourses, ['class' => 'form-control']); ?>
        <br>
        <label>2nd Preferred Course</label>
        <?= Html::activeDropDownList($preferredCourseForm, 'secondPreferredCourse', $allAvailableCourses, ['class' => 'form-control']); ?>
        <br>
        <label>3rd Preferred Course</label>
        <?= Html::activeDropDownList($preferredCourseForm, 'thirdPreferredCourse', $allAvailableCourses, ['class' => 'form-control']); ?>
        <br>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Personal Information</h3>
    </div>
    <div class="panel-body">
        <?=
        $form->field($newStudent, 'title')->dropDownList([
            'Mr' => 'Mr',
            'Mrs' => 'Mrs',
            'Ms' => 'Ms',
        ]); ?>
        <?= $form->field($newStudent, 'firstName') ?>
        <?= $form->field($newStudent, 'middleName') ?>
        <?= $form->field($newStudent, 'lastName') ?>
        <?= $form->field($newStudent, 'phoneNumber') ?>
        <?=
        $form
            ->field($newStudent, 'birthday')
            ->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter birth date ...'],
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]);
        ?>
        <?=
        $form
            ->field($newStudent, 'place_of_birth')
            ->label("Place of birth(Town,Province)")
            ->textInput();
        ?>
        <?=
        $form
            ->field($newStudent, 'age')
            ->label("Age")
            ->textInput();
        ?>
        <?=
        $form
            ->field($newStudent, 'civil_status')
            ->dropDownList([
                'Single' => 'Single',
                'Married' => 'Married',
                'Widowed' => 'Widowed',
                'Separated' => 'Separated',
                'Divorced' => 'Divorced'
            ]);
        ?>
        <?=
        $form
            ->field($newStudent, 'gender')
            ->dropDownList([
                'Male' => 'Male',
                'Female' => 'Female'
            ]);
        ?>
        <?=
        $form
            ->field($newStudent, 'ethnic_origin')
            ->textInput()
        ?>
        <?=
        $form
            ->field($newStudent, 'citizenship')
            ->textInput()
        ?>
    </div>
</div>
<div class="panel panel-default">
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
        <?= $form->field($newStudent, 'permanent_address_postalCode')->hint("e.g 3709 for Solano") ?>
    </div>
</div>
<div class="panel panel-default">
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
        <?= $form->field($newStudent, 'residential_address_postalCode')->hint("e.g 3709 for Solano") ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Educational Attainment </h3>
    </div>
    <div class="panel-body">
        <?php $this->beginBlock('elementary') ?>
        <label>Name of School</label>
        <?=
        TypeaheadBasic::widget([
            'model' => $elementaryEducationalAttainment,
            'attribute' => 'name_of_school',
            'data' => $allElementarySchools,
            'options' => ['placeholder' => 'Filter as you type ...'],
            'pluginOptions' => ['highlight' => true],
        ]);
        ?>
        <?= $form->field($elementaryEducationalAttainment, 'address_of_school')->textInput(); ?>
        <?= $form->field($elementaryEducationalAttainment, 'inclusive_dates_of_attendance')->textInput()->hint("e.g 2004-2008"); ?>
        <label>Award Achivements</label>
        <?=
        Select2::widget([
            'name' => 'elementaryEducationalAttainmentAwards',
            'data' => $allAchievements,
            'options' => ['placeholder' => 'Select...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
        ?>

        <?php $this->endBlock() ?>

        <?php $this->beginBlock('secondary') ?>

        <label>Name of School</label>
        <?=
        TypeaheadBasic::widget([
            'model' => $secondaryEducationalAttainment,
            'attribute' => 'name_of_school',
            'data' => $allHighSchools,
            'options' => ['placeholder' => 'Filter as you type ...'],
            'pluginOptions' => ['highlight' => true],
        ]);
        ?>
        <?= $form->field($secondaryEducationalAttainment, 'address_of_school')->textInput(); ?>
        <?= $form->field($secondaryEducationalAttainment, 'inclusive_dates_of_attendance')->textInput()->hint("e.g 2004-2008");; ?>
        <label>Award Achivements</label>
        <?=
        Select2::widget([
            'name' => 'secondaryEducationalAttainmentAwards',
            'data' => $allAchievements,
            'options' => ['placeholder' => 'Select...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
        ?>
        <?php $this->endBlock() ?>

        <?php $this->beginBlock('vocational') ?>

        <label>Name of School</label>
        <?=
        TypeaheadBasic::widget([
            'model' => $vocationalEducationalAttainment,
            'attribute' => 'name_of_school',
            'data' => $allVocationalSchools, 'options' => ['placeholder' => 'Filter as you type ...'],
            'pluginOptions' => ['highlight' => true],
        ]);
        ?>
        <?= $form->field($vocationalEducationalAttainment, 'address_of_school')->textInput(); ?>
        <?= $form->field($vocationalEducationalAttainment, 'inclusive_dates_of_attendance')->textInput()->hint("e.g 2004-2008");; ?>
        <label>Award Achivements</label>
        <?=
        Select2::widget([
            'name' => 'vocationalEducationalAttainmentAwards',
            'data' => $allAchievements,
            'options' => ['placeholder' => 'Select...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
        ?>


        <?php $this->endBlock() ?>

        <?php $this->beginBlock('tertiary') ?>
        <label>Name of School</label>
        <?=
        TypeaheadBasic::widget([
            'model' => $tertiaryEducationalAttainment,
            'attribute' => 'name_of_school',
            'data' => $allTertiarySchools,
            'pluginOptions' => ['highlight' => true],
        ]);
        ?>
        <?= $form->field($tertiaryEducationalAttainment, 'address_of_school')->textInput(); ?>
        <?= $form->field($tertiaryEducationalAttainment, 'inclusive_dates_of_attendance')->textInput()->hint("e.g 2004-2008");; ?>
        <label>Award Achivements</label>
        <?=
        Select2::widget([
            'name' => 'tertiaryEducationalAttainmentAwards',
            'data' => $allAchievements,
            'options' => ['placeholder' => 'Select...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
        ?>



        <?php $this->endBlock() ?>

        <?= Html::errorSummary($elementaryEducationalAttainment); ?>
        <?= Html::errorSummary($secondaryEducationalAttainment); ?>
        <?= Html::errorSummary($vocationalEducationalAttainment); ?>
        <?= Html::errorSummary($tertiaryEducationalAttainment); ?>

        <?=
        TabsX::widget([
            'items' => [
                [
                    'label' => 'Elementary',
                    'content' => $this->blocks['elementary'],
                    'active' => true,
                ],
                [
                    'label' => 'Secondary',
                    'content' => $this->blocks['secondary'],
                ],
                [
                    'label' => 'Vocational',
                    'content' => $this->blocks['vocational'],
                ],
                [
                    'label' => 'Tertiary',
                    'content' => $this->blocks['tertiary'],
                ],
            ],
            'position' => TabsX::POS_LEFT,
            'encodeLabels' => false
        ]);
        ?>

    </div>
</div>


<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
</div>
<div class="clearfix"></div>
<?php ActiveForm::end(); ?>

</div><!-- enroll-_form -->
