<?php
namespace tests\codeception\unit\events;

use _generated\UnitTesterActions;
use app\models\events\ScheduleExaminationEventHandler;
use app\models\ExaminationLog;
use app\models\StudentInformation;
use Codeception\Specify;
use Faker\Factory;
use Faker\Provider\tr_TR\DateTime;

class NewEnrolleeEventHandlerUnitTest extends \Codeception\TestCase\Test
{
    use Specify;
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected function setUp()
    {
        parent::setUp();
    }

    public function test_event_handler_new_enrollee()
    {
        /*clean records*/
        ExaminationLog::deleteAll();
        StudentInformation::deleteAll();
        \Yii::$app->db->createCommand("ALTER TABLE student_information AUTO_INCREMENT=1")->execute();
        \Yii::$app->db->createCommand("ALTER TABLE examination_log AUTO_INCREMENT=1")->execute();
        $this->specify("Insert 50 records will fill up the first batch of test takers", function () {
            $faker = Factory::create();
            $faker->seed(50);
            /*insert 50 records*/
            foreach (range(1, 50) as $currentNum) {
                $newstudent = new StudentInformation();
                $newstudent->requirement_certificate = uniqid();
                $newstudent->student_picture = uniqid();
                $newstudent->title = $faker->title();
                $newstudent->firstName = $faker->firstName();
                $newstudent->lastName = $faker->lastName;
                $newstudent->civil_status = 'single';
                $newstudent->gender = 'Male';
                $newstudent->citizenship = 'Filipino';
                $newstudent->age = 23;
                //attach event handlers
                $newstudent->on(StudentInformation::SCHEDULE_FOR_EXAMINATION, [new ScheduleExaminationEventHandler(), 'handle'], $newstudent);
                $this->tester->assertTrue($newstudent->save(), 'We should successfully insert new record');
                $newstudent->trigger(StudentInformation::SCHEDULE_FOR_EXAMINATION);
                /*save in the database and generate serial number*/
                if($currentNum === 1){
                    $firstExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_ASC])->one();
                    $tempDt = new \DateTime($firstExamLog->examination_date);
                    $this->tester->assertEquals("07:30 AM" ,$tempDt->format("h:i A"), 'First record should have 07:30 as examination date');
                }
                if ($currentNum === 50) {
                    $lastExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_DESC])->one();
                    $tempDt = new \DateTime($lastExamLog->examination_date);
                    $this->tester->assertEquals("07:30 AM" ,$tempDt->format("h:i A"), 'First record should have 07:30 as examination date');
                }
            }

            $this->tester->assertNotEquals(0, StudentInformation::find()->count(),'There should be student records in the database');
            $this->tester->assertEquals(50 , StudentInformation::find()->count(),'There should be 50 student records in the database');

            $this->tester->assertNotEquals(0, ExaminationLog::find()->count(), 'There should records in the examination log table');

            /*get first and last examination log*/
            $firstExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_ASC])->one();
            $lastExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_DESC])->one();
            $this->tester->assertEquals(date("Y-m-d H:i", strtotime($firstExamLog->examination_date)), date("Y-m-d H:i", strtotime($lastExamLog->examination_date)), 'Assert that the first and last record in the examination log has the same date and time');
        });

        $this->specify("Insert another 50 records that will fill up the second batch of test takers", function () {
            $faker = Factory::create();
            $faker->seed(50);
            /*insert 50 records*/
            foreach (range(1, 50) as $currentNum) {
                $newstudent = new StudentInformation();
                $newstudent->requirement_certificate = uniqid();
                $newstudent->student_picture = uniqid();
                $newstudent->title = $faker->title();
                $newstudent->firstName = $faker->firstName();
                $newstudent->lastName = $faker->lastName;
                $newstudent->civil_status = 'single';
                $newstudent->gender = 'Male';
                $newstudent->citizenship = 'Filipino';
                $newstudent->age = 23;
                //attach event handlers
                $newstudent->on(StudentInformation::SCHEDULE_FOR_EXAMINATION, [new ScheduleExaminationEventHandler(), 'handle'], $newstudent);
                /*save in the database and generate serial number*/
                $this->tester->assertTrue($newstudent->save(), 'We should successfully insert new record');
                $newstudent->trigger(StudentInformation::SCHEDULE_FOR_EXAMINATION);
                if($currentNum == 1){
                    $this->tester->assertEquals(51 , StudentInformation::find()->count(),'There should be 51 student records in the database');
                    $this->tester->assertEquals(51 , ExaminationLog::find()->count(),'There should be 51 logs in the examination record');

                    $lastExamLogInserted = ExaminationLog::find()->orderBy(['id'=>SORT_DESC])->one();//get the fresh insert. fool!
                    $tempDt = new \DateTime($lastExamLogInserted->examination_date);
                    $this->tester->assertEquals("09:30 AM" ,$tempDt->format("h:i A"), 'First record on the newest batch should have 09:30 as examination date');
                }
                if ($currentNum === 50) {
                    $lastExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_DESC])->one();
                    $tempDt = new \DateTime($lastExamLog->examination_date);
                    $this->tester->assertEquals("09:30 AM" ,$tempDt->format("h:i A"), 'First record should have 07:30 as examination date');
                }

            }
            /*get first and last examination log*/
            $firstExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_ASC])->one();
            $lastExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_DESC])->one();

            $this->tester->assertEquals(date("Y-m-d", strtotime($firstExamLog->examination_date)), date("Y-m-d", strtotime($lastExamLog->examination_date)), 'Assert that the first and last record in the examination log has the same date');
            $strcontainer1 = date("Y-m-d H:i", strtotime($firstExamLog->examination_date));
            $strcontainer2 = date("Y-m-d H:i", strtotime($lastExamLog->examination_date));
            $this->tester->assertNotEquals(  $strcontainer1  ,$strcontainer2 , 'Assert that the first and last record in the examination log has the same date but different time');
            $this->tester->assertEquals("09:30 AM", date("h:i A", strtotime($lastExamLog->examination_date)), 'The last examinee should be on 9:30 am batch');
        });

        ExaminationLog::deleteAll();
        StudentInformation::deleteAll();
        \Yii::$app->db->createCommand("ALTER TABLE student_information AUTO_INCREMENT=1")->execute();
        \Yii::$app->db->createCommand("ALTER TABLE examination_log AUTO_INCREMENT=1")->execute();
    }

    public function test_date_should_be_in_the_future()
    {
        /*clean records*/
        ExaminationLog::deleteAll();
        StudentInformation::deleteAll();
        \Yii::$app->db->createCommand("ALTER TABLE student_information AUTO_INCREMENT=1")->execute();
        \Yii::$app->db->createCommand("ALTER TABLE examination_log AUTO_INCREMENT=1")->execute();

        $this->specify("Insert 50 records will fill up the first batch of test takers", function () {
            /*insert 50 records*/
            $faker = Factory::create();
            $faker->seed(50);
            foreach (range(1, 50) as $currentNum) {
                $newstudent = new StudentInformation();
                $newstudent->requirement_certificate = uniqid();
                $newstudent->student_picture = uniqid();
                $newstudent->title = $faker->title();
                $newstudent->firstName = $faker->firstName();
                $newstudent->lastName = $faker->lastName;
                $newstudent->civil_status = 'single';
                $newstudent->gender = 'Male';
                $newstudent->citizenship = 'Filipino';
                $newstudent->age = 23;
                //attach event handlers
                $newstudent->on(StudentInformation::SCHEDULE_FOR_EXAMINATION, [new ScheduleExaminationEventHandler(), 'handle'], $newstudent);
                $this->tester->assertTrue($newstudent->save(), 'We should successfully insert new record');
                $newstudent->trigger(StudentInformation::SCHEDULE_FOR_EXAMINATION);
                /*save in the database and generate serial number*/
            }
            $this->tester->assertNotEquals(0, StudentInformation::find()->count(),'There should be student records in the database');
            $this->tester->assertNotEquals(0, ExaminationLog::find()->count(), 'There should records in the examination log table');
            /*get first and last examination log*/
            $firstExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_ASC])->one();
            $lastExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_DESC])->one();
            $this->tester->assertEquals(date("Y-m-d", strtotime($firstExamLog->examination_date)), date("Y-m-d", strtotime($lastExamLog->examination_date)), 'Assert that the first and last record in the examination log has the same date');
        });

        /*get the last exam log from the database , update the examination date , minus 10 days */
        $mockedDate = new \DateTime();
        $mockedDate = $mockedDate->sub(new \DateInterval("P10D"));
        $lastExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_DESC])->one();

        $lastExamLog->examination_date = $mockedDate->format("Y-m-d H:i:s");
        $lastExamLog->update();
        /*insert single record , */
        $faker = Factory::create();
        $newstudent = new StudentInformation();
        $newstudent->requirement_certificate = uniqid();
        $newstudent->student_picture = uniqid();
        $newstudent->title = $faker->title();
        $newstudent->firstName = $faker->firstName();
        $newstudent->lastName = $faker->lastName;
        $newstudent->civil_status = 'single';
        $newstudent->gender = 'Male';
        $newstudent->citizenship = 'Filipino';
        $newstudent->age = 23;
        //attach event handlers
        $newstudent->on(StudentInformation::SCHEDULE_FOR_EXAMINATION, [new ScheduleExaminationEventHandler(), 'handle'], $newstudent);
        $this->tester->assertTrue($newstudent->save(), 'We should successfully insert new record');
        $newstudent->trigger(StudentInformation::SCHEDULE_FOR_EXAMINATION);

        /*test examination date is not less than today */
        $lastExamLog = ExaminationLog::find()->orderBy(['id'=>SORT_DESC])->one();
        $examDt = new \DateTime($lastExamLog->examination_date);
        $dtToday= new \DateTime();
        $this->tester->assertTrue( ($examDt  >  $dtToday ) , 'The date should not be less than today');

        ExaminationLog::deleteAll();
        StudentInformation::deleteAll();
        \Yii::$app->db->createCommand("ALTER TABLE student_information AUTO_INCREMENT=1")->execute();
        \Yii::$app->db->createCommand("ALTER TABLE examination_log AUTO_INCREMENT=1")->execute();
    }


}
