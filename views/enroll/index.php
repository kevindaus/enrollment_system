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
			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">				
			</div>

			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">

				<?php if (Yii::$app->session->hasFlash("success")): ?>				
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?= Yii::$app->session->getFlash('success') ?>
				</div>
				<?php endif ?>
				<h1>Enrollment Form</h1>
				<hr>
				<?= 
					$this->render('_form', compact(
						'newStudent',
						'allAchievements',
			        	'elementaryEducationalAttainment',
			        	'secondaryEducationalAttainment',
			        	'vocationalEducationalAttainment',
			        	'tertiaryEducationalAttainment'
					)); 
				?>
			</div>
			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
			</div>

		</div>
	</div>
</div>

