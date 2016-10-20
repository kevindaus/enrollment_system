<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "educational_attainment".
 *
 * @property integer $id
 * @property string $education
 * @property string $name_of_school
 * @property string $address_of_school
 * @property string $inclusive_dates_of_attendance
 */
class EducationalAttainment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'educational_attainment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['education', 'name_of_school'], 'required'],
            [['education', 'name_of_school', 'address_of_school', 'inclusive_dates_of_attendance'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'education' => 'Education',
            'name_of_school' => 'Name Of School',
            'address_of_school' => 'Address Of School',
            'inclusive_dates_of_attendance' => 'Inclusive Dates Of Attendance',
        ];
    }
}
