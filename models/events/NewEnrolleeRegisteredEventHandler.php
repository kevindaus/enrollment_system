<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/11/17
 * Time: 6:08 AM
 */

namespace app\models\events;


use app\models\ExaminationLog;
use app\models\StudentInformation;
use Dompdf\Exception;
use yii\base\Event;

class NewEnrolleeRegisteredEventHandler {
    /**
     * This event handler register the new enrolle and examination date.
     * This class make sures that it only schedule student depending on number of maximum number of enrollee
     * per examination date. Else it schedules the student on the next examination date except Fridays and weekends.
     * @param $event Event
     * @throws \Dompdf\Exception
     */
    public static function handle($event){
        /**
         * @var $model StudentInformation
         * @var $lastExamLog ExaminationLog
         * @var $examinationDate  \DateTime
         */
        $model = $event->data;
        /*@compute and create examination schedule*/
        $lastExamLog = ExaminationLog::find()->orderBy('id DESC')->one();
        $examinationDate = new \DateTime();//defaults to today
        if($lastExamLog){
            //compute the next examination date.
            $tempContainer = explode(" ", $lastExamLog->examination_date);
            \Yii::warning($tempContainer[0] . 'wee');
            $examinationDate = \DateTime::createFromFormat("Y-m-d",$tempContainer[0]);
            //accomodate only max_allowed_student_test_center = 50 , 50 test takers at a time or per day
            // TODO : question : is this 50 a day... or 50 at AM , then 50 at PM?
            if(  intval($model->id) % \Yii::$app->params['max_allowed_student_test_center'] === 0 ){
                //next examination date , make sure its not weekend and not friday
                do{
                    $examinationDate->add(new \DateInterval("P1D"));

                    //should be on fridays and Sat , and the date must be in the future
                    $dtToday= new \DateTime();
                }while( !($examinationDate  <  $dtToday )  || in_array($examinationDate->format("l"),['Friday','Saturday','Sunday']));
            }
        }
        $examLog = new ExaminationLog();
        $examLog->student_id = $model->id;

        // \Yii::warning('wee'.$model->id);
        $examLog->examination_date = $examinationDate->format("Y-m-d");
        // \Yii::warning('wee'.$examLog->examination_date);

        if(!$examLog->save()){
            throw new Exception("Cant create new examination schedule");
        }
    }
}