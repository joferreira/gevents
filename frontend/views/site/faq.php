<?php
/* @var $this yii\web\View */
$this->title = 'Gigante dos Eventos - FAQ';
?>
<!-- FAQ -->
<section id="faq" class="page-section light">
	<div style="height:50px;"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-8 pull-left">
				<h1 class="section-title">
					<span data-animation="flipInY" data-animation-delay="300" class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-question fa-stack-1x"></i></span></span>
					<span data-animation="fadeInRight" data-animation-delay="500" class="title-inner">Gigante FAQS <small> / encontre suas respostas</small></span>
				</h1>
			</div>
		</div>
		<div class="row faq" data-animation="fadeInUp" data-animation-delay="100">
			<form id="faq-form" name="faq-form" class="faq-form" action="" method="post">
				<div class="row">
					<div class="col-sm-12 form-alert"></div>
					<div class="col-sm-6 col-md-8">
						<div class="form-group" data-animation="fadeInUp" data-animation-delay="200">
							<input type="text" class="form-control input-faq" data-toggle="tooltip" title="" placeholder="Qual é a sua Dúvida ?"/>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="text-center">
							<button data-animation="flipInY" data-animation-delay="100" class="btn btn-theme btn-theme-lg submit-button" type="submit" > Buscar <i class="fa fa-arrow-circle-right"></i></button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!--div class="row faq margin-top" data-animation="fadeInUp" data-animation-delay="100">
			<div class="col-sm-6 col-md-6 pull-left">
				<ul id="tabs-faq"  class="nav">
					<li class="active"><a href="#tab-faq1" data-toggle="tab"><i class="fa fa-angle-right"></i> <span class="faq-inner">Como criar um HotEvent ?</span></a></li>
					<li><a href="#tab-faq2" data-toggle="tab"><i class="fa fa-plus"></i> <span class="faq-inner">Como publicar meu evento ?</span></a></li>
					<li><a href="#tab-faq3" data-toggle="tab"><i class="fa fa-plus"></i> <span class="faq-inner">Como despublicar meu evento ?</span></a></li>
					<li><a href="#tab-faq4" data-toggle="tab"><i class="fa fa-plus"></i> <span class="faq-inner">Como colocar preços ?</span></a></li>
				</ul>
			</div>
			<div class="col-sm-6 col-md-6 pull-right">
				<div class="tab-content">
					<div id="tab-faq1" class="tab-pane fade in active">
						<div>
							<p>O HotEvent, nada mais é, do que uma página de seu evento, ou seja, um local onde o seu evento irá possuir o contato direto com o seu público alvo de maneira simples e eficiente, contando com um excelente layout que chamará a atenção. Os passos são bem simples para a criação.</p>
							<div class="row">
								<div class="col-md-6">
									<p><i class="fa fa-check-circle-o"></i> Crie seu evento junto com as informações necessárias</p>
									<p><i class="fa fa-check-circle-o"></i> Configure seu formulário</p>
									<p><i class="fa fa-check-circle-o"></i> Crie seus ingressos caso seu o evento possua</p>
								</div>
								<div class="col-md-6">
									<p><i class="fa fa-check-circle-o"></i> Escolha a forma de pagamento caso o seu ingresso possua</p>
									<p><i class="fa fa-check-circle-o"></i> Visualize todo o layout criado</p>
									<p><i class="fa fa-check-circle-o"></i> Publique seu HotEvent</p>
								</div>
							</div>
						</div>
					</div>
					<div id="tab-faq2" class="tab-pane fade">
						<div>
							<p>Seu evento estará somente disponível, quando você tiver toda a certeza de que está tudo correto. Através de uma forma simples, você poderá visualizar todo o conteúdo do HotEvent, visualizando os ingressos, google maps, formulário, preços, formas de pagamentos, contato e a descrição. É fácil e simples !</p>
							<div class="row">
								<div class="col-md-6">
									<p><i class="fa fa-check-circle-o"></i> Verifique a configuração do seu evento</p>
									<p><i class="fa fa-check-circle-o"></i> Confira novamente o formulário</p>
									<p><i class="fa fa-check-circle-o"></i> Confira novamente os ingressos (se possuir)</p>
								</div>
								<div class="col-md-6">
									<p><i class="fa fa-check-circle-o"></i> Confira as formas de pagamentos habilitadas</p>
									<p><i class="fa fa-check-circle-o"></i> Visualize todo o HotEvent criado</p>
									<p><i class="fa fa-check-circle-o"></i> Publique seu evento</p>
								</div>
							</div>
						</div>
					</div>
					<div id="tab-faq3" class="tab-pane fade">
						<div>
							<p>Todo evento criado, poderá ser descontinuado a qualquer momento. Não existe segredo e nem quebra-cabeças para isso. Você poderá despublicar o seu evento, a qualquer momento que desejar. E não se preocupe ! Porque o efeito é imediato e você <strong>"nunca perderá"</strong> as inscrições ou pagamentos efetuados no evento.</p>
							<div class="row">
								<div class="col-md-6">
									<p><i class="fa fa-check-circle-o"></i> Faça login e visualize a tela com os seus eventos</p>
									<p><i class="fa fa-check-circle-o"></i> Busque pelo evento desejado</p>
									<p><i class="fa fa-check-circle-o"></i> Visualize o botão vermelho despublicar</p>
								</div>
								<div class="col-md-6">
									<p><i class="fa fa-check-circle-o"></i> Clique em despublicar</p>
									<p><i class="fa fa-check-circle-o"></i> Confirme a despublicação do evento</p>
									<p><i class="fa fa-check-circle-o"></i> Pronto! Seu evento está despublicado</p>
								</div>
							</div>
						</div>
					</div>
					<div id="tab-faq4" class="tab-pane fade">
						<div>
							<p>É tão simples, você poderá incluir e excluir preços em seus ingressos ao qualquer momento, mesmo que o seu evento esteja acontecendo. Você poderá colocar os preços em ingressos, palestras, estacionamentos e demais atividades que o seu evento possuir.</p>
							<div class="row">
								<div class="col-md-6">
									<p><i class="fa fa-check-circle-o"></i> Faça login e visualize a tela com os seus eventos</p>
									<p><i class="fa fa-check-circle-o"></i> Escolha o evento desejado</p>
									<p><i class="fa fa-check-circle-o"></i> Vá no menu "preços"</p>
								</div>
								<div class="col-md-6">
									<p><i class="fa fa-check-circle-o"></i> Visualize os ingressos e atividades com valores</p>
									<p><i class="fa fa-check-circle-o"></i> Clique em alterar</p>
									<p><i class="fa fa-check-circle-o"></i> Altere o preço e salve</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div-->
	</div>
</section>
<!-- /FAQ -->