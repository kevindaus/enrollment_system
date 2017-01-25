<?php

namespace app\models;


use yii\base\Model;

class QuickEnrolleeSearchForm extends Model
{
    public $searchKey;

    public function rules()
    {
        return [
            ['searchKey', 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'searchKey' => 'Searchkey',
        ];
    }

    public function searchEnrollee()
    {
        return StudentInformation::find()
            ->where([
                'firstName'=>$this->searchKey,
            ])
            ->orWhere(['middleName'=>$this->searchKey])
            ->orWhere(['lastName'=>$this->searchKey])
            ->orWhere(['serial_number'=>$this->searchKey])
            ->all();
    }

} 