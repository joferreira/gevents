<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
?>
<div id="main">
	<!-- SLIDER -->
	<section class="page-section no-padding background-img-slider">
		<div class="container">

		<div id="main-slider" class="owl-carousel owl-theme">

			<!-- Slide -->
			<!--div class="item page text-center slide0">
				<div class="caption">
					<div class="container">
						<div class="div-table">
							<div class="div-cell">
								<h2 class="caption-title" data-animation="fadeInDown" data-animation-delay="100"><span>4 de Julho de 2015</span></h2>
								<h3 class="caption-subtitle" data-animation="fadeInUp" data-animation-delay="300">Gigante dos Eventos</h3>
								<div class="countdown-wrapper">
									<div id="defaultCountdown" class="defaultCountdown clearfix"></div>
								</div>
								<p class="caption-text">
									<a class="btn btn-theme btn-theme-xl scroll-to" href="#register" data-animation="flipInY" data-animation-delay="600"> Cadastre-se <i class="fa fa-arrow-circle-right"></i></a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div-->

			<!-- Slide -->
			<div class="item page text-center slide1">
				<div class="caption">
				<div class="container">
					<div class="div-table">
					<div class="div-cell">
						<h2 class="caption-title" data-animation="fadeInDown" data-animation-delay="100"><span>Uma forma diferente de se fazer eventos</span></h2>
						<h3 class="caption-subtitle" data-animation="fadeInUp" data-animation-delay="300">Gigante dos Eventos</h3>
						<p class="caption-text">
							<a class="btn btn-theme btn-theme-xl scroll-to" href="#register" data-animation="flipInY" data-animation-delay="600"> Cadastre-se <i class="fa fa-arrow-circle-right"></i></a>
							<a class="btn btn-theme btn-theme-xl btn-theme-transparent-white hidden" href="http://www.youtube.com/watch?v=O-zpOMYRi0w" data-gal="prettyPhoto" data-animation="flipInY" data-animation-delay="900">Watch video</a>
						</p>
					</div>
					</div>
				</div>
				</div>
			</div>

			<!-- Slide -->
			<div class="item page slide2">
				<div class="caption">
				<div class="container">
					<div class="div-table">
					<div class="div-cell">
						<div class="row">
							<div class="col-md-6 col-lg-4">
								<div class="form-background">
								<div class="form-header color">
									<h1 class="section-title">
										<span class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-user fa-stack-1x"></i></span></span>
										<span class="title-inner">Cadastro</span>
									</h1>
								</div>
								<!-- Cadastro Form -->
								<?php $form = ActiveForm::begin(['id' => 'cadastroform', 'method' => 'post', 'action' => ['cliente/cadastro']] , ['class'=>'af-form row']); ?>
								<div class="row">
									<div class="col-sm-12 form-alert"></div>
									<div class="col-sm-12">
										 <?= $form->field($model, 'STR_NOME_COMPLETO', [
												'inputOptions' => [ 
													'placeholder' => $model->getAttributeLabel('Nome e Sobrenome'),
													'enableError' => true
												], 
												'inputTemplate' => '<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">{input}</div>',
										 ])->label(false); ?>
									</div>
									<div class="col-sm-12">
										<?= $form->field($model, 'STR_EMAIL', [
												'inputOptions' => [ 
													'placeholder' => $model->getAttributeLabel('O seu e-mail aqui '),
													'enableError' => true
												],
												'inputTemplate' => '<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">{input}</div>',
											])->label(false); ?>
									</div>
									<div class="col-sm-12">
										<?= $form->field($model, 'STR_SENHA', [
												'inputOptions' => [ 
													'placeholder' => $model->getAttributeLabel('Senha'),
													'enableError' => true
												],
												'inputTemplate' => '<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">{input}</div>',
											])->label(false)->passwordInput(); ?>
									</div>
									<div class="col-sm-12">
										<?= $form->field($model, 'STR_SENHA_CONFIRME', [
												'inputOptions' => [ 
													'placeholder' => $model->getAttributeLabel('Confirme a senha'),
													'enableError' => true
												], 
												'inputTemplate' => '<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">{input}</div>',
											])->label(false)->passwordInput(); ?>
									</div>
									<div class="col-sm-12">
										<div class="text-center">
											<?= Html::submitButton('Cadastre-se <i class="fa fa-arrow-circle-right"></i>', [
												'class' => 'btn btn-theme btn-theme-xl submit-button ',
												'name' => 'contact-button']) ?>
										</div>
									</div>
								</div>
								<?php ActiveForm::end(); ?>

								<!--form id="registration-form-alt" name="registration-form-alt" class="registration-form alt" action="#" method="post">
									<div class="row">
										<div class="col-sm-12 form-alert"></div>
										<div class="col-sm-12">
											<div class="form-group">
												<input
														type="text" class="form-control input-name"
														data-toggle="tooltip" title="Nome é obrigatório"
														placeholder="Nome e Sobrenome"/>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<input
														type="text" class="form-control input-email"
														data-toggle="tooltip" title="E-mail é obrigatório"
														placeholder="O seu e-mail aqui"/>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<input
														type="password" class="form-control input-password"
														data-toggle="tooltip" title="Senha"
														placeholder="Senha" />
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<input
														type="password" class="form-control "
														data-toggle="tooltip" title="Confirme a senha"
														placeholder="Confirme a senha" />
											</div>
										</div>
										<div class="col-sm-12">
											<div class="text-center">
												<button
														data-animation="flipInY" data-animation-delay="100"
														class="btn btn-theme btn-block submit-button" type="submit"
														> Cadastre-se Agora <i class="fa fa-arrow-circle-right"></i></button>
											</div>
										</div>
									</div>
								</form-->

								</div>
							</div>
							<div class="col-md-6 col-lg-8">
								<div class="text-holder">
								<h2 class="caption-title">Bem vindo ao</h2>
								<h3 class="caption-subtitle">Gigante dos Eventos </h3>
								</div>
							</div>
						</div>
						<!-- Event description -->
						<!-- /Event description -->
					</div>
					</div>
				</div>
				</div>
			</div>

			<!-- Slide -->
			<!--div class="item page text-center slide3">
				<div class="caption">
				<div class="container">
					<div class="div-table">
					<div class="div-cell">
						<h2 class="caption-title"><span>4 de Julho de 2015</span></h2>
						<h3 class="caption-subtitle">Gigante dos Eventos</h3>
						<p class="caption-text">
							<a class="btn btn-play" href="http://www.youtube.com/watch?v=O-zpOMYRi0w" data-gal="prettyPhoto"><i class="fa fa-play"></i></a>
						</p>
					</div>
					</div>
				</div>
				</div>
			</div-->

		</div>
		</div>

		<!-- Event description -->
		<!--div class="event-description">
			<div class="container">
			<div class="row">
			<div class="event-background">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="media">
										<span class="pull-left">
											<i class="fa fa-calendar fa-2x"></i>
										</span>
								<div class="media-body">
									<h4 class="media-heading">Date</h4>
									<span>January 17- 19, 2014</span>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<div class="media">
										<span class="pull-left">
											<i class="fa fa-map-marker fa-2x"></i>
										</span>
								<div class="media-body">
									<h4 class="media-heading">Location</h4>
									<span>3200 Barbaros Bulvarı Besiktas/Istanbul, TR</span>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-2">
							<div class="media">
										<span class="pull-left">
											<i class="fa fa-group fa-2x media-object"></i>
										</span>
								<div class="media-body">
									<h4 class="media-heading">Remaining</h4>
									<span>245 Tickets</span>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="media">
										<span class="pull-left">
											<i class="fa fa-microphone fa-2x"></i>
										</span>
								<div class="media-body">
									<h4 class="media-heading">Speakers</h4>
									<span>24 Professional Speakers</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			</div>
		</div-->
		<!-- /Event description -->

	</section>
	<!-- /SLIDER -->
</div>