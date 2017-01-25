<?php 



?>
<style type="text/css">
	#reminderContainer ul li {
		margin: 20px;
		font-size: 15px;
		list-style: square;
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
			<?php if (isset(Yii::$app->request->cookies['serial_number'])): ?>
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>
						Your LOGIN KEY IS : 
						<strong style='font-size: 15px'><?= Yii::$app->request->cookies['serial_number'] ?></strong>	
					</b> 
				</div>
			<?php endif ?>
			<div class="well" id="reminderContainer" >
				<h3>REQUIREMENTS FOR COLLEGE ADMISSION TEST (CAT)</h3>
				<ul>
					<li>Duly accomplished NVSU College Admission Test Application Form</li>
					<li>1 Copy of 2 x 2 ID Picture</li>
					<li>Non-Refundable CAT Fee of P 100.00</li>
				</ul>
				<hr>
				<h3>REQUIREMENTS IN CLAIMING COLLEGE ADMISSION TEST RESULT</h3>
				<ul>
					<li>Please personally claim your test result on a FRIDAY ( at Educational Testing Center of Bayombong Campus Examinees Guidance services unit for Bambang Campus Examinee)</li>
					<li>If you are <strong>Freshman</strong> bring with you your form 137/138 and copy of NCAE Result. <strong>Transferee</strong> bring your Transcript of records (TOR) . <strong>ALS Graduate</strong> bring your ALS Certificate</li>
				</ul>
				<hr>
				<h3>OTHER REMINDERS</h3>	
				<ul>
					<li> * You can take the NVSU-CAT only once . You may take it at Bayombong Campus or Bambang Campus.</li>
					<li> * Be well prepared before and during your examination day.</li>
					<li> * Your test schedule will depend on the available slot upon filling out of your application form.</li>
					<li> * Please file your duly accomplished application form 1 week before you take the NVSU-CAT</li>
					<li> * NVSU-CAT in conducted from MONDAY - THURSDAY on the following schedules 7:30AM - 9:00 AM.</li>
					<li> * Be at the Testing Venue at least 15 minutes early before your scheduled examination.</li>
				</ul>
			</div>		

		</div>

		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		</div>
	</div>
</div>
