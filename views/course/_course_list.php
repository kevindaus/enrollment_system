<?php 

use \yii\helpers\Html;

?>
<div class="mu-latest-course-single">
  <figure class="mu-latest-course-img">
    <figcaption class="mu-latest-course-imgcaption">
        <?= Html::a( mb_strimwidth($model->course_name,0,30,'...')  , '/course/details/'.str_replace(' ', '-', $model->course_name), []); ?>
      	<span>
			<?= $model->course_unit ?> Units
  		</span>

    </figcaption>
  </figure>
  <div class="mu-latest-course-single-content">
    <h4><a href="#"><?= $model->course_name ?> </a></h4>
    <p>
		<?= $model->course_description ?> 
    </p>
    <div class="mu-latest-course-single-contbottom">
       <?= Html::a( 'Details', '/course/details/'.str_replace(' ', '-', $model->course_name), ['class'=>'mu-course-details']); ?>
    </div>
  </div>
</div>
