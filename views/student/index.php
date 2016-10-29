<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Student Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-information-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Student Information', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'college_admission_test_number',
            'official_receipt_number',
            'date_taken',
            'profile_image',
            // 'application_status',
            // 'is_first_time',
            // 'is_first_time_location',
            // 'title',
            // 'firstName',
            // 'middleName',
            // 'lastName',
            // 'phoneNumber',
            // 'houseNumber',
            // 'permanent_address_house_number',
            // 'permanent_address_street',
            // 'permanent_address_purok',
            // 'permanent_address_barangay',
            // 'permanent_address_town',
            // 'permanent_address_province',
            // 'permanent_address_postalCode',
            // 'residential_address_house_number',
            // 'residential_address_street',
            // 'residential_address_purok',
            // 'residential_address_barangay',
            // 'residential_address_town',
            // 'residential_address_province',
            // 'residential_address_postalCode',
            // 'birthday',
            // 'age',
            // 'place_of_birth',
            // 'civil_status',
            // 'gender',
            // 'ethnic_origin',
            // 'citizenship',
            // 'signature_image',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
