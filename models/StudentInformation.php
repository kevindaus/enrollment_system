<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "student_information".
 *
 * @property integer $id
 * @property string $college_admission_test_number
 * @property string $official_receipt_number
 * @property string $date_taken
 * @property string $profile_image
 * @property string $application_status
 * @property string $is_first_time
 * @property string $is_first_time_location
 * @property string $title
 * @property string $firstName
 * @property string $middleName
 * @property string $lastName
 * @property string $phoneNumber
 * @property string $houseNumber
 * @property string $permanent_address_house_number
 * @property string $permanent_address_street
 * @property string $permanent_address_purok
 * @property string $permanent_address_barangay
 * @property string $permanent_address_town
 * @property string $permanent_address_province
 * @property string $permanent_address_postalCode
 * @property string $residential_address_house_number
 * @property string $residential_address_street
 * @property string $residential_address_purok
 * @property string $residential_address_barangay
 * @property string $residential_address_town
 * @property string $residential_address_province
 * @property string $residential_address_postalCode
 * @property string $birthday
 * @property integer $age
 * @property string $place_of_birth
 * @property string $civil_status
 * @property string $gender
 * @property string $ethnic_origin
 * @property string $citizenship
 * @property string $signature_image
 * @property string $created_at
 * @property string $updated_at
 */
class StudentInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['college_admission_test_number', 'official_receipt_number', 'application_status', 'is_first_time', 'is_first_time_location', 'title', 'firstName', 'lastName'], 'required'],
            [['date_taken', 'birthday', 'created_at', 'updated_at'], 'safe'],
            [['age'], 'integer'],
            [['college_admission_test_number', 'official_receipt_number', 'profile_image', 'application_status', 'is_first_time', 'is_first_time_location', 'title', 'firstName', 'middleName', 'lastName', 'phoneNumber', 'houseNumber', 'permanent_address_house_number', 'permanent_address_street', 'permanent_address_purok', 'permanent_address_barangay', 'permanent_address_town', 'permanent_address_province', 'permanent_address_postalCode', 'residential_address_house_number', 'residential_address_street', 'residential_address_purok', 'residential_address_barangay', 'residential_address_town', 'residential_address_province', 'residential_address_postalCode', 'place_of_birth', 'civil_status', 'gender', 'ethnic_origin', 'citizenship', 'signature_image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'college_admission_test_number' => 'College Admission Test Number',
            'official_receipt_number' => 'Official Receipt Number',
            'date_taken' => 'Date Taken',
            'profile_image' => 'Profile Image',
            'application_status' => 'Application Status',
            'is_first_time' => 'Is First Time',
            'is_first_time_location' => 'Is First Time Location',
            'title' => 'Title',
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'phoneNumber' => 'Phone Number',
            'houseNumber' => 'House Number',
            'permanent_address_house_number' => 'House Number',
            'permanent_address_street' => 'Street',
            'permanent_address_purok' => 'Purok',
            'permanent_address_barangay' => 'Barangay',
            'permanent_address_town' => 'Town',
            'permanent_address_province' => 'Province',
            'permanent_address_postalCode' => 'Postal Code',
            'residential_address_house_number' => 'House Number',
            'residential_address_street' => 'Street',
            'residential_address_purok' => 'Purok',
            'residential_address_barangay' => 'Barangay',
            'residential_address_town' => 'Town',
            'residential_address_province' => 'Province',
            'residential_address_postalCode' => 'Postal Code',
            'birthday' => 'Birthday',
            'age' => 'Age',
            'place_of_birth' => 'Place Of Birth',
            'civil_status' => 'Civil Status',
            'gender' => 'Gender',
            'ethnic_origin' => 'Ethnic Origin',
            'citizenship' => 'Citizenship',
            'signature_image' => 'Signature Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'=>new Expression('NOW()')
            ],
        ];
    }

    

}
