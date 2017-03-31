<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/30/16
 * Time: 12:39 AM
 */

namespace app\models;


use yii\base\Model;

class FilterEnrolleForm  extends Model{
    public $serial_number;
    public $name;
    public $gender;
    public $address;
    public $ethnic_origin;
    public $civil_status;
    public $course;
    public $school_graduated;
    public $application_form_status;
    public $award;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name' ,'serial_number','gender' ,'address' ,'ethnic_origin','civil_status' ,'age' ,'course','school_graduated','award','application_form_status'], 'safe'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'serial_number'=>'Identification Number',
            'application_form_status'=>'Application Form'
        ];
    }

    public function getFilterQuery()
    {
        $query = StudentInformation::find();

        if (isset($this->name) && !empty($this->name)) {
            $query->andWhere([
                'OR',
                ['like','firstName',$this->name],
                ['like','lastName',$this->name]
            ]);
        }
        if (isset($this->gender) && !empty($this->gender)) {
            $query->andWhere(['gender' => $this->gender]);
        }
        if (isset($this->application_form_status) && !empty($this->application_form_status)) {
            $query->andWhere(['application_form_status' => $this->application_form_status]);
        }
        if (isset($this->serial_number) && !empty($this->serial_number)) {
            $query->andWhere(['serial_number' => $this->serial_number]);
        }
        if (isset($this->address) && !empty($this->address)) {
            $query->andFilterWhere([
                'OR',
                ['like','houseNumber' , $this->address],
                ['like','permanent_address_house_number' , $this->address],
                ['like','permanent_address_street' , $this->address],
                ['like','permanent_address_purok' , $this->address],
                ['like','permanent_address_barangay' , $this->address],
                ['like','permanent_address_town' , $this->address],
                ['like','permanent_address_province' , $this->address],
                ['like','permanent_address_postalCode' , $this->address],
                ['like','residential_address_house_number' , $this->address],
                ['like','residential_address_street' , $this->address],
                ['like','residential_address_purok' , $this->address],
                ['like','residential_address_barangay' , $this->address],
                ['like','residential_address_town' , $this->address],
                ['like','residential_address_province' , $this->address],
                ['like','residential_address_postalCode' , $this->address]
            ]);
        }
        if (isset($this->ethnic_origin) && !empty($this->ethnic_origin)) {
            $query->andWhere(['ethnic_origin' => $this->ethnic_origin]);
        }
        if (isset($this->civil_status) && !empty($this->civil_status)) {
            $query->andWhere(['civil_status' => $this->civil_status]);
        }
       if (isset($this->school_graduated) && !empty($this->school_graduated)) {
           $query->innerJoinWith(EducationalAttainment::tableName(),['student_information.id = educational_attainment.student_id']);
            $query->andFilterWhere([
                'OR',
                ['like','educational_attainment.name_of_school' , $this->school_graduated]
            ]);

       }
       if (isset($this->course) && !empty($this->course)) {
            $query->innerJoinWith(StudentCourse::tableName(),['student_course.student_id = student_information.id']);
            $query->innerJoinWith(Course::tableName(),['student_course.course_id = course.id']);
            $query->andFilterWhere([
                'OR',
                ['like','course.course_name' , $this->course]
            ]);
           $query->groupBy(["student_information.id"]);
       }
       if (isset($this->award) && !empty($this->award)) {
           $query->innerJoinWith(AwardsReceived::tableName(),['educational_attainment.id = awards_received.education_attainment_id']);
           $query->innerJoinWith(EducationalAttainment::tableName(),['student_information.id = educational_attainment.student_id']);
           $query->andFilterWhere([
               'OR',
               ['like','awards_received.awards_name' , $this->award]
           ]);
           $query->addGroupBy(["awards_received.awards_name"]);
       }

       return $query;
    }

} 