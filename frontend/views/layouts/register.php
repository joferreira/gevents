<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
?>
<!-- REGISTER -->
<section class="page-section image" id="register">
	<div class="container">
		<h1 class="section-title">
			<span data-animation="flipInY" data-animation-delay="300" class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-user fa-stack-1x"></i></span></span>
			<span data-animation="fadeInRight" data-animation-delay="500" class="title-inner">Cadastre-se <small> </small></span>
		</h1>
		<!-- Cadastro Form -->
		<?php $form = ActiveForm::begin(['id' => 'cadastro-form', 'method' => 'post', 'action' => ['cliente/cadastro']] , ['class'=>'af-form row']); ?>
		<div class="row">
			<div class="col-sm-12 form-alert"></div>
			<div class="col-sm-6 col-md-3">
				 <?= $form->field($model, 'STR_NOME_COMPLETO', [
						'inputOptions' => [ 
							'placeholder' => $model->getAttributeLabel('Nome e Sobrenome'),
							'enableError' => true
						], 
						'inputTemplate' => '<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">{input}</div>',
				 ])->label(false); ?>
			</div>
			<div class="col-sm-6 col-md-3">
				<?= $form->field($model, 'STR_EMAIL', [
						'inputOptions' => [ 
							'placeholder' => $model->getAttributeLabel('O seu e-mail aqui '),
							'enableError' => true
						],
						'inputTemplate' => '<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">{input}</div>',
					])->label(false); ?>
			</div>
			<div class="col-sm-6 col-md-3">
				<?= $form->field($model, 'STR_SENHA', [
						'inputOptions' => [ 
							'placeholder' => $model->getAttributeLabel('Senha'),
							'enableError' => true
						],
						'inputTemplate' => '<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">{input}</div>',
					])->label(false)->passwordInput(); ?>
			</div>
			<div class="col-sm-6 col-md-3">
				<?= $form->field($model, 'STR_SENHA_CONFIRME', [
						'inputOptions' => [ 
							'placeholder' => $model->getAttributeLabel('Confirme a senha'),
							'enableError' => true
						], 
						'inputTemplate' => '<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">{input}</div>',
					])->label(false)->passwordInput(); ?>
			</div>
			<div class="col-md-12 overflowed">
				<div class="text-center margin-top">
					<?= Html::submitButton('Cadastre-se <i class="fa fa-arrow-circle-right"></i>', [
						'class' => 'btn btn-theme btn-theme-xl submit-button ',
						'name' => 'contact-button']) ?>
				</div>
			</div>
		</div>
		<?php ActiveForm::end(); ?>
		<!--form id="registration-form" name="registration-form" class="registration-form" action="#" method="post">
			<div class="row">
				<div class="col-sm-12 form-alert"></div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">
						<input
								type="text" class="form-control input-name"
								data-toggle="tooltip" title="Nome é obrigatório"
								placeholder="Nome e Sobrenome"/>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group" data-animation="fadeInUp" data-animation-delay="400">
						<input
								type="text" class="form-control input-email"
								data-toggle="tooltip" title="E-mail é obrigatório"
								placeholder="O seu e-mail aqui"/>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group" data-animation="fadeInUp" data-animation-delay="600">
						<input
								type="password" class="form-control input-password"
								data-toggle="tooltip" title="Senha"
								placeholder="Senha" />
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="form-group" data-animation="fadeInUp" data-animation-delay="600">
						<input
								type="password" class="form-control "
								data-toggle="tooltip" title="Confirme a senha"
								placeholder="Confirme a senha" />
					</div>
				</div>

				<div class="col-md-12 overflowed">
					<div class="text-center margin-top">
						<button
								data-animation="flipInY" data-animation-delay="100"
								class="btn btn-theme btn-theme-xl submit-button" type="submit"
								> Cadastre-se <i class="fa fa-arrow-circle-right"></i></button>
					</div>
				</div>
			</div>
		</form-->
		<!-- /Cadastro Form -->
	</div>
</section>
<!-- /REGISTER -->