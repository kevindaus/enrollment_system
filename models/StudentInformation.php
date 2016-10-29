<?php

namespace app\models;

use Yii;
use yii\base\ModelEvent;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
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

    public static function findValedictoriansArr()
    {
        $sqlCommand = <<<EOL
        select student.*
        from student_information as student
        inner join educational_attainment as educ on educ.student_id = student.id
        inner join awards_received as awards on awards.education_attainment_id = educ.id
        where awards.awards_name = "valedictorian"
        and educ.education = "Secondary"
EOL;
        return Yii::$app->db->createCommand($sqlCommand)->queryAll();
    }

    public static function findSalutatoriansArr()
    {
        $sqlCommand = <<<EOL
        select student.*
        from student_information as student
        inner join educational_attainment as educ on educ.student_id = student.id
        inner join awards_received as awards on awards.education_attainment_id = educ.id
        where awards.awards_name = "salutatorian"
        and educ.education = "Secondary"

EOL;
        return Yii::$app->db->createCommand($sqlCommand)->queryAll();
    }

    public static function findAthletesArr()
    {
        $sqlCommand = <<<EOL
        select student.*
        from student_information as student
        inner join educational_attainment as educ on educ.student_id = student.id
        inner join awards_received as awards on awards.education_attainment_id = educ.id
        where awards.awards_name = "athlete"
EOL;
        return Yii::$app->db->createCommand($sqlCommand)->queryAll();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'firstName', 'lastName','gender','age','civil_status','citizenship'], 'required'],
            [['date_taken', 'birthday', 'created_at', 'updated_at', 'application_status', 'college_admission_test_number', 'official_receipt_number', 'is_first_time', 'is_first_time_location'], 'safe'],
            [['age'], 'number'],
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
            'is_first_time' => 'Is first time',
            'is_first_time_location' => 'Place NVSU-CAT took place',
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
                'value' => new Expression('NOW()')
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord || $this->scenario == "update"){
            $this->date_taken = date("Y-m-d h:i:s", strtotime($this->date_taken));
            $this->birthday = date("Y-m-d h:i:s", strtotime($this->birthday));
        }
        return parent::beforeSave($insert);
    }

    public function beforeDelete()
    {
        $allEducationalAttainments = EducationalAttainment::find()->where(['student_id' => $this->id])->all();
        /**
         * @var $currentEducationalAttainment EducationalAttainment
         * @vara $currentAward AwardsReceived
         */
        foreach ($allEducationalAttainments as $currentEducationalAttainment) {
            $allawards = AwardsReceived::find()->where(['education_attainment_id'=>$currentEducationalAttainment->id])->all();
            foreach ($allawards as $currentAward) {
                $currentAward->delete();
            }
            $currentEducationalAttainment->delete();
        }
        return parent::beforeDelete();
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function geteducational_attainment()
    {
        return $this->hasMany(EducationalAttainment::className(),['student_id'=>'id']);
    }
 
    public static function getMaleCount(){
        return StudentInformation::find()->where([
            'gender'=>'Male'
        ])->count();
    }
    public static function getFemaleCount(){
        return StudentInformation::find()->where([
            'gender'=>'Female'
        ])->count();
    }
    public function getPrefferedCourses()
    {
        /*get student courses*/
        $coursesCollection = [];
        $pref =  StudentCourse::find()->where(['student_id'=>$this->id])->all();
        foreach ($pref as $currentPref) {
            $coursesCollection[] = $currentPref->course;
        }
        return $coursesCollection;
    }
    public function getstudent_course()
    {
        return $this
            ->hasMany(StudentCourse::className(), ['student_id' => 'id'])
            ->from(['student_course_2'=>StudentCourse::tableName()]);

    }
    public function getcourse()
    {
        return $this
            ->hasMany(Course::className(), ['id' => 'student_id'])
            ->viaTable('student_course', ['course_id' => 'id']);
    }
    public function getawards_received(){
        return $this
            ->hasMany(AwardsReceived::className(), ['id' => 'student_id'])
            ->viaTable(EducationalAttainment::tableName(), ['student_id' => 'id'],function($q){
                $q->from("educational_attainment ed2");
            });
    }

}
