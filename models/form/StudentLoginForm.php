<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/8/17
 * Time: 4:19 AM
 */

namespace app\models\form;


use app\models\StudentInformation;
use yii\base\Model;

class StudentLoginForm extends Model{
    public $serial_key;
    public $firstName;
    public $middleName;
    public $lastName;
    protected $studentModel=null;
    public function rules(){
        return [
            [['serial_key','firstName','middleName','lastName'],'safe']
        ];
    }
    public function attributeLabels()
    {
        return [
            'serial_key'=>"Student Identification Number",
            'firstName'=>"Firstname",
            'middleName'=>"Middlename",
            'lastName'=>"Lastname"
        ];
    }
    public function loginStudent()
    {
        $searchCriteria = StudentInformation::find();
        if (isset($this->serial_key) && !empty($this->serial_key)) {
            //use serial for searching
            $searchCriteria->where(['serial_number' => $this->serial_key]);
        } else {
          //use name
            $searchCriteria->where([
                'firstName'=> $this->firstName,
                'middleName'=> $this->middleName,
                'lastName'=> $this->lastName
            ]);
        }
        $this->studentModel = $searchCriteria->one();
        return !!$this->studentModel;
    }

    public function getStudentModel()
    {
        return $this->studentModel;
    }

} 