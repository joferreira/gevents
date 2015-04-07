<?php
/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>

<div id="page-wrapper">

	<br/>
	<div class="row">
		<?php echo $this->render('/layouts/boxComments'); ?>
		<?php echo $this->render('/layouts/boxTasks'); ?>
		<?php echo $this->render('/layouts/boxOrders'); ?>
		<?php echo $this->render('/layouts/boxSupport'); ?>
	</div>
	<div class="row">
		<div class="col-md-8">
			<?php echo $this->render('/layouts/boxChart'); ?>
		</div>
		<div class="col-md-4">
			<?php echo $this->render('/layouts/boxNotifications'); ?>
			<?php echo $this->render('/layouts/boxChartDonut'); ?>
			<?php echo $this->render('/layouts/boxChat'); ?>
		</div>
	</div>
</div>

<script src="/gevents/frontend/web/modules/morrisjs/morris.min.js"></script>
<script src="/gevents/frontend/web/modules/js/morris-data.js"></script>
<!-- /#page-wrapper -->
