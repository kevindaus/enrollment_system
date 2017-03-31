<?php
/**
 * @var $studentLoginForm \app\models\form\StudentLoginForm
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="row">
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>

	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<br>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Login</h3>
			</div>
			<div class="panel-body" style="">
   				<?php if (Yii::$app->session->hasFlash('login_error')): ?>

   					<div class="alert alert-danger">
   						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	   					<?= Yii::$app->session->getFlash('login_error') ?>
   					</div>
   				<?php endif ?>

		    <?php
			    $form = ActiveForm::begin([
		            'id' => 'login-form',
		            'options' => ['class' => 'form-horizontal','style'=>'padding: 10px;'],
		        ]);
		    ?>
		        <?= $form->field($studentLoginForm, 'serial_key')->textInput(['autofocus' => true]) ?>

		        <h3 class="text-center">
		        	OR
		        </h3>
		        <?= $form->field($studentLoginForm, 'firstName')->textInput() ?>
		        <?= $form->field($studentLoginForm, 'middleName')->textInput() ?>
		        <?= $form->field($studentLoginForm, 'lastName')->textInput() ?>


		        <div class="form-group">
		            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
		        </div>
		    <?php ActiveForm::end(); ?>	

			</div>
		</div>
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
</div>
