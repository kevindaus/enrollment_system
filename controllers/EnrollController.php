<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/14/16
 * Time: 4:02 AM
 */

namespace app\controllers;

use app\models\AwardsReceived;
use app\models\ElementaryEducationalAttaintment;
use app\models\events\ScheduleExaminationEventHandler;
use app\models\PreferredCourseForm;
use app\models\SecondaryEducationalAttaintment;
use app\models\StudentCourse;
use app\models\TertiaryEducationalAttaintment;
use app\models\VocationalEducationalAttaintment;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use \app\models\StudentInformation;
use yii\data\ActiveDataProvider;
use \app\models\Course;
use \app\models\EducationalAttainment;
use yii\web\Cookie;
use yii\web\UploadedFile;

class EnrollController extends Controller
{
     public function actions()
     {
         return [
             'captcha' => [
                 'class' => 'yii\captcha\CaptchaAction',
             ],
         ];
     }
    private function transformToSelectDatasource($arr)
    {
        $tempContainer = [];
        if (count($arr) === 0) {
            $tempContainer[] = '';
        } else {
            foreach ($arr as $key => $value) {
                $tempContainer[$key] = $value['name_of_school'];
            }
        }
        return $tempContainer;
    }

    public function actionIndex()
    {
        $newStudent = new \app\models\StudentInformation(['date_taken' => date("Y-m-d H:i:s")]);
        if (!isset($newStudent->citizenship)) {
            $newStudent->citizenship = "Filipino";
        }
        $newStudent->application_form_status = StudentInformation::APPLICATION_FORM_STATUS_PENDING;
        $allAchievements = AwardsReceived::getAllAchievements();
        $allAvailableCourses = Course::getAllAvailableCourses();

        $allElementarySchools = EducationalAttainment::getAllElementarySchool();
        $allElementarySchools = $this->transformToSelectDatasource($allElementarySchools);
        $allHighSchools = EducationalAttainment::getAllHighSchool();
        $allHighSchools = $this->transformToSelectDatasource($allHighSchools);
        $allVocationalSchools = EducationalAttainment::getAllVocationalSchool();
        $allVocationalSchools = $this->transformToSelectDatasource($allVocationalSchools);
        $allTertiarySchools = EducationalAttainment::getAllTertiarySchool();
        $allTertiarySchools = $this->transformToSelectDatasource($allTertiarySchools);
        /*educational attainment*/
        $elementaryEducationalAttainment = new ElementaryEducationalAttaintment();
        $elementaryEducationalAttainment->education = "Elementary";
        $secondaryEducationalAttainment = new SecondaryEducationalAttaintment();
        $secondaryEducationalAttainment->education = "Secondary";
        $vocationalEducationalAttainment = new VocationalEducationalAttaintment();
        $vocationalEducationalAttainment->education = "Vocational";
        $tertiaryEducationalAttainment = new TertiaryEducationalAttaintment();
        $tertiaryEducationalAttainment->education = "Tertiary";

        /*course preferences */
        /*make sure all is valid before saving*/
        $preferredCourseForm = new PreferredCourseForm();

        if ($preferredCourseForm->load(Yii::$app->request->post()) && $preferredCourseForm->validate()) {
            if ($newStudent->load(Yii::$app->request->post())) {
                /* prepare and save student picture*/
                $uploadedProfilePicture = UploadedFile::getInstance($newStudent, 'student_picture');
                if($uploadedProfilePicture){
                    $newStudent->saveStudentPicture($uploadedProfilePicture);
                } else if (isset($_POST['webcam_photo']) && !empty($_POST['webcam_photo'])) {
                    /*create new FileUpload object*/

                    $rawImg = str_replace('data:image/png;base64,', '', $_POST['webcam_photo']);
                    $rawImg = str_replace(' ', '+', $rawImg);
                    $imgData = base64_decode($rawImg);

                    // $tempFileContainer = tempnam(sys_get_temp_dir(), $newStudent->firstName);

                    /*create a file in the output folder*/
                    $uploadedImagesPath = Yii::getAlias('@app/uploads/student_pictures');
                    $finalImagename = sprintf("%s_%s_%s_%s_%s_%s.%s", date("Y_m_d"), $newStudent->title, $newStudent->firstName, $newStudent->middleName, $newStudent->lastName, uniqid(),'.png');
                    /*write the contents to the image file*/
                    file_put_contents($uploadedImagesPath . DIRECTORY_SEPARATOR . $finalImagename, $imgData);
                    /*set the filename to student_picture */
                    $newStudent->student_picture = $finalImagename;
               }

                /* prepare and save certificate requirement */
                $studentRequirementCert = UploadedFile::getInstances($newStudent, 'requirement_certificate');
                if($studentRequirementCert){
                    $newStudent->saveStudentCeritificateRequirement($studentRequirementCert);
                }

                if ($newStudent->validate()) {
                    /*save in the database and generate serial number*/
                    $newStudent->save(false);
                    /*save student educational attainment*/
                    if ($elementaryEducationalAttainment->load(Yii::$app->request->post()) && $elementaryEducationalAttainment->save()) {
                        $elementaryEducationalAttainment->student_id = $newStudent->id;
                        $elementaryEducationalAttainment->save(false);
                        $elementaryEducationalAttainment->update(false, [
                            'education' => 'Elementary',
                        ]);
                        if (Yii::$app->request->post('elementaryEducationalAttainmentAwards')) {
                            $awardsCollection = Yii::$app->request->post('elementaryEducationalAttainmentAwards');
                            foreach ($awardsCollection as $currentAward) {
                                $currentAwardObj = new AwardsReceived();
                                $currentAwardObj->education_attainment_id = $elementaryEducationalAttainment->id;
                                $currentAwardObj->awards_name = $currentAward;
                                $currentAwardObj->save();
                            }
                        }
                    }
                    if ($secondaryEducationalAttainment->load(Yii::$app->request->post()) && $secondaryEducationalAttainment->save()) {
                        $secondaryEducationalAttainment->student_id = $newStudent->id;
                        $secondaryEducationalAttainment->save(false);
                        $secondaryEducationalAttainment->update(false, [
                            'education' => 'Secondary'
                        ]);
                        if (Yii::$app->request->post('secondaryEducationalAttainmentAwards')) {
                            $awardsCollection = Yii::$app->request->post('secondaryEducationalAttainmentAwards');
                            foreach ($awardsCollection as $currentAward) {
                                $currentAwardObj = new AwardsReceived();
                                $currentAwardObj->education_attainment_id = $secondaryEducationalAttainment->id;
                                $currentAwardObj->awards_name = $currentAward;
                                $currentAwardObj->save();
                            }
                        }
                    }

                    if ($vocationalEducationalAttainment->load(Yii::$app->request->post()) && $vocationalEducationalAttainment->save()) {
                        $vocationalEducationalAttainment->student_id = $newStudent->id;
                        $vocationalEducationalAttainment->save(false);
                        $vocationalEducationalAttainment->update(false, [
                            'education' => 'Vocation'
                        ]);
                        if (Yii::$app->request->post('tertiaryEducationalAttainmentAwards')) {
                            $awardsCollection = Yii::$app->request->post('tertiaryEducationalAttainmentAwards');
                            foreach ($awardsCollection as $currentAward) {
                                $currentAwardObj = new AwardsReceived();
                                $currentAwardObj->education_attainment_id = $vocationalEducationalAttainment->id;
                                $currentAwardObj->awards_name = $currentAward;
                                $currentAwardObj->save();
                            }
                        }
                    }
                    if ($tertiaryEducationalAttainment->load(Yii::$app->request->post()) && $tertiaryEducationalAttainment->save()) {
                        $tertiaryEducationalAttainment->student_id = $newStudent->id;
                        $tertiaryEducationalAttainment->save(false);
                        $tertiaryEducationalAttainment->update(false, [
                            'education' => 'Tertiary'
                        ]);
                        if (Yii::$app->request->post('tertiaryEducationalAttainmentAwards')) {
                            $awardsCollection = Yii::$app->request->post('tertiaryEducationalAttainmentAwards');
                            foreach ($awardsCollection as $currentAward) {
                                $currentAwardObj = new AwardsReceived();
                                $currentAwardObj->education_attainment_id = $tertiaryEducationalAttainment->id;
                                $currentAwardObj->awards_name = $currentAward;
                                $currentAwardObj->save();
                            }
                        }
                    }
                    /*save student course*/
                    $studentPreferedCourseFirst = new StudentCourse();
                    $studentPreferedCourseFirst->student_id = intval($newStudent->id);
                    $studentPreferedCourseFirst->course_id = intval($preferredCourseForm->firstPreferredCourse);
                    $studentPreferedCourseFirst->save();
                    $studentPreferedCourseSecond = new StudentCourse();
                    $studentPreferedCourseSecond->student_id = intval($newStudent->id);
                    $studentPreferedCourseSecond->course_id = intval($preferredCourseForm->secondPreferredCourse);
                    $studentPreferedCourseSecond->save();
                    $studentPreferedCourseThird = new StudentCourse();
                    $studentPreferedCourseThird->student_id = intval($newStudent->id);
                    $studentPreferedCourseThird->course_id = intval($preferredCourseForm->thirdPreferredCourse);
                    $studentPreferedCourseThird->save();
                    $newCookie = new Cookie();
                    $newCookie->name = "serial_number";
                    $newCookie->value = $newStudent->serial_number;
                    Yii::$app->response->cookies->add($newCookie);
                    Yii::$app->session->setFlash('success', "Success! You have been listed. Please read the reminder for further information/instruction. ");
                    return $this->redirect("/student-information/".$newStudent->serial_number);

                }

            }
        }

        return $this->render('index', compact(
            'allElementarySchools',
            'allHighSchools',
            'allVocationalSchools',
            'allTertiarySchools',
            'newStudent',
            'allAchievements',
            'allAvailableCourses',
            'preferredCourseForm',
            'elementaryEducationalAttainment',
            'secondaryEducationalAttainment',
            'vocationalEducationalAttainment',
            'tertiaryEducationalAttainment'
        ));
    }


} 