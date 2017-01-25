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
        <h2>Welcome</h2>
        <p>
          Nueva Vizcaya State University is a public university in the Philippines. 
        </p>
        <a href="<?= Url::to('/enroll') ?> " class="mu-read-more-btn">Enroll Now!</a>
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
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima officiis, deleniti dolorem exercitationem praesentium, est!
              </p>
            </div>
            <!-- Start single service -->
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-users"></span>
              <h3>Great Teachers</h3>
              <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima officiis, deleniti dolorem exercitationem praesentium, est!
              </p>
            </div>
            <!-- Start single service -->
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-table"></span>
              <h3>Great Facilities</h3>
              <p>

              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima officiis, deleniti dolorem exercitationem praesentium, est!
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
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum pariatur fuga eveniet soluta aspernatur rem, nam voluptatibus voluptate voluptates sapiente, inventore. Voluptatem, maiores esse molestiae.</p>
                  <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Saepe a minima quod iste libero rerum dicta!</li>
                    <li>Voluptas obcaecati, iste porro fugit soluta consequuntur. Veritatis?</li>
                    <li>Ipsam deserunt numquam ad error rem unde, omnis.</li>
                    <li>Repellat assumenda adipisci pariatur ipsam eos similique, explicabo.</li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis quaerat harum facilis excepturi et? Mollitia!</p>
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
              <h2>Courses</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio ipsa ea maxime mollitia, vitae voluptates, quod at, saepe reprehenderit totam aliquam architecto fugiat sunt animi!</p>
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
                      <a class="mu-course-details" href="#">Units</a>
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
