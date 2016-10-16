<?php

$this->params['breadcrumbs'][] = "Enrollment Form";


$customCss = <<< SCRIPT
	.alert-success {
		margin-top: 20px;
	}
SCRIPT;
$this->registerCss($customCss);
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<?php if (Yii::$app->session->hasFlash("success")): ?>				
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?= Yii::$app->session->getFlash('success') ?>
			</div>
			<?php endif ?>
			<?= $this->render('_form', ['model' => $model, ]); ?>
		</div>
	</div>
</div>

