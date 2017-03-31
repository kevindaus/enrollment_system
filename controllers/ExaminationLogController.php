<?php

namespace app\controllers;

use app\models\dataproviders\TestScheduleDataProvider;
use Yii;
use app\models\ExaminationLog;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ExaminationLogController implements the CRUD actions for ExaminationLog model.
 */
class ExaminationLogController extends Controller
{
     public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],        
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','view','admin','update','delete','json'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','create','view','admin','update','delete','json'],
                        'roles' => ['admin'],
                    ],

                ],
            ],
        ];
    }
    public function actionSchedule($date)
    {
        /*returns list of student that will take exam on given date*/
        $dataCollection = new ActiveDataProvider([
            'query'=>ExaminationLog::find()->where(['date(examination_date)'=>$date])
        ]);
        return $this->render('schedule', compact('dataCollection','date'));
    }
    public function actionJson($start,$end)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $testScheduleDataProvider = new TestScheduleDataProvider();
        $testScheduleDataProvider->start = \DateTime::createFromFormat("Y-m-d", $start);
        $testScheduleDataProvider->start->setTime(8, 0, 0);
        $testScheduleDataProvider->end = \DateTime::createFromFormat("Y-m-d", $end);
        $testScheduleDataProvider->end->setTime(4, 0, 0);
        $testScheduleDataProvider->model_class = \yii2fullcalendar\models\Event::className();
        $testScheduleCollection = $testScheduleDataProvider->getScheduledExams();
        return $testScheduleCollection;
    }
    /**
     * Lists all ExaminationLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ExaminationLog::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExaminationLog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ExaminationLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExaminationLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ExaminationLog model.
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
     * Deletes an existing ExaminationLog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ExaminationLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExaminationLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExaminationLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
