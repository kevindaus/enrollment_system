<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_achievement".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $achievement_id
 * @property string $created_at
 * @property string $updated_at
 */
class StudentAchievement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_achievement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'achievement_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['achievement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Achievement::className(), 'targetAttribute' => ['achievement_id' => 'id']],
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
            'achievement_id' => 'Achievement ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
