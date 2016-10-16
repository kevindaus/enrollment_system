<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/14/16
 * Time: 4:02 AM
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use \app\models\StudentInformation;

class EnrollController extends Controller{
    public function actionIndex()
    {
		$model = new \app\models\StudentInformation();
	    if ($model->load(Yii::$app->request->post())) {
	        if ($model->validate()) {
	        	if ($model->save()) {
		        	Yii::$app->session->setFlash("success", "<strong>Success!</strong> You have succesfully registered. Thank you for enrolling at ".\Yii::$app->params['university_name']);
					$model = new \app\models\StudentInformation();
	        		// $this->redirect("/enroll");
	        	}
	        }
	    }
        return $this->render('index',compact('model'));
    }

} 