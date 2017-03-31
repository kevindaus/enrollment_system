<?php

namespace app\controllers;

use app\models\ExaminationLog;
use app\models\form\StudentLoginForm;
use app\models\StudentInformation;
use yii\web\NotFoundHttpException;
use Yii;

class StudentInformationController extends \yii\web\Controller
{
	public $layout = "main";
    public function actionIndex($serialNumber)
    {
        $studentModel = StudentInformation::find()->where(['serial_number' => $serialNumber])->one();
    	if (  $studentModel ) {
            //get the examination date of current student
            $examinationDate = ExaminationLog::find()->where(['student_id' => $studentModel->id])->one();
            if($examinationDate){
                $examinationDate = Yii::$app->formatter->asDateTime(strtotime($examinationDate->examination_date));
            }else{
                $examinationDate = "Not Set";
            }
            return $this->render('index',compact('studentModel','examinationDate'));
        }   else {
            throw new NotFoundHttpException("Sorry I can't find this record.");
        }
    }
    public function actionLogin()
    {
        $studentLoginForm = new StudentLoginForm();
        if($studentLoginForm->load(Yii::$app->request->post())){
            if ($studentLoginForm->loginStudent()) {
                $foundStudentModel = $studentLoginForm->getStudentModel();
                $this->redirect('/student-information/'.$foundStudentModel->serial_number);
            } else {
                Yii::$app->session->setFlash('login_error', 'Record doesnt exists in the database');
            }
        }
    	return $this->render('login',compact('studentLoginForm'));
    }
    public function actionPrint($serialNumber)
    {
        /**
         * @var $studentModel StudentInformation
         */
        $studentModel = StudentInformation::find()->where(['serial_number'=> $serialNumber])->one();
    	if ($studentModel) {
	        $pdfTemplate = Yii::getAlias("@app/template_docs".DIRECTORY_SEPARATOR .'College Admission Examinaion Permit.pdf');
	        $exportedFilePath = $studentModel->exportTestingPermit($pdfTemplate);
	        $exportedFilePath->Output('peek.pdf', 'I');
            \Yii::$app->end();
    	} else {
    		throw new NotFoundHttpException("Sorry I can't find this file.");
    	}
    }

}
