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
use yii\data\ActiveDataProvider;
use \app\models\Course;

class EnrollController extends Controller{
    public function actionIndex()
    {
		$model = new \app\models\StudentInformation();
		$query = new \yii\db\Query();
		$allAchievements = $query->select('*')
			->from('achievement')
			->all();
		$courseQuery = Course::find();
		$courseQuery->limit = 5;
		$allCourse = new ActiveDataProvider([
			    'query' => $courseQuery,
			    'pagination' => [
			        'pageSize' => 20,
			    ],
			]);

	    if ($model->load(Yii::$app->request->post())) {
	        if ($model->validate()) {
	        	$model->birthday = date("Y-m-d H:i:s",strtotime($model->birthday));
	        	if ($model->save()) {
	        		//@TODO - not saving WTF?!
	        		/*@todo - save student course*/
	        		/*@todo - save student achievement */
		        	Yii::$app->session->setFlash("success", "<strong>Success!</strong> You have succesfully registered. Thank you for enrolling at ".\Yii::$app->params['university_name']);
					$model = new \app\models\StudentInformation();
	        		// $this->redirect("/enroll");
	        	}
	        }
	    }
	    $tempContainer = [];
	    foreach ($allAchievements as $currentAchievementRow) {
	    	$tempContainer[] = $currentAchievementRow['name'];
	    }
	    $allAchievements = $tempContainer;
        return $this->render('index',compact('model','allCourse','allAchievements'));
    }

} 