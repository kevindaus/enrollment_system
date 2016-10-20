<?php
/*@var $model app\models\Course*/

use yii\helpers\Html;
?>
<small>
	<?= Html::a($model->name, ['/course/details/'.$model->name]); ?>
</small>
