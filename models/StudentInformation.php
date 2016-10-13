<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_information".
 *
 * @property integer $id
 * @property string $firstName
 * @property string $middleName
 * @property string $lastName
 * @property string $phoneNumber
 * @property string $houseNumber
 * @property string $street
 * @property string $barangay
 * @property string $postalCode
 * @property string $city
 * @property string $province
 * @property string $country
 * @property string $birthday
 * @property string $emailAddress
 * @property string $height
 * @property string $weight
 * @property string $bloodType
 * @property string $elementary_graduated
 * @property string $highschool_graduated
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
            [['firstName', 'lastName', 'street', 'barangay'], 'required'],
            [['birthday', 'created_at', 'updated_at'], 'safe'],
            [['firstName', 'middleName', 'lastName', 'phoneNumber', 'houseNumber', 'street', 'barangay', 'postalCode', 'city', 'province', 'country', 'emailAddress', 'height', 'weight', 'bloodType', 'elementary_graduated', 'highschool_graduated'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'phoneNumber' => 'Phone Number',
            'houseNumber' => 'House Number',
            'street' => 'Street',
            'barangay' => 'Barangay',
            'postalCode' => 'Postal Code',
            'city' => 'City',
            'province' => 'Province',
            'country' => 'Country',
            'birthday' => 'Birthday',
            'emailAddress' => 'Email Address',
            'height' => 'Height',
            'weight' => 'Weight',
            'bloodType' => 'Blood Type',
            'elementary_graduated' => 'Elementary Graduated',
            'highschool_graduated' => 'Highschool Graduated',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
