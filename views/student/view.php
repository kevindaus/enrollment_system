<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StudentInformation */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Student Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-information-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'college_admission_test_number',
            'official_receipt_number',
            [
                'label'=>'Date taken',
                'value'=> \Yii::$app->formatter->->asDate($model->date_taken, 'long');
            ],
            'profile_image',
            'application_status',
            'is_first_time',
            'is_first_time_location',
            'title',
            'firstName',
            'middleName',
            'lastName',
            'phoneNumber',
            'houseNumber',
            'permanent_address_house_number',
            'permanent_address_street',
            'permanent_address_purok',
            'permanent_address_barangay',
            'permanent_address_town',
            'permanent_address_province',
            'permanent_address_postalCode',
            'residential_address_house_number',
            'residential_address_street',
            'residential_address_purok',
            'residential_address_barangay',
            'residential_address_town',
            'residential_address_province',
            'residential_address_postalCode',
            [
                'label'=>'Date taken',
                'value'=> \Yii::$app->formatter->->asDate($model->date_taken, 'long');
            ],
            'age',
            'place_of_birth',
            'civil_status',
            'gender',
            'ethnic_origin',
            'citizenship',
            'signature_image',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
