<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Welcome to NVSU Enrollment System';


?>



  <!-- Start Slider -->
  <section id="mu-slider">
    <!-- Start single slider item -->
    <div class="mu-slider-single" style="width: 1349px;height: 500px;overflow-y: hidden;">
      <div class="mu-slider-img">
        <figure>
          <img src="/assets/img/slider/1.jpg" alt="img">
        </figure>
      </div>
      <div class="mu-slider-content">
        <h2>
            Welcome to Nueva Vizcaya State University Online Application
        </h2>
        <h3>
          for College Entrance Examination
        </h3>
        <a href="<?= Url::to('/enroll') ?> " class="mu-read-more-btn">Apply Now!</a>
      </div>
    </div>
    <!-- Start single slider item -->
  </section>

  <!-- End Slider -->
  <!-- Start service  -->
  <section id="mu-service">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-service-area">
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-book"></span>
              <h3>Enroll Now</h3>
              <p>
NVSU offers the quality education needed by the students to meet the competitive global standards.              
              </p>
            </div>
            <!-- Start single service -->
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-users"></span>
              <h3>Great Teachers</h3>
              <p>
                The NVSU faculty and staff are accomplished experts and leaders in their fields and professions

              </p>
            </div>
            <!-- Start single service -->
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-table"></span>
              <h3>Great Facilities</h3>
              <p>
              Efficiency, the university is committed to provide excellent service towards its constituents.
              </p>
            </div>
            <!-- Start single service -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End service  -->


  <!-- Start about us -->
  <section id="mu-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-about-us-area">           
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-left">
                  <!-- Start Title -->
                  <div class="mu-title">
                    <h2>About Us</h2>              
                  </div>
                  <!-- End Title -->
                  <p>

                    The Nueva Vizcaya State University is a historical metamorphosis of two entities merged to form a stronger academic alliance in Cagayan Valley. It has two campuses formerly known as the Nueva Vizcaya State Institute of Technology (NVSIT) and Nueva Vizcaya State Polytechnic College (NVSPC).

                  </p>
                  <p>
                    The former campuses were the two biggest state-run colleges in the province of Nueva Vizcaya. The NVSIT has a total area of 148.5 hectares situated at the foot of the scenic Bangan Hill in Bayombong, the capital town of the province. The NVSPC campus, on the other hand, has an area of 14.21 hectares in Bambang, the center for trade and commerce of the province.
                  </p>

                  <ul>
                    <li>
                      <a href="http://www.nvsu.edu.ph/personnel/faculty-staff/faculty-directory.php">Our Faculty</a>
                    </li>
                    <li>
                      <a href="http://www.nvsu.edu.ph/academics/university-colleges/bayombong-campus.php">Our Colleges</a>
                    </li>
                    <li>
                      <a href="http://www.nvsu.edu.ph/offices/">Our Offices</a>
                    </li>
                    <li>
                      <a href="http://www.nvsu.edu.ph/academics/university-facilities/index.php">Our Facilities</a>
                    </li>
                    <li>
                      <a href="http://www.nvsu.edu.ph/university-news-archive.php">Our News Archives</a>
                    </li>                    
                  </ul>

                </div>
              </div>
              <div class="col-lg-6 col-md-6">

                <div class="mu-about-us-right">                            
                <a id="mu-abtus-video" href="//www.youtube.com/embed/pbVR2iqwoiI" target="mutube-video">
                  <img src="/assets/img/about-us-clean-final.png" alt="img">
                </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End about us -->


  <!-- Start about us counter -->
  <section id="mu-abtus-counter">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-abtus-counter-area">
            <div class="row">
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-book"></span>
                  <h4 class="counter"><?= app\models\Course::find()->count() ?></h4>
                  <p>Courses</p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-users"></span>
                  <h4 class="counter"><?= app\models\StudentInformation::find()->count() ?></h4>                  
                  <p>Enrollees</p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-flask"></span>
                  <h4 class="counter"><?= \Yii::$app->params['number_of_lab'] ?></h4>
                  <p>Modern Lab</p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single no-border">
                  <span class="fa fa-user-secret"></span>
                  <h4 class="counter"><?= \Yii::$app->params['number_of_teachers'] ?></h4>
                  <p>Teachers</p>
                </div>
              </div>
              <!-- End counter item -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End about us counter -->

  <!-- Start latest course section -->
  <section id="mu-latest-courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-latest-courses-area">
            <!-- Start Title -->
            <div class="mu-title">
              <h2>Available Courses</h2>
            </div>
            <!-- End Title -->
            <!-- Start latest course content -->
            <div id="mu-latest-course-slide" class="mu-latest-courses-content">
              <?php foreach ($availableCourses as $key => $currentCourse): ?>
              <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="mu-latest-course-single">
                  <figure class="mu-latest-course-img hidden">
                    <a href="#"><img src="assets/img/courses/1.jpg" alt="img"></a>
                    <figcaption class="mu-latest-course-imgcaption">
                      <a href="#"></a>
                      <span><i class="fa fa-clock-o"></i></span>
                    </figcaption>
                  </figure>
                  <div class="mu-latest-course-single-content">
                    <h4>
                      <?= Html::a( mb_strimwidth($currentCourse->course_name,0,30,'...')  , '/course/details/'.str_replace(' ', '-', $currentCourse->course_name), []); ?>
                    </h4>
                    <p>
                      <?= mb_strimwidth($currentCourse->course_description,0,100,'...')  ?>
                    </p>
                    <div class="mu-latest-course-single-contbottom">
                      <strong class="mu-course-details" href="#">Units</strong>
                      <span class="mu-course-price" href="#">
                        <?= Html::encode($currentCourse->course_unit); ?>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach ?>



            </div>
            <!-- End latest course content -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End latest course section -->
