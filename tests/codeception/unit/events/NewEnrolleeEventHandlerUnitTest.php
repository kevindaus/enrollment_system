<?php
namespace tests\codeception\unit\events;

use _generated\UnitTesterActions;
use app\models\events\NewEnrolleeRegisteredEventHandler;
use app\models\ExaminationLog;
use app\models\StudentInformation;
use Codeception\Specify;
use Faker\Factory;

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
        $this->specify("Insert 50 records will fill up the first batch of test takers", function () {
            /*insert 50 records*/
            foreach (range(1, 50) as $currentNum) {
                $faker = Factory::create();
                $faker->seed(100);

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
                $newstudent->on(StudentInformation::NEW_STUDENT_REGISTERED, [new NewEnrolleeRegisteredEventHandler(), 'handle'], $newstudent);
                $this->tester->assertTrue($newstudent->save(), 'We should successfully insert new record');
                $newstudent->trigger(StudentInformation::NEW_STUDENT_REGISTERED);
                /*save in the database and generate serial number*/
            }
            $this->tester->assertNotEquals(0, StudentInformation::find()->count(),'There should be student records in the database');
            $this->tester->assertNotEquals(0, ExaminationLog::find()->count(), 'There should records in the examination log table');
            /*get first and last examination log*/
            $firstExamLog = ExaminationLog::find()->orderBy('id ASC')->one();
            $lastExamLog = ExaminationLog::find()->orderBy('id DESC')->one();
            $this->tester->assertEquals(date("Y-m-d", strtotime($firstExamLog->examination_date)), date("Y-m-d", strtotime($lastExamLog->examination_date)), 'Assert that the first and last record in the examination log has the same date');
        });

        $this->specify("Insert another 50 records that will fill up the second batch of test takers", function () {
            /*insert 50 records*/
            foreach (range(1, 50) as $currentNum) {
                $faker = Factory::create();
                $faker->seed(100);

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
                $newstudent->on(StudentInformation::NEW_STUDENT_REGISTERED, [new NewEnrolleeRegisteredEventHandler(), 'handle'], $newstudent);
                /*save in the database and generate serial number*/
                $this->tester->assertTrue($newstudent->save(), 'We should successfully insert new record');
                $newstudent->trigger(StudentInformation::NEW_STUDENT_REGISTERED);
            }
            /*get first and last examination log*/
            $firstExamLog = ExaminationLog::find()->orderBy('id ASC')->one();
            $lastExamLog = ExaminationLog::find()->orderBy('id DESC')->one();
            $this->tester->assertNotEquals(date("Y-m-d", strtotime($firstExamLog->examination_date)), date("Y-m-d", strtotime($lastExamLog->examination_date)), 'Assert that the first and last record in the examination log has the same date');
        });
    }

    public function test_date_should_be_in_the_future()
    {
        /*clean records*/
        ExaminationLog::deleteAll();
        StudentInformation::deleteAll();
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
                $newstudent->on(StudentInformation::NEW_STUDENT_REGISTERED, [new NewEnrolleeRegisteredEventHandler(), 'handle'], $newstudent);
                $this->tester->assertTrue($newstudent->save(), 'We should successfully insert new record');
                $newstudent->trigger(StudentInformation::NEW_STUDENT_REGISTERED);
                /*save in the database and generate serial number*/
            }
            $this->tester->assertNotEquals(0, StudentInformation::find()->count(),'There should be student records in the database');
            $this->tester->assertNotEquals(0, ExaminationLog::find()->count(), 'There should records in the examination log table');
            /*get first and last examination log*/
            $firstExamLog = ExaminationLog::find()->orderBy('id ASC')->one();
            $lastExamLog = ExaminationLog::find()->orderBy('id DESC')->one();
            $this->tester->assertEquals(date("Y-m-d", strtotime($firstExamLog->examination_date)), date("Y-m-d", strtotime($lastExamLog->examination_date)), 'Assert that the first and last record in the examination log has the same date');
        });

        /*get the last exam log from the database , update the examination date , minus 10 days */
        $mockedDate = new \DateTime();
        $mockedDate->sub(new \DateInterval("P10D"));
        $lastExamLog = ExaminationLog::find()->orderBy('id DESC')->one();
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
        $newstudent->on(StudentInformation::NEW_STUDENT_REGISTERED, [new NewEnrolleeRegisteredEventHandler(), 'handle'], $newstudent);
        $this->tester->assertTrue($newstudent->save(), 'We should successfully insert new record');
        $newstudent->trigger(StudentInformation::NEW_STUDENT_REGISTERED);
        /*test examination date is not less than today */
        $lastExamLog = ExaminationLog::find()->orderBy('id DESC')->one();
        $examDt = new \DateTime($lastExamLog->examination_date);
        $dtToday= new \DateTime();
        $this->tester->assertTrue( ($examDt  <  $dtToday ) , 'The date should not theless than today');        
    }


}
