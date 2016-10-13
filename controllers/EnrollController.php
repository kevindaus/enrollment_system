<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/14/16
 * Time: 4:02 AM
 */

namespace app\controllers;


use yii\web\Controller;

class EnrollController extends Controller{
    public function actionIndex()
    {
        //show enrollment form here
        return $this->render('index');
    }

} 