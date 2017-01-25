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
    protected $studentModel=null;
    public function rules(){
        return [
            ['serial_key','required']
        ];
    }
    public function attributeLabels()
    {
        return [
            'serial_key'=>"Student Identification Number"
        ];
    }
    public function loginStudent()
    {
        $this->studentModel = StudentInformation::find()->where(['serial_number'=>$this->serial_key])->one();
        return !!$this->studentModel;
    }

    public function getStudentModel()
    {
        return $this->studentModel;
    }

} 