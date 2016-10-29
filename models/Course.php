<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $course_name
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
            [['course_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_name' => 'Course Name',
        ];
    }

    public static function getCourseDistribution()
    {
        /*get total */
        $sqlCommand = <<<EOL
        SELECT course.course_name,count(course.id)  as course_count
        FROM course
        inner join student_course on student_course.course_id = course.id
        group by course.course_name
EOL;
        return \Yii::$app->db->createCommand($sqlCommand)->queryAll();
    }
}
