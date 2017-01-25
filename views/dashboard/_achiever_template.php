<?php 

use yii\grid\GridView;


?>
<h3><?= $title ?></h3>
<?= 
	GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			[
				'header'=>'Name',
				'value'=>function($model){
					return $model['title'] . '.' . $model['firstName'].' '.$model['lastName'];
				}
			],					
		],
		'layout'=>"{pager}\n{items}\n{summary}{pager}"
	]);
?>
<hr>