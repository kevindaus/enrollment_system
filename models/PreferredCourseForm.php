<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/22/16
 * Time: 11:04 PM
 */

namespace app\models;


use yii\base\Model;

class PreferredCourseForm extends Model{
    public $firstPreferredCourse;
    public $secondPreferredCourse;
    public $thirdPreferredCourse;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['firstPreferredCourse', 'secondPreferredCourse','thirdPreferredCourse'], 'required'],
            [['firstPreferredCourse', 'secondPreferredCourse','thirdPreferredCourse'], 'integer'],
        ];
    }
    public function validCourse($model, $attribute)
    {
        $courseNameExists = Course::find()->where([
            'course_name'=>$model->$attribute
        ])->exists();
        if (!$courseNameExists) {
            $this->addError($attribute, "Sorry we do not offer this course at the moment.");
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'firstPreferredCourse' => 'First preffered course',
            'secondPreferredCourse' => 'Second preffered course',
            'thirdPreferredCourse' => 'Third preffered course',
        ];
    }

} 