<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\bootstrap\Alert;
use yii\base\View;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>

	<title><?= Html::encode($this->title) ?></title>

	<!-- Favicons -->
	<link href="/gevents/frontend/web/ico/apple-touch-icon-144-precomposed.png" sizes="144x144" rel="apple-touch-icon-precomposed">
	<link href="/gevents/frontend/web/ico/favicon.ico" rel="shortcut icon">

	<?php $this->head(); ?>

	<link rel="stylesheet" href="/gevents/frontend/web/plugins/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/gevents/frontend/web/plugins/bootstrap-select/bootstrap-select.min.css">
	<link rel="stylesheet" href="/gevents/frontend/web/plugins/owlcarousel2/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="/gevents/frontend/web/plugins/owlcarousel2/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="/gevents/frontend/web/plugins/prettyphoto/css/prettyPhoto.css">
	<link rel="stylesheet" href="/gevents/frontend/web/plugins/animate/animate.min.css">
	<link rel="stylesheet" href="/gevents/frontend/web/plugins/countdown/jquery.countdown.css">
	<link rel="stylesheet" href="/gevents/frontend/web/css/theme.css">
	<link rel="stylesheet" href="/gevents/frontend/web/css/theme-red-1.css">
	<link rel="stylesheet" href="/gevents/frontend/web/css/custom.css">
	<link rel="stylesheet" href="/gevents/frontend/web/js/theme-config.css">

	<script src="/gevents/frontend/web/plugins/modernizr.custom.js"></script>
	<script src="/gevents/frontend/web/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="/gevents/frontend/web/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="/gevents/frontend/web/plugins/superfish/js/superfish.js"></script>
	<script src="/gevents/frontend/web/plugins/prettyphoto/js/jquery.prettyPhoto.js"></script>
	<script src="/gevents/frontend/web/plugins/placeholdem.min.js"></script>
	<script src="/gevents/frontend/web/plugins/jquery.smoothscroll.min.js"></script>
	<script src="/gevents/frontend/web/plugins/jquery.easing.min.js"></script>
	<script src="/gevents/frontend/web/plugins/smooth-scrollbar.min.js"></script>
	<script src="/gevents/frontend/web/plugins/owlcarousel2/owl.carousel.min.js"></script>
	<script src="/gevents/frontend/web/plugins/waypoints/waypoints.min.js"></script>
	<script src="/gevents/frontend/web/plugins/countdown/jquery.plugin.min.js"></script>
	<script src="/gevents/frontend/web/plugins/countdown/jquery.countdown.min.js"></script>
	<script src="/gevents/frontend/web/plugins/countdown/jquery.countdown-pt-BR.js"></script>
	<script src="/gevents/frontend/web/js/theme-ajax-mail.js"></script>
	<script src="/gevents/frontend/web/js/theme.js"></script>
	<script src="/gevents/frontend/web/js/custom.js"></script>

