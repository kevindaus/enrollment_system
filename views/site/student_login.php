<?php

?>

<div class="row">

	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<br>
			<br>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Student Login</h3>
			</div>
			<div class="panel-body">
				<form action="" method="POST" role="form">
					<legend>Form title</legend>
                    <?php
                    use yii\bootstrap\ActiveForm;
                    use yii\helpers\Html;

                    $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal'],
                        ]);
                    ?>
                        <?= $form->field($model, 'serial_key')->textInput(['autofocus' => true]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
				</form>
			</div>
		</div>		
	</div>
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
</div>