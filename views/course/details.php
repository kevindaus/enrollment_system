<?php 

use yii\helpers\Html;


$this->params['breadcrumbs'][] = ['label' => 'Course'];
$this->params['breadcrumbs'][] = ['label' => $model->course_name];

?>



<div id="content">
	<div class="row">
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		</div>
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">

			<h2>
				<a href="#">
				<?= Html::encode($model->course_name); ?>
				</a>
		</h2>
			<hr>
			<h4>Course Information</h4>

			<ul>
				<li> <span>Units</span> <span><?= $model->course_unit ?></span></li>
			</ul>
			<hr>
			<h4>Description</h4>
				<?= $model->course_description ?>
			</div>

		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		</div>
	</div>
</div>

