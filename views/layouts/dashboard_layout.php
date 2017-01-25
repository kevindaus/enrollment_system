<?php 
use yii\widgets\Menu;
use kartik\widgets\ActiveForm;

?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>


<div class="page-content">
	<div class="row ">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 side-panel">
				<br>
				<div class="panel panel-default">
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
							  	        ['label' => '<i class="glyphicon glyphicon-book"></i> Course', 'url' => ['/course']],
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
				<?= $this->blocks['additional_side_panel'] ?>
			</div>
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
				<?= $content ?>
			</div>
		</div>
	</div>
</div>


<?php $this->endContent();?>

