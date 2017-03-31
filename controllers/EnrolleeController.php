<?php

namespace app\controllers;

use app\models\events\ScheduleExaminationEventHandler;
use app\models\ExaminationLog;
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
    public function actionApprove($enrolleeId)
    {
        /**
         * @var $examinationObj ExaminationLog
         */
        $examinationDate = '';

        $applicant = StudentInformation::find()
            ->where([
                'id'=>$enrolleeId
            ])->one();
        if (!$applicant) {
            throw new NotFoundHttpException;
        } else {
            /*make sure the applicant is not scheduled before hand*/
            $examinationObj = ExaminationLog::find()->where(['student_id' => $applicant->id])->one();
            if(!$examinationObj){
                /* schedule for examination */
                $applicant->on(StudentInformation::SCHEDULE_FOR_EXAMINATION, [new ScheduleExaminationEventHandler(), 'handle'], $applicant);
                $applicant->trigger(StudentInformation::SCHEDULE_FOR_EXAMINATION);
                $applicant->application_form_status = StudentInformation::APPLICATION_FORM_STATUS_APPROVED;
                $applicant->update(false);
                $examinationObj = ExaminationLog::find()->where(['student_id' => $applicant->id])->one();
           }
            $examinationDate = \Yii::$app->formatter->asDatetime(strtotime($examinationObj->examination_date));
            \Yii::$app->session->setFlash("examination_date_set_success", "Applicant : {$applicant->firstName} {$applicant->middleName} {$applicant->lastName} is scheduled for entrance examination on {$examinationDate}");
            /*redirect back to */
            return $this->redirect(\Yii::$app->request->referrer);
        }
    }

}
