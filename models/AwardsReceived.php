<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "awards_received".
 *
 * @property integer $id
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
            [['awards_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'awards_name' => 'Awards Name',
        ];
    }
}
