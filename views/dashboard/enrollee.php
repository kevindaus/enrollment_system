<?php 

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

?>
<div class="row " >
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" class="main-container"><br>
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Filter Record</h3>
				</div>
				<div class="panel-body">
					<?php $form = ActiveForm::begin() ?>
						<?= $form->field($filterForm, 'name')->textInput() ?>
						<?= $form->field($filterForm, 'gender')->dropDownList(["Male"=>"Male","Female"=>"Female"],['prompt'=>'Select gender']); ?>
						<?= $form->field($filterForm, 'address')->textInput() ?>
						<?= $form->field($filterForm, 'ethnic_origin')->textInput() ?>
		                <?= 
		                    $form
		                    ->field($filterForm, 'civil_status')
		                    ->dropDownList([
		                        'Single'=>'Single',
		                        'Married'=>'Married',
		                        'Widowed'=>'Widowed',
		                        'Separated'=>'Separated',
		                        'Divorced'=>'Divorced'
		                    ],['prompt'=>'Select gender']); 
		                ?>
						<?= $form->field($filterForm, 'course')->textInput() ?>
						<?= $form->field($filterForm, 'school_graduated')->textInput() ?>
						<?= $form->field($filterForm, 'award')->textInput() ?>
                        <?= Html::submitButton("Filter", ['class' => 'btn btn-primary btn-block']); ?>
                    <?php ActiveForm::end() ?>
                </div>
			</div>
		</div>
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<?= GridView::widget([
							'dataProvider' => $enroleeDataProvider,
							'columns' => [
								[
									'value'=>function($model){
										return sprintf("%s. %s %s %s" ,$model->title , $model->firstName,$model->middleName, $model->lastName);
									},
									'header'=>'Name',
								],
								'phoneNumber',
								'gender',
								'civil_status',
					            [
					            	'class' => 'yii\grid\ActionColumn',
					            	'buttons'=>[
						            	'view'=> function ($url, $model, $key) {
									        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '/enrollee/'.$model->id);
									    },
						            	'update'=> function ($url, $model, $key) {
									        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/enrollee/update-personal-information/'.$model->id);
									    },
					            	]

					            ],
							]
						]);?>			
		</div>
	</div>
</div>