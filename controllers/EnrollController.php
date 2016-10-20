<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/14/16
 * Time: 4:02 AM
 */

namespace app\controllers;

use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;
use \app\models\StudentInformation;
use yii\data\ActiveDataProvider;
use \app\models\Course;
use \app\models\EducationalAttainment;

class EnrollController extends Controller{
    public function actionIndex()
    {
		$newStudent = new \app\models\StudentInformation();
	    $allAchievements = $this->getAllAchievements();
	    /*course preferences */
	    

	    /*educational attainment*/
	    $elementaryEducationalAttainment = new EducationalAttainment(['education'=>'Elementary']);
	    $secondaryEducationalAttainment = new EducationalAttainment(['education'=>'Secondary']);
	    $vocationalEducationalAttainment = new EducationalAttainment(['education'=>'Vocational']);
	    $tertiaryEducationalAttainment = new EducationalAttainment(['education'=>'Tertiary']);

	    /*@TODO - register the new student*/


        return $this->render('index',compact(
	        	'newStudent',
	        	'allAchievements',
	        	'elementaryEducationalAttainment',
	        	'secondaryEducationalAttainment',
	        	'vocationalEducationalAttainment',
	        	'tertiaryEducationalAttainment'
        	));
    }
    protected function getAllAchievements()
    {
		$query = new \yii\db\Query();		
		$allAchievements = $query->select('*')
			->from('awards_received')
			->all();
	    $tempContainer = [];
	    foreach ($allAchievements as $currentAchievementRow) {
	    	$tempContainer[] = $currentAchievementRow['name'];
	    }
    	return $tempContainer;
    }

} 