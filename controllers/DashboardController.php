<?php

namespace app\controllers;

use app\helpers\DatasourceTransformer;
use app\models\AwardsReceived;
use app\models\dataproviders\TestScheduleDataProvider;
use app\models\EducationalAttainment;
use app\models\FilterEnrolleForm;
use app\models\QuickEnrolleeSearchForm;
use app\models\StudentInformation;
use app\models\Course;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\HttpException;
use yii2fullcalendar\models\Event;
use yii2fullcalendar\yii2fullcalendar;

class DashboardController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','enrollee','view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','enrollee','view'],
                        'roles' => ['admin'],
                    ]
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $this->layout = "dashboard_layout";
        $todaysEnrollees = StudentInformation::find()
            ->limit(10)
            ->where(['date(created_at)'=>date("Y-m-d")])
            ->orderBy("id DESC");
        $enroleeDataProvider = new ActiveDataProvider([
            'query'=>  $todaysEnrollees,
        ]);


        $maleCount = StudentInformation::getMaleCount();
        $femaleCount = StudentInformation::getFemaleCount();

        $valedictoriansDataProvider  = new ArrayDataProvider([
            'allModels'=>  StudentInformation::findValedictoriansArr(),
        ]);
        $salutatoriansDataProvider  = new ArrayDataProvider([
            'allModels'=>  StudentInformation::findSalutatoriansArr(),
        ]);
        $athletesDataProvider  = new ArrayDataProvider([
            'allModels'=>  StudentInformation::findAthletesArr(),
        ]);

        $courseEnrolleeDataProvider = Course::getCourseEnrolleeDataProvider();

        $searchEnrolleeForm = new QuickEnrolleeSearchForm();
        $foundEnrollees = null;
        if ($searchEnrolleeForm->load(\Yii::$app->request->post()) && $searchEnrolleeForm->validate() ) {
            $foundEnrollees = $searchEnrolleeForm->searchEnrollee();
            if (!$foundEnrollees) {
                \Yii::$app->session->setFlash("no_enrollee_found", "Sorry , " . Html::encode($searchEnrolleeForm->searchKey) . " enrollee doesn't exists in the record");
            }
        }
        return $this->render('index',compact(
            'enroleeDataProvider',
            'searchEnrolleeForm',
            'foundEnrollees',
            'maleCount',
            'femaleCount',
            'courseEnrolleeDataProvider',
            'valedictoriansDataProvider',
            'salutatoriansDataProvider',
            'athletesDataProvider'
        ));
    }
    public function actionEnrollee()
    {
        /*datasources for autocomplete*/
        $allSchools = EducationalAttainment::getAllSchools();
        $allSchools = DatasourceTransformer::transformSchoolCollection($allSchools);
        $allSchools = count($allSchools) === 0 ? []:$allSchools;
        $allEthnicity = StudentInformation::getAllEthnicity();
        $allEthnicity = DatasourceTransformer::transformEthnicityCollection($allEthnicity);
        $allEthnicity = count($allEthnicity) === 0 ? []:$allEthnicity;
        $allAwards = AwardsReceived::getAllAchievements();
        $allAwards = count($allAwards) === 0 ? []:$allAwards;
        $allCourses = Course::getAllAvailableCourses();

        $allCourses = count($allCourses) === 0 ? []:$allCourses;
        /*end of datasources*/
        $filterForm = new FilterEnrolleForm();
        $queryModel = StudentInformation::find();
        if ($filterForm->load(\Yii::$app->request->post())) {
            $queryModel = $filterForm->getFilterQuery();
        }
        $enroleeDataProvider = new ActiveDataProvider(['query'=>$queryModel]);
        return $this->render('enrollee',compact(
                'enroleeDataProvider',
                'queryModel',
                'filterForm',
                'allSchools',
                'allEthnicity',
                'allAwards',
                'allCourses'
            ));
    }


    /**
     * Deletes an existing StudentInformation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $studentModel = $this->findModel($id);
        $allEducationalAttainments = EducationalAttainment::find()->where(['student_id' => $studentModel->id])->all();
        foreach ($allEducationalAttainments as $currentEducationalAttainment) {
            $allawards = AwardsReceived::find()->where(['education_attainment_id'=>$currentEducationalAttainment->id])->all();
            foreach ($allawards as $currentAward) {
                $currentAward->delete();
            }
            $currentEducationalAttainment->delete();
        }
        $studentModel->delete();

        return $this->redirect(['enrollee']);
    }

    /**
     * Displays a single StudentInformation model.
     * @param $enroleeId
     * @throws \yii\web\HttpException
     * @internal param int $id
     * @return mixed
     */
    public function actionView($enroleeId)
    {
        //temporaryirly allow user to view its current
        $temporaryStudentId = \Yii::$app->request->cookies->get("temp_edit_student");
        if (is_null($temporaryStudentId) && \Yii::$app->user->isGuest) {
            throw new HttpException(403, "You are not allowed to access this part");
        }
        $currentEnrollee = $this->findModel($enroleeId);
        $preferredCourses = $currentEnrollee->getPrefferedCourses();
        return $this->render('view', [
            'enrolleeModel' => $currentEnrollee,
            'preferredCourses' => $preferredCourses
        ]);
    }

    /**
     * Updates an existing StudentInformation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the StudentInformation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @throws \yii\web\HttpException
     * @return StudentInformation the loaded model
     */
    protected function findModel($id)
    {

        if (($model = StudentInformation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404,'The requested page does not exist.');
        }
    }    

}
