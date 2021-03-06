<?php

namespace app\controllers;

use app\models\form\StudentLoginForm;
use app\models\StudentInformation;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Cookie;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionTemplate()
    {
        /**
         * @var $testStudent StudentInformation
         */
        $testStudent = StudentInformation::find()->one();
        $pdfTemplate = Yii::getAlias("@app/template_docs".DIRECTORY_SEPARATOR .'College Admission Examinaion Permit.pdf');
        $exportedFilePath = $testStudent->exportTestingPermit($pdfTemplate);
        /*@TODO */
//        Yii::$app->response->xSendFile($exportedFilePath);
    }
    public function actionReminder()
    {
        return $this->render('reminder');
    }    

    public function actionIndex()
    {
        $availableCourses =\app\models\Course::find()->all(); 
        $numberOfCourses = \app\models\Course::find()->count();
        $signedUpStudents = \app\models\StudentInformation::find()->count();
        return $this->render('index',compact('numberOfCourses','signedUpStudents','availableCourses'));
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
