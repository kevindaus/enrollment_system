<?php
/* @var $this yii\web\View */
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\widgets\Menu;

/* @var $enrolleeModel \app\models\StudentInformation */
/* @var $currentAward \app\models\AwardsReceived */
/* @var $currrentEducationalAttainment \app\models\EducationalAttainment  */

$uploadedImagesPath = Yii::getAlias('@app/uploads/student_pictures');
$studentImage = base64_encode(  file_get_contents($uploadedImagesPath . DIRECTORY_SEPARATOR . $enrolleeModel->student_picture) );

$uploadedImagesPath = Yii::getAlias('@app/uploads/certificates');
$certImage = base64_encode(  file_get_contents($uploadedImagesPath . DIRECTORY_SEPARATOR . $enrolleeModel->requirement_certificate) );

?>
<div class="row" style='padding: 20px;'>

    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <br>
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
    </div>

    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
        <br>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-user"></span> 
                    Personal Information : 
                    <strong>
                        <?=  Html::encode(  sprintf("%s %s %s %s" ,$enrolleeModel->title, $enrolleeModel->firstName , $enrolleeModel->middleName , $enrolleeModel->lastName) ); ?> 
                    </strong>
                    <?= Html::a("edit", '/enrollee/update-personal-information/'.$enrolleeModel->id, ['class' => 'btn btn-link btn-small pull-right','style'=>'margin-top: -8px;']); ?>
                </h3>
            </div>
            <div class="panel-body">
                <?=
                DetailView::widget([
                    'model' => $enrolleeModel,
                    'attributes' => [
                        'id',
                        [
                            'label' => 'Date taken',
                            'value' => \Yii::$app->formatter->asDate($enrolleeModel->date_taken, 'long')
                        ],
                        'application_status',
                        'is_first_time',
                        [
                            'label'=>'NVSU-CAT (Location)',
                            'value'=>$enrolleeModel->is_first_time_location
                        ],
                        'title',
                        'firstName',
                        'middleName',
                        'lastName',
                        'phoneNumber',
                        'houseNumber',
                        [
                            'label' => 'Birthday',
                            'value' => \Yii::$app->formatter->asDate($enrolleeModel->birthday, 'long')
                        ],
                        'age', //must be calculated
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-home"></span> Permanent Address</h3>
            </div>
            <div class="panel-body">
                <?=
                DetailView::widget([
                    'model' => $enrolleeModel,
                    'attributes' => [
                        'permanent_address_house_number',
                        'permanent_address_street',
                        'permanent_address_purok',
                        'permanent_address_barangay',
                        'permanent_address_town',
                        'permanent_address_province',
                        'permanent_address_postalCode',
                    ],
                ]) ?>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-home"></span> Residential Address</h3>
            </div>
            <div class="panel-body">
                <?=
                DetailView::widget([
                    'model' => $enrolleeModel,
                    'attributes' => [
 
                        'residential_address_house_number',
                        'residential_address_street',
                        'residential_address_purok',
                        'residential_address_barangay',
                        'residential_address_town',
                        'residential_address_province',
                        'residential_address_postalCode',
                    ],
                ]) ?>

            </div>
        </div>        

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Preffered Courses</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <?php foreach ($preferredCourses as $currentIndex => $currentPrefCourse): ?>
                        <li class="list-group-item"><?= $currentIndex+1 ?>.) <?= $currentPrefCourse->course_name ?> </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Educational Attaintment</h3>
            </div>
            <div class="panel-body">
                <?php foreach ($enrolleeModel->geteducational_attainment()->all() as $currrentEducationalAttainment): ?>
                    <?php if (!empty($currrentEducationalAttainment->name_of_school)): ?>                   
                        <h5>
                            <?= $currrentEducationalAttainment->education ?> - <?= $currrentEducationalAttainment->name_of_school ?>
                            <br>
                            <small>(<?= $currrentEducationalAttainment->inclusive_dates_of_attendance?>)</small>
                            <br>
                            <br>
                            <strong style="margin: 10px 0px">Award(s):</strong>
                            <br>
                            <br>
                            <ul>
                            <?php foreach ($currrentEducationalAttainment->getAwards() as $currentAward): ?>
                                <li>
                                    * <?= $currentAward->awards_name ?>
                                </li>
                            <?php endforeach ?>
                            </ul>
                        </h5>
                        <hr>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                <span class="glyphicon glyphicon-link" aria-hidden="true"></span>    Attachments
                </h3>
            </div>
            <div class="panel-body">
                <h2>Student Image</h2>
                <img src="data:image/jpeg;base64,<?= $studentImage ?>" class='img-responsive' style='height: 150px'>
                <hr>
                <h2>Certificate Requirement</h2>
                <img src="data:image/jpeg;base64,<?= $certImage ?>" class='img-responsive' style='height: 150px'>
            </div>
        </div>

    </div>
</div>
