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

class ScheduleExaminationEventHandler {
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
        $lastExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_DESC])->one();
        $examinationDate = new \DateTime();//defaults to today
         $dtToday = new \DateTime();
        if($lastExamLog){
            //compute the next examination date.
            $tempContainer = strtotime($lastExamLog->examination_date);
            $examinationDate = \DateTime::createFromFormat("Y-m-d H:i:s", date("Y-m-d H:i:s",$tempContainer)  );

            //accomodate only max_allowed_student_test_center = 50 , 50 test takers at a time or per day
            while( ( $examinationDate  <=  $dtToday )  || in_array($examinationDate->format("l"),['Friday','Saturday','Sunday'])){
                    $examinationDate->add(new \DateInterval("P1D"));
            }
            if(  intval($lastExamLog->id) % \Yii::$app->params['max_allowed_student_test_center'] === 0 ){
                \Yii::warning(PHP_EOL.PHP_EOL."Changing batch , " . $model->id);
                \Yii::warning("Date is  " . $examinationDate->format("Y-m-d H:i:s"));
                if ( $examinationDate->format("h:i A") == "07:30 AM" ) {
                    // if 07:30 AM , then set time to 9:30 AM
                    $examinationDate->setTime(9, 30, 0);
                } else if( $examinationDate->format("h:i A") == "09:30 AM" ){
                    // else if 09:30 AM , then set time to 1:30 PM
                    $examinationDate->setTime(13, 30, 0);
                } else if ($examinationDate->format("h:i A") == "01:30 PM"){
                    // else if 01:30 PM , then set time to 7:30 AM
                    $examinationDate->add(new \DateInterval("P1D"));
                    $examinationDate->setTime(7, 30, 0);
                } else {
                    // else default to 7:30 AM
                    $examinationDate->setTime(7, 30, 0);
                }
                \Yii::warning("Date is now " . $examinationDate->format("Y-m-d H:i:s"));
            }
        }
        else {
            while( ($examinationDate < $dtToday ||  $examinationDate->format("Y-m-d") ===   $dtToday->format("Y-m-d")) || in_array($examinationDate->format("l"),['Friday','Saturday','Sunday'])){
                $examinationDate->add(new \DateInterval("P1D"));
                $examinationDate->setTime(7, 30, 0);
            }
        }
        $examLog = new ExaminationLog();
        $examLog->student_id = $model->id;
        $examLog->examination_date = $examinationDate->format("Y-m-d H:i:s");

        if(!$examLog->save()){
            throw new Exception("Cant create new examination schedule");
        }
    }
}