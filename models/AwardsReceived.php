<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "awards_received".
 *
 * @property integer $id
 * @property integer $education_attainment_id
 * @property string $awards_name
 */
class AwardsReceived extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'awards_received';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['education_attainment_id'], 'integer'],
            [['awards_name'], 'string', 'max' => 255],
            [['education_attainment_id'], 'exist', 'skipOnError' => true, 'targetClass' => EducationalAttainment::className(), 'targetAttribute' => ['education_attainment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'education_attainment_id' => 'Education Attainment ID',
            'awards_name' => 'Awards Name',
        ];
    }

    /**
     *
     * @return array
     */
    public static function getAllAchievements()
    {
        $query = new \yii\db\Query();
        $allAchievements = $query->select('awards_name')
            ->from('awards_received')
            ->distinct(true)
            ->all();
        $tempContainer = [];
        foreach ($allAchievements as $currentAchievementRow) {
            $tempContainer[$currentAchievementRow['awards_name']] = $currentAchievementRow['awards_name'];
        }
        return $tempContainer;
    }

}
