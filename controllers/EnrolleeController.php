<?php

namespace app\controllers;

use app\models\StudentInformation;
use yii\filters\AccessControl;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class EnrolleeController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['update-personal-information'],
                'rules' => [
                    [
                        'actions' => ['update-personal-information'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }	
    public function actionUpdatePersonalInformation($enrolleeId)
    {
        $enrolleeObj = StudentInformation::find()
            ->where([
                'id'=>$enrolleeId
            ])->one();
        if (!$enrolleeObj) {
            throw new NotFoundHttpException;
        }else if ($enrolleeObj->load(\Yii::$app->request->post()) && $enrolleeObj->save()) {
            \Yii::$app->session->setFlash("success", "Data updated !");
            return $this->redirect(\Yii::$app->request->referrer);
        }
        return $this->render('updatePersonalInformation', compact('enrolleeObj'));
    }

}
