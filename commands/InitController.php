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
        $adminRole = "";
        SystemAccount::deleteAll();
        $adminRole = $authManager->getRole("admin");
        if (!$adminRole) {
            $adminRole = $authManager->createRole("admin");
            $authManager->add($adminRole);
        }
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
        $courseCollection = [
            "BS in Ecotourism",
            "BS in Hospitality Management major in Travel Management",
            "BS in Hospitality Management major in Hotel and Restaurant Management",
            "BS in Industrial Education major in  Automotive",
            "BS in Industrial Education major in  Furniture and Cabinet Making",
            "BS in Industrial Education major in  Industrial Arts",
            "Bachelor of Elementary Education",
            "Bachelor of Secondary Education major in English",
            "Bachelor of Secondary Education major in General Science",
            "Bachelor of Secondary Education major in Music, Arts, Physical Education and Health",
            "Bachelor of Secondary Education major in Technology and Livelihood Education",
            "BS in Mathematics ",
            "BS in Environmental Science ",
            "Bachelor in Agricultural Technology",
            "BS in Home Technology major in Food and Nutrition",
            "BS in Industrial Education major in Automotive ",
            "BS in Information Technology ",
            "BS in Computer Science ",
            "BS in Agricultural Engineering  major in Agricultural Structures & Environmental Sanitation",
            "BS in Agricultural Engineering  major in Crop Processing",
            "BS in Agricultural Engineering  major in Soil and Water Management",
            "BS in Civil Engineering major in Geotechnical Engineering",
            "BS in Civil Engineering major in Hydraulics and Water Resources Engineering",
            "BS in Civil Engineering major in Structural Engineering",
            "BS in Civil Engineering major in Transportation Engineering",
            "BS in Geodetic Engineering",
            "BS in Business Administration  major in Financial Management",
            "BS in Business Administration  major in Marketing Management",
            "BS in Forestry",
            "BS in Agroforestry",
            "BS in Agriculture major in Agro-Fisheries",
            "BS in Agriculture major in Agronomy",
            "BS in Agriculture major in Animal Science",
            "BS in Agriculture major in Crop Protection",
            "BS in Agriculture major in Crop Science",
            "BS in Agriculture major in Horticulture",
            "BS in Agriculture major in Soil Science",
            "BS in Agricultural Engineering  major in Agricultural Structures & Environmental Sanitation",
            "BS in Agricultural Engineering  major in Crop Processing",
            "BS in Agricultural Engineering  major in Soil and Water Management",
            "Bachelor in Agricultural Technology",
            "Bachelor in Animal Science",
            "BS in Agribusiness",
            "BS in Agricultural Education",
        ];

        foreach ($courseCollection as $currentCourse) {
            $newCourse = new Course();
            $newCourse->course_name = $currentCourse;
            $newCourse->course_description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet quod nisi quisquam modi dolore, dicta obcaecati architecto quidem ullam quia.';
            $newCourse->course_unit = 3;
            if ($newCourse->save()) {
                echo "$currentCourse saved! \r\n";
            }
        }
        echo "Initial course data inserted \r\n";
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