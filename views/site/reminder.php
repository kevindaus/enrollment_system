<?php 


?>
<style type="text/css">
	#reminderContainer ul li {
		margin: 20px;
		font-size: 15px;
	}

</style>

<div id="content">
	<div class="row">
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		</div>
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<br>
			<?php if (Yii::$app->session->hasFlash('success')): ?>				
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?= Yii::$app->session->getFlash('success') ?>
			</div>
			<?php endif ?>
			<div class="well" id="reminderContainer" >
				<h2>Reminders</h2>	
				<ul>
					<li> * You can take the NVSU-CAT only once . You may take it at Bayombong Campus or Bambang Campus.</li>
					<li> * Be well prepared before and during your examination day.</li>
					<li> * Your test schedule will depend on the available slot upon filling out of your application form.</li>
					<li> * Please file yoour duly accomplished application form 1 week before you take the NVSU-CAT</li>
					<li> * NVSU-CAT in conducted from MONDAY - THURSDAY on the following schedules 7:30AM - 9:00 AM.</li>
					<li> * Be at the Testing Venue at least 15 minutes early before your scheduled examination.</li>
				</ul>
			</div>		

		</div>

		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		</div>
	</div>
</div>
