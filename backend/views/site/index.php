<?php
/* @var $this yii\web\View */

$this->title = 'Admin';
?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<div class="row">
			<?php echo $this->render('/layouts/boxComments'); ?>
			<?php echo $this->render('/layouts/boxTasks'); ?>
			<?php echo $this->render('/layouts/boxOrders'); ?>
			<?php echo $this->render('/layouts/boxSupport'); ?>
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-8">
				<?php echo $this->render('/layouts/boxChart'); ?>
				<?php echo $this->render('/layouts/boxTimeline'); ?>				
			<!-- /.col-lg-8 -->
			<div class="col-lg-4">
				<?php echo $this->render('/layouts/boxNotifications'); ?>
				<?php echo $this->render('/layouts/boxChartDonut'); ?>
				<?php echo $this->render('/layouts/boxChat'); ?>
			</div>
			<!-- /.col-lg-4 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /#page-wrapper -->

<!-- /#wrapper -->