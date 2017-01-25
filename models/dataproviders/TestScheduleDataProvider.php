<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/15/17
 * Time: 5:44 AM
 */

namespace app\models\dataproviders;


use app\models\ExaminationLog;
use yii\base\Component;
use yii2fullcalendar\models\Event;

class TestScheduleDataProvider extends Component{
    public $model_class;
    /**
     * @var $start \DateTime
     */
    public $start;
    /**
     * @var $start \DateTime
     */
    public $end;

    public function getScheduledExams()
    {
        /**
         * @var $calendarEventObj Event
         */
        $collection = [];
        /*get all examination */

        /*get dates from start to end - except fridays and weekend*/
        $dateRange = new \DatePeriod($this->start, new \DateInterval("P1D"), $this->end);
        foreach ($dateRange as $currentDate) {
            if( !in_array($currentDate->format("l"),['Friday','Saturday','Sunday']) ){
                /*allowed dates only*/
                $numOfExamineesToday = ExaminationLog::find()->where(['date(created_at)'=>$currentDate->format("Y-m-d")])->count();
                $calendarEventObj = new $this->model_class();
                $calendarEventObj->id = uniqid();
                $calendarEventObj->description = 'wee';
                $calendarEventObj->title = 'Examinee : '.$numOfExamineesToday;
                $calendarEventObj->start = $currentDate->format('Y-m-d');
                $calendarEventObj->end = $currentDate->format('Y-m-d');
                $calendarEventObj->description = "Something nice";
                $collection[] = $calendarEventObj;

            }
        }
        return $collection;
    }
} 