</head>
<body id="home" class="wide body-light">
	<?php $this->beginBody() ?>

	<!-- Preloader -->
	<div id="preloader">
		<div id="status">
			<div class="spinner"></div>
		</div>
	</div>
	<div class="wrapper">
		<?php echo $this->render('header'); ?>

		<div id="content" class="content-area" >
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>

		<?= $content ?>
		</div>
	</div>

	<div class="text-center" style="left:20%; position:absolute; top:35%; width:60%; z-index:20;">
		<?php 
			if (Yii::$app->session->hasFlash('error')):
			echo Alert::widget([
				'options' => [
					'class' => 'alert-danger',
				],
				'body' => Yii::$app->session->getFlash('error'),
			]);
			endif;

			if (Yii::$app->session->hasFlash('success')):
			echo Alert::widget([
				'options' => [
					'class' => 'alert-success',
				],
				'body' => Yii::$app->session->getFlash('success'),
			]);
			endif; ?>
	</div>

	<div id="messageBox" class="hidden" style="left:20%; position:fixed; top:35%; width:60%; z-index:100;">
		
	</div>
	<!-- FOOTER -->
	<footer class="footer">
		<div class="footer-meta">
			<div class="container text-center">
				<div class="clearfix">
					<ul class="social-line list-inline">
						<li data-animation="flipInY" data-animation-delay="100"><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
						<li data-animation="flipInY" data-animation-delay="300"><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
					</ul>
				</div>
				<span class="copyright" data-animation="fadeInUp" data-animation-delay="100">Copyright: &copy; 2015 Gigante dos Eventos &#8212; Uma forma diferente de se fazer eventos</span>
			</div>
		</div>
		<a id="url_cadastrar_organizador" class="hidden" href="index.php?r=cliente/cadastro"></a>
		<a id="url_grid_cliente" class="hidden" href="index.php?r=cliente/gridCliente"></a>
	</footer>
	<br/>
	<!-- /FOOTER -->

	<div class="to-top"><i class="fa fa-angle-up"></i></div>
	<?php $this->endBody() ?>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			theme.init();
			theme.initMainSlider();
			theme.initCountDown();
			theme.initPartnerSlider();
			theme.initTestimonials();
			//theme.initGoogleMap();
			theme.initEventCarousel();

			$("#faq").on('click', '.faq-more', faqs);
			$("#faq .faqs-more").hide();

			//$('#grid_cliente').on('click', '.inativar', confirmacao);
			$('#content').on('click', '#cadastroform .cadastrar', cadastrarOrganizador);
			$('#content').on('click', ' #cadastro-form .cadastrar', cadastrarOrganizador);
		});
		$(window).load(function () {
			theme.initAnimation();
		});

		$(window).load(function () { $('body').scrollspy({offset: 100, target: '.navigation'}); });
		$(window).load(function () { $('body').scrollspy('refresh'); });
		$(window).resize(function () { $('body').scrollspy('refresh'); });

		$(document).ready(function () { theme.onResize(); });
		$(window).load(function(){ theme.onResize(); });
		$(window).resize(function(){ theme.onResize(); });

		$(window).load(function() {
			if (location.hash != '') {
				var hash = '#' + window.location.hash.substr(1);
				if (hash.length) {
					$('html,body').delay(0).animate({
						scrollTop: $(hash).offset().top - 44 + 'px'
					}, {
						duration: 1200,
						easing: "easeInOutExpo"
					});
				}
			}
			$('[data-toggle="popover"]').popover();
		});
		function faqs(evt){
			evt.preventDefault();
			var faq = $(evt.currentTarget);
			if(faq.attr('faq') == 'hide'){
				$("#faq .faq").hide();
				$("#faq .faqs-more").show();
				faq.text('Voltar');
				faq.attr('faq','show');
			} else {
				$("#faq .faqs-more").hide();
				$("#faq .faq").show();
				faq.html('<i class="fa fa-pencil"></i>&nbsp; Ainda está com dúvidas ?');
				faq.attr('faq','hide');
			}

			return false;
		}

		function message(message, alert_class, timeout){
			$("#messageBox")
				.removeClass()
				.addClass('messageBox')
				.addClass('alert')
				.addClass('text-center')
				.addClass(alert_class)
				.html(message)
				.show();

			setTimeout(
				function(){ 
					$('#messageBox').addClass('hidden').hide(); 
				},(!timeout)?3000:timeout
			);
		}

		function positionLogin(){
			$('.sf-menu a').removeClass('active');
			$('#login').addClass('active');
			$('html, body').animate({
				scrollTop: $('#login').offset().top - 0 + 'px'
			}, {
				duration: 1000,
				easing: 'easeInOutExpo'
			});
		}

		function cadastrarOrganizador(evt) {
			evt.preventDefault;
			var url = $('#url_cadastrar_organizador').attr('href');

			var form = $(evt.currentTarget).closest('form');
			var arrDados = form.serialize();
			var messageErrors = '';

			$.post( url , arrDados,  function( data ) {
				if (data.response) {
					form[0].reset();
					positionLogin();
					message(data.message, 'alert-success');
				} else {
					var objError = data.message ;					
					for (var prop in objError) {
						messageErrors += objError[prop] +' <br>';
					}
					message(messageErrors, 'alert-danger');
				}
				
			});

			return false;
		}

	</script>
</body>
</html>
<?php $this->endPage() ?>
