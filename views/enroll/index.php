<?php

use yii\widgets\ListView;

$this->params['breadcrumbs'][] = "Enrollment Form";

$customCss = <<< SCRIPT
	.mu-single-sidebar {
		background-color: white;
		padding: 10px;
		border-radius: 10px;
	}
	#studentinformation-bloodtype label {
		display: block;
		margin: 10px;
	}
SCRIPT;
$this->registerCss($customCss);

?>
<div id="mu-course-content">
	<div class="container">
		<div class="row">
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
				<?php if (Yii::$app->session->hasFlash("success")): ?>				
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?= Yii::$app->session->getFlash('success') ?>
				</div>
				<?php endif ?>
				<?= $this->render('_form', ['model' => $model, 'allAchievements'=>$allAchievements]); ?>			
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<aside class="mu-sidebar">
                  <!-- start single sidebar -->
                  <div class="mu-single-sidebar">
                    <h3>Popular Course</h3>
                    <div class="mu-single-sidebar">
                    	<?= ListView::widget([
                    		'layout' => '{items}',
                    		'dataProvider' => $allCourse,
                    		'itemView' => '//course/_list_course_name.php',
                    	]);?>
					</div>
                  </div>
                  <!-- end single sidebar -->
				</aside>
			</div>
		</div>
	</div>
</div>

