<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "educational_attainment".
 *
 * @property integer $id
 * @property integer $student_id
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
            [['student_id'], 'integer'],
            [['education'], 'safe'],
            [['education', 'name_of_school', 'address_of_school', 'inclusive_dates_of_attendance'], 'string', 'max' => 255],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentInformation::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'education' => 'Education',
            'name_of_school' => 'Name Of School',
            'address_of_school' => 'Address Of School',
            'inclusive_dates_of_attendance' => 'Inclusive Dates Of Attendance',
        ];
    }

    /**
     * Returns the owner of the current EducationalAttainment
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getStudent(){
        return StudentInformation::find()->where(['id' => $this->student_id])->one();
    }
    public function getAwards(){
        return AwardsReceived::find()->where(['education_attainment_id' => $this->id])->all();
    }
    public static function getAllElementarySchool()
    {
        return EducationalAttainment::getSchoolNameByEducationalAttainment("Elementary");
    }
    public static function getAllHighSchool()
    {
        return EducationalAttainment::getSchoolNameByEducationalAttainment("Secondary");
    }
    public static function getAllVocationalSchool()
    {
        return EducationalAttainment::getSchoolNameByEducationalAttainment("Vocational");
    }
    public static function getAllTertiarySchool()
    {
        return EducationalAttainment::getSchoolNameByEducationalAttainment("Tertiary");
    }
    public static function getSchoolNameByEducationalAttainment($education)
    {
        $sqlCommand = <<<EOL
        select distinct name_of_school
        from educational_attainment
        where education = :education and name_of_school <> ""
EOL;
        $command = Yii::$app->db->createCommand($sqlCommand);
        $command->bindParam(":education",$education);
        return $command->queryAll();
    }
}
