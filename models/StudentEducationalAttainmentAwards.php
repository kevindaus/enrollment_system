<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_educational_attainment_awards".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $educational_attainment_id
 * @property integer $awards_received_id
 */
class StudentEducationalAttainmentAwards extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_educational_attainment_awards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'educational_attainment_id', 'awards_received_id'], 'integer'],
            [['awards_received_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwardsReceived::className(), 'targetAttribute' => ['awards_received_id' => 'id']],
            [['educational_attainment_id'], 'exist', 'skipOnError' => true, 'targetClass' => EducationalAttainment::className(), 'targetAttribute' => ['educational_attainment_id' => 'id']],
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
            'educational_attainment_id' => 'Educational Attainment ID',
            'awards_received_id' => 'Awards Received ID',
        ];
    }
}
