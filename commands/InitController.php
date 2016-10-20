<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/14/16
 * Time: 5:39 AM
 */

namespace app\commands;


use app\models\AwardsReceived;
use app\models\Course;
use app\models\SystemAccount;
use yii\console\Controller;
use yii\rbac\DbManager;

class InitController extends Controller{

    public function actionIndex()
    {
        /**
         * @var $authManager DbManager
         */
        $authManager = \Yii::$app->authManager;
        $adminRole = $authManager->createRole("admin");
        $authManager->add($adminRole);
        $adminAccount = new SystemAccount();
        $adminAccount->username = "admin";
        $adminAccount->password = "y14gK38T6JAb7cH";
        if ($adminAccount->save()) {
	        $authManager->assign($adminRole,$adminAccount->id);
        }
        //done
    }

    public function actionCourse()
    {
        /* @todo - initialize course*/
        Course::deleteAll();
        /* Information Tech*/
        $itCourse = new Course();
        $itCourse->course_name = "Bachelor of Science in Information Technology";
        $itCourse->save();
        /* Nursing */
        $nursingCourse = new Course();
        $nursingCourse->course_name = "Bachelor of Arts and Science";
        $nursingCourse->save();
        /* Educ */
        $educCourse = new Course();
        $educCourse->course_name = "Bachelor of Education (Secondary)";
        $educCourse->save();
        echo "Initial course data inserted";
    }
    public function actionAchievements()
    {
        /* @todo - initialize achivements*/
        /*valedictorian*/
        $valedictorian = new AwardsReceived(['awards_name'=>'valedictorian']);
        $valedictorian->save();
        /*salutatorian*/
        $salut = new AwardsReceived(['awards_name'=>'salutatorian']);
        $salut->save();
        /*athlete*/
        $athlete = new AwardsReceived(['awards_name'=>'athlete']);
        $athlete->save();
        echo "Initial award achievements inserted";
    }
} 