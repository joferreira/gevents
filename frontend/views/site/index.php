<?php
/* @var $this yii\web\View */
$this->title = 'Gigante dos Eventos';
?>
<!-- Content area -->
<?= $this->render('/layouts/slider', ['model'=>$cadastro,]); ?>
<? if(!empty($eventos) || !empty($destaques) ){ ?>
<!-- EVENT -->
<section id="event" class="page-section ">
	<div class="container">
		<h1 class="section-title">
			<span data-animation="flipInY" data-animation-delay="300" class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-star fa-stack-1x"></i></span></span>
			<span data-animation="fadeInRight" data-animation-delay="500" class="title-inner">Eventos<small></small></span>
		</h1>
<?= (!empty($destaques)) ? $this->render('/layouts/event_carousel',['objEventosDestaques'=>$destaques,]) : ''; ?>
<?= (!empty($eventos)) ? $this->render('/layouts/event_grid',['objEventos'=>$eventos,]) : ''; ?>
	</div>
</section>
<!-- /EVENT -->
<? } ?>
<?= $this->render('/layouts/about'); ?>
<?= $this->render('/layouts/login', ['model'=>$login,]); ?>
<?= $this->render('/layouts/register', ['model'=>$cadastro,]); ?>
<?= $this->render('/layouts/price'); ?>
<?= $this->render('/layouts/faq'); ?>
<?= $this->render('/layouts/contact', ['model'=>$contato,]); ?>
<!-- /Content area -->
