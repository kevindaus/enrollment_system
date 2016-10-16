<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/14/16
 * Time: 5:39 AM
 */

namespace app\commands;


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
} 