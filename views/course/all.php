<?php 
use \yii\widgets\ListView;
$this->params['breadcrumbs'][] = ['label' => 'Courses'];
?>
<div class="col-md-2 col-lg-2">	
</div>
<div class="col-md-8 col-lg-8">
	<br>
	<br>
	<br>
	<?= ListView::widget([
		'dataProvider' => $dataprovider,
		'itemView' => '_course_list',
		'layout' => "{summary}<br><br>{items}\n\n{pager}",
	]);?>
	
</div>
<div class="col-md-2 col-lg-2">
</div>

