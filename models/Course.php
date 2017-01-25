<?php

namespace app\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $course_name
 * @property string $course_description
 * @property string $course_unit
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    public static function getAllAvailableCourses()
    {
        $query = new \yii\db\Query();
        $allAchievements = $query->select(['id','course_name'])
            ->from('course')
            ->all();
        $tempContainer = [];
        foreach ($allAchievements as $currentAchievementRow) {
            $tempContainer[$currentAchievementRow['id']] = $currentAchievementRow['course_name'];
        }
        return $tempContainer;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_name','course_description'], 'string', 'max' => 255],
            [['course_unit'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_name' => 'Name',
            'course_description' => 'Description',
            'course_unit' => 'Units',
        ];
    }

    public static function getCourseEnrolleeDataProvider()
    {
        /*get total */
        //get all course
        $allCourses = Course::find()->all();
        $arrayData = [];
        foreach ($allCourses as $currentCourse) {
            /**
             * @var $currentCourse Course
             */
            $currentEnrolleeOnCourse = StudentCourse::find()->where(['course_id'=>$currentCourse->id])->groupBy(['student_id'])->count();
            $arrayData[] = [
                'course' =>$currentCourse->course_name,
                'enrollee_count' =>$currentEnrolleeOnCourse
            ];
        }
        $arrayDataProvider = new ArrayDataProvider();
        $arrayDataProvider->pagination = false;
        $arrayDataProvider->allModels = $arrayData;
        return $arrayDataProvider;
    }
}
