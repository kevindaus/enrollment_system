<?php

namespace app\models;

use FPDI;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;


/**
 * This is the model class for table "student_information".
 *
 * @property integer $id
 * @property string $college_admission_test_number
 * @property string $official_receipt_number
 * @property string $date_taken
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
 * @property string $student_picture
 * @property string $requirement_certificate
 * @property string $serial_number
 * @property string $created_at
 * @property string $updated_at
 */
class StudentInformation extends \yii\db\ActiveRecord
{
    const NEW_STUDENT_REGISTERED = 'NEW_STUDENT_REGISTERED';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_information';
    }

    public static function findValedictoriansArr()
    {
        /*high school*/        
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
        /*high school*/        
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
        /*high school*/
        $sqlCommand = <<<EOL
        select student.*
        from student_information as student
        inner join educational_attainment as educ on educ.student_id = student.id
        inner join awards_received as awards on awards.education_attainment_id = educ.id
        where awards.awards_name = "athlete"
        and educ.education = "Secondary"        
EOL;
        return Yii::$app->db->createCommand($sqlCommand)->queryAll();
    }

    public static function getAllEthnicity()
    {
        $sqlCommand = <<<EOL
        select distinct student.ethnic_origin
        from student_information as student
EOL;
        return Yii::$app->db->createCommand($sqlCommand)->queryAll();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'firstName', 'lastName', 'gender', 'age', 'civil_status', 'citizenship', 'requirement_certificate'], 'required'],
            [['requirement_certificate', 'student_picture', 'date_taken', 'birthday', 'created_at', 'updated_at', 'application_status', 'college_admission_test_number', 'official_receipt_number', 'is_first_time', 'is_first_time_location'], 'safe'],
            [['age'], 'number'],
            [['serial_number', 'college_admission_test_number', 'official_receipt_number', 'application_status', 'is_first_time', 'is_first_time_location', 'title', 'firstName', 'middleName', 'lastName', 'phoneNumber', 'houseNumber', 'permanent_address_house_number', 'permanent_address_street', 'permanent_address_purok', 'permanent_address_barangay', 'permanent_address_town', 'permanent_address_province', 'permanent_address_postalCode', 'residential_address_house_number', 'residential_address_street', 'residential_address_purok', 'residential_address_barangay', 'residential_address_town', 'residential_address_province', 'residential_address_postalCode', 'place_of_birth', 'civil_status', 'gender', 'ethnic_origin', 'citizenship', 'signature_image'], 'string', 'max' => 255],
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
            'serial_number' => 'Identification Number',
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
        if ($this->isNewRecord || $this->scenario == "update") {
            $this->date_taken = date("Y-m-d h:i:s", strtotime($this->date_taken));
            $this->birthday = date("Y-m-d h:i:s", strtotime($this->birthday));
        }
        if ($this->isNewRecord) {
            //generate serial number
            do {
                $this->serial_number = substr(uniqid(), -8);
            } while (StudentInformation::find()->where(['serial_number' => $this->serial_number])->exists());
            
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($this->isNewRecord) {
            $this->trigger(StudentInformation::NEW_STUDENT_REGISTERED);
        }
        parent::afterSave($insert, $changedAttributes);
    }


    public function beforeDelete()
    {
        $allEducationalAttainments = EducationalAttainment::find()->where(['student_id' => $this->id])->all();
        /**
         * @var $currentEducationalAttainment EducationalAttainment
         * @vara $currentAward AwardsReceived
         */
        foreach ($allEducationalAttainments as $currentEducationalAttainment) {
            $allawards = AwardsReceived::find()->where(['education_attainment_id' => $currentEducationalAttainment->id])->all();
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
        return $this->hasMany(EducationalAttainment::className(), ['student_id' => 'id']);
    }

    public static function getMaleCount()
    {
        return StudentInformation::find()->where([
            'gender' => 'Male'
        ])->count();
    }

    public static function getFemaleCount()
    {
        return StudentInformation::find()->where([
            'gender' => 'Female'
        ])->count();
    }

    public function getPrefferedCourses()
    {
        /*get student courses*/
        $coursesCollection = [];
        $pref = StudentCourse::find()->where(['student_id' => $this->id])->all();
        foreach ($pref as $currentPref) {
            $coursesCollection[] = $currentPref->course;
        }
        return $coursesCollection;
    }

    public function getstudent_course()
    {
        return $this
            ->hasMany(StudentCourse::className(), ['student_id' => 'id'])
            ->from(['student_course_2' => StudentCourse::tableName()]);

    }

    public function getcourse()
    {
        return $this
            ->hasMany(Course::className(), ['id' => 'course_id'])
            ->viaTable('student_course', ['student_id' => 'id']);
    }

    public function getawards_received()
    {
        return $this
            ->hasMany(AwardsReceived::className(), ['id' => 'student_id'])
            ->viaTable(EducationalAttainment::tableName(), ['student_id' => 'id'], function ($q) {
                $q->from("educational_attainment ed2");
            });
    }

    /**
     * @param $pdfTemplate
     * @return FPDI
     */
    public function exportTestingPermit($pdfTemplate){
        $exportedFile = '';
        class_exists('TCPDF', true);
        $pdf = new FPDI();
        $pdf->addPage();
        $pdf->SetFont("Helvetica",'',8);
        $pdf->setSourceFile($pdfTemplate);
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(  50 , 33);
        $pdf->Write( 0 , $this->serial_number);
        $pdf->SetXY(  73 , 93.5);
        $pdf->Write(0, sprintf("%s %s %s  %s",$this->title,$this->firstName ,$this->middleName,$this->lastName));
        $pdf->SetXY(  103 , 98);
        $pdf->Write(0, date("l jS \of F Y",time()). " 8:00 AM"  );//date
        $pdf->SetXY(  35 , 106);
        $pdf->Write(0, 'Testing Center');//time
        return $pdf;

    }

    public function saveStudentPicture(UploadedFile $uploadedFile)
    {
        //get photo name
        $uploadedImagesPath = Yii::getAlias('@app/uploads/student_pictures');
        //rename photoname using format Y_m_d_title_firstname_middlename_lastname_random
        $finalImagename = sprintf("%s_%s_%s_%s_%s_%s.%s", date("Y_m_d"), $this->title, $this->firstName, $this->middleName, $this->lastName, uniqid(),$uploadedFile->extension);
        $uploadedFile->saveAs($uploadedImagesPath .DIRECTORY_SEPARATOR. $finalImagename);
        $this->student_picture = $finalImagename;
        return $uploadedImagesPath .DIRECTORY_SEPARATOR. $finalImagename;
    }

    public function saveStudentCeritificateRequirement(UploadedFile $uploadedFile)
    {
        $uploadedImagesPath = Yii::getAlias('@app/uploads/certificates');
        //rename photoname using format Y_m_d_title_firstname_middlename_lastname_serialNumber
        $finalImagename = sprintf("%s_%s_%s_%s_%s_%s.%s", date("Y_m_d"), $this->title, $this->firstName, $this->middleName, $this->lastName, uniqid(),$uploadedFile->extension);
        $uploadedFile->saveAs($uploadedImagesPath .DIRECTORY_SEPARATOR. $finalImagename);
        $this->requirement_certificate = $finalImagename;
        return $uploadedImagesPath .DIRECTORY_SEPARATOR. $finalImagename;
    }

}
