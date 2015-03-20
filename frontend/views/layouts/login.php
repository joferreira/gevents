<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert; 
?>
<!-- LOGIN -->
<section class="page-section" id="login">
	<div class="container">
		<h1 class="section-title">
			<span data-animation="flipInY" data-animation-delay="300" class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-user fa-stack-1x"></i></span></span>
			<span data-animation="fadeInRight" data-animation-delay="500" class="title-inner">Login <small> </small></span>
		</h1>
		<!-- Login Form -->
		<!--form id="login-form" name="login-form" class="login-form" action="" method="post"-->
		<?php $form = ActiveForm::begin(['id' => 'login-form', 'method' => 'post', 'action' => ['cliente/login']] , ['class'=>'af-form row']); ?>
			<div>
				<?php 
				if (Yii::$app->session->hasFlash('cadastrado')):
					echo Alert::widget([
						'options' => [
							'class' => 'alert-success',
						],
						'body' => Yii::$app->session->getFlash('cadastrado'),
					]);
				endif;
				?>
			</div>		
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<?= $form->field($model, 'STR_EMAIL', [
							'inputOptions' => [ 
								'placeholder' => $model->getAttributeLabel('O seu e-mail aqui '),
								'enableError' => true
							],
							'inputTemplate' => '<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">{input}</div>',
						])->label(false); ?>
				</div>
				<div class="col-sm-6 col-md-4">
					<?= $form->field($model, 'STR_SENHA', [
							'inputTemplate' => '<div class="form-group" data-animation="fadeInUp" data-animation-delay="400">{input}</div>',
						])->label(false)->passwordInput([ 'placeholder' => 'Senha', 'enableError' => TRUE]); ?>
				</div>
				<div  class="col-sm-6 col-md-4">
					<div class="text-center">
						<?= Html::submitButton('Entrar <i class="fa fa-arrow-circle-right"></i>', [
							'class' => 'btn btn-theme btn-theme-xl submit-button '
							]) ?>
					</div>
				</div>
			</div>
			<?php ActiveForm::end(); ?>
			<!--div class="row">
				<div class="col-sm-12 form-alert"></div>
				<div class="col-sm-6 col-md-4">
					<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">
						<input
								type="text" class="form-control input-login"
								data-toggle="tooltip" title="Login é obrigatório"
								placeholder="Login"/>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="form-group" data-animation="fadeInUp" data-animation-delay="400">
						<input
								type="password" class="form-control input-name"
								data-toggle="tooltip" title="Senha"
								placeholder="Senha"/>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="text-center">
						<button
								data-animation="flipInY" data-animation-delay="100"
								class="btn btn-theme btn-theme-lg submit-button" type="submit"
								> Entrar <i class="fa fa-arrow-circle-right"></i></button>
					</div>
				</div>
			</div>
		</form-->
	</div>
</section>
<!-- /LOGIN -->