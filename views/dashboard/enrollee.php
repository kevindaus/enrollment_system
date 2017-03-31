<?php 

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\TypeaheadBasic;
use yii\widgets\Menu;

?>
<div class="row " >
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" class="main-container"><br>
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<?= Html::a('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back', '/dashboard',['class'=>'btn btn-block btn-primary btn-lg']); ?>
			<hr>
            <div class="panel panel-default hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">Side Menu</h3>
                </div>
                <div class="panel-body">
                    <div class="sidebar" style="display: block;">
                        <?=
                        Menu::widget([
                            'items' => [
                                ['label' => '<i class="glyphicon glyphicon-home"></i> Dashboard', 'url' => ['/dashboard']],
                                ['label' => '<i class="glyphicon glyphicon-user"></i> Enrolee', 'url' => ['/dashboard/enrollee']],
                                ['label' => '<i class="glyphicon glyphicon-user"></i> Enrolee', 'url' => ['/dashboard/enrollee']],
                            ],
                            'activeCssClass'=>'activeclass',
                            'encodeLabels'=>false,
                            'options'=>[
                                'class'=>'nav'
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Filter Record</h3>
				</div>
				<div class="panel-body">
					<?php $form = ActiveForm::begin() ?>
						<?= $form->field($filterForm, 'serial_number')->textInput() ?>
						<?= $form->field($filterForm, 'name')->textInput() ?>

                        <?=
                        $form
                            ->field($filterForm, 'application_form_status')
                            ->dropDownList([
                                \app\models\StudentInformation::APPLICATION_FORM_STATUS_APPROVED => 'APPROVED',
                                \app\models\StudentInformation::APPLICATION_FORM_STATUS_PENDING => 'PENDING'
                            ]);
                        ?>

						<?= $form->field($filterForm, 'gender')->dropDownList(["Male"=>"Male","Female"=>"Female"],['prompt'=>'Select gender']); ?>
						<?= $form->field($filterForm, 'address')->textInput() ?>
						<label>Ethnicity</label>
		                <?= 
		                    TypeaheadBasic::widget([
		                        'model' => $filterForm,
		                        'attribute' => 'ethnic_origin',
		                        'data' => $allEthnicity,
		                        'options' => ['placeholder' => 'Filter as you type ...'],
		                        'pluginOptions' => ['highlight'=>true],
		                    ]);
		                ?>
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
						<label>Course</label>
		                <?= 
		                    TypeaheadBasic::widget([
		                        'model' => $filterForm,
		                        'attribute' => 'course',
		                        'data' => $allCourses,
		                        'options' => ['placeholder' => 'Filter as you type ...'],
		                        'pluginOptions' => ['highlight'=>true],
		                    ]);
		                ?>
						<label>School Graduated</label>
		                <?= 
		                    TypeaheadBasic::widget([
		                        'model' => $filterForm,
		                        'attribute' => 'school_graduated',
		                        'data' => $allSchools,
		                        'options' => ['placeholder' => 'Filter as you type ...'],
		                        'pluginOptions' => ['highlight'=>true],
		                    ]);
		                ?>
						<label>Achievement</label>
		                <?= 
		                    TypeaheadBasic::widget([
		                        'model' => $filterForm,
		                        'attribute' => 'award',
		                        'data' => $allAwards,
		                        'options' => ['placeholder' => 'Filter as you type ...'],
		                        'pluginOptions' => ['highlight'=>true],
		                    ]);
		                ?>
		                <hr>
                        <?= Html::submitButton("Filter", ['class' => 'btn btn-primary btn-block']); ?>
                    <?php ActiveForm::end() ?>
                </div>
			</div>
		</div>
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<?php if (Yii::$app->session->hasFlash('examination_date_set_success')): ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= Yii::$app->session->getFlash('examination_date_set_success') ?>
                </div>
			<?php endif ?>
			<?= GridView::widget([
							'dataProvider' => $enroleeDataProvider,
							'columns' => [
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view} {update}',
                                    'buttons'=>[
                                        'view'=> function ($url, $model, $key) {
                                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '/applicant/'.$model->id);
                                        },
                                        'update'=> function ($url, $model, $key) {
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/applicant/update-personal-information/'.$model->id);
                                        },
                                        // 'delete'=> function ($url, $model, $key) {
                                        //     return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/applicant/update-personal-information/'.$model->id);
                                        // },
                                    ]
                                ],
								[
									'value'=>function($model){
										return sprintf("%s. %s %s %s" ,$model->title , $model->firstName,$model->middleName, $model->lastName);
									},
									'header'=>'Name',
								],
								'serial_number',
								'gender',
								'phoneNumber',
                                [
                                    'value'=>function($model){
                                    		$retVal = '<p class="text-success"> <span class="glyphicon glyphicon-check"></span> APPROVED</p>';
                                    		if ($model->application_form_status !== \app\models\StudentInformation::APPLICATION_FORM_STATUS_APPROVED) {
                                    			$retVal = Html::a("approve", Url::to(["/applicant/approve",'id'=>$model->id]), ['class'=>'btn btn-primary btn-block']);
                                    		}
                                    		return $retVal;
                                        },
                                    'header'=>'',
                                    'format'=>'html',
                                ],

                            ]
						]);?>			
		</div>
	</div>
</div>