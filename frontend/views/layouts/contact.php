<!-- PAGE CONTACT -->
<section class="page-section color">
	<div class="container">

		<h1 class="section-title">
			<span data-animation="flipInY" data-animation-delay="100" class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-ticket fa-stack-1x"></i></span></span>
			<span data-animation="fadeInRight" data-animation-delay="100" class="title-inner">Contato <small></small></span>
		</h1>

		<!-- Contact form -->
		<form name="af-form" method="post" action="#contact" class="af-form row" id="af-form">

			<div class="col-sm-12 af-outer af-required">
				<div class="form-group af-inner">
					<input
							type="text" name="name" id="name" placeholder="Digite o seu nome..." value="" size="30"
							data-toggle="tooltip" title="Name is required"
							class="form-control placeholder"/>
				</div>
			</div>

			<div class="col-sm-12 af-outer af-required">
				<div class="form-group af-inner">
					<input
							type="text" name="email" id="email" placeholder="Digite o seu Email..." value="" size="30"
							data-toggle="tooltip" title="Email is required"
							class="form-control placeholder"/>
				</div>
			</div>

			<div class="col-sm-12 af-outer af-required">
				<div class="form-group af-inner">
					<textarea
							name="message" id="input-message" placeholder="Digite a sua Mensagem..." rows="4" cols="50"
							data-toggle="tooltip" title="Message is required"
							class="form-control placeholder"></textarea>
				</div>
			</div>

			<div class="col-sm-12 af-outer af-required text-center">
				<div class="form-group af-inner">
					<input type="submit" name="submit" class="form-button form-button-submit btn btn-theme btn-theme-lg btn-theme-transparent" id="submit_btn" value="Enviar mensagem" />
				</div>
			</div>

		</form>
		<!-- /Contact form -->

	</div>
</section>
<!-- /PAGE CONTACT -->