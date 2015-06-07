<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Alert;
use yii\web\Session;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>

	<?php $this->head(); ?>
	<!-- Favicons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/gevents/frontend/web/hotevent/ico/apple-touch-icon-144-precomposed.png">
	<link rel="shortcut icon" href="/gevents/frontend/web/hotevent/ico/favicon.ico">

	<link rel="stylesheet" href="/gevents/frontend/web/plugins/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/gevents/frontend/web/plugins/bootstrap-select/bootstrap-select.min.css">
	<link rel="stylesheet" href="/gevents/frontend/web/plugins/prettyphoto/css/prettyPhoto.css">
	<link rel="stylesheet" href="/gevents/frontend/web/plugins/animate/animate.min.css">

	<script src="/gevents/frontend/web/plugins/modernizr.custom.js"></script>
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

	<link href="/gevents/frontend/web/hotevent/owlcarousel2/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="/gevents/frontend/web/hotevent/owlcarousel2/assets/owl.theme.default.min.css" rel="stylesheet">

	<link href="/gevents/frontend/web/hotevent/countdown/jquery.countdown.css" rel="stylesheet">
	<link href="/gevents/frontend/web/hotevent/css/theme.css" rel="stylesheet">
	<link href="/gevents/frontend/web/hotevent/css/theme-red-1.css" rel="stylesheet" id="theme-config-link">
	<link href="/gevents/frontend/web/hotevent/css/custom.css" rel="stylesheet">

	<!-- JS Page Level -->
	<script src="/gevents/frontend/web/hotevent/isotope/jquery.isotope.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>

	<script src="/gevents/frontend/web/hotevent/js/theme.js"></script>
	<script src="/gevents/frontend/web/hotevent/js/custom.js"></script>

</head>
<body id="home" class="wide body-light multipage">

	<!-- Preloader -->
	<div id="preloader">
		<div id="status">
			<div class="spinner"></div>
		</div>
	</div>

	<?php $this->beginBody() ?>
	<div class="wrap">
		<!-- Wrap all content -->
		<div id="wrapper" class="wrapper">

		<?= Breadcrumbs::widget([ 'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]) ?>
		<?php
			echo $content;
		?>
		</div>
		<!-- /Wrap all content -->
	</div>
	<div class="text-center" style="left:20%; position:absolute; top:45%; width:60%; z-index:9999;">
		<?php if (Yii::$app->session->hasFlash('success')):
			echo Alert::widget([
				'options' => [
					'class' => 'alert-success',
				],
				'body' => Yii::$app->session->getFlash('success'),
			]);

		elseif (Yii::$app->session->hasFlash('error')):
			echo Alert::widget([
				'options' => [
					'class' => 'alert-danger',
				],
				'body' => Yii::$app->session->getFlash('error'),
			]);
		 ?>
		<?php endif; ?>
	</div>

	<div id="confirmBox" class="text-center alert alert-info hidden" style="left:20%; position:absolute; top:45%; width:60%; z-index:9999;">
		<div id="message-confirmBox" style="font-size:16px; font-weight:bold" >Teste de mensagem ?</div>
		<div id="button-confirmBox">
			<a id="button-yes" action="yes" href="javascript:;" class="confirmBox btn btn-sm btn-success">Sim</a>&nbsp;
			<a id="button-no" action="no" href="javascript:;" class="confirmBox btn btn-sm btn-danger">Não</a>
		</div>
	</div>

	<div id="messageBox" class="hidden" style="left:20%; position:absolute; top:45%; width:60%; z-index:10000;">
		
	</div>

	<footer class="footer">
		<div class="container">
		<p class="pull-left">&copy; Gigante dos Eventos <?= date('Y') ?></p>
		<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
		<a id="url_save_cliente" class="hidden" href="index.php?r=dashboard/cadastro/save"></a>
	</footer>
	
	<div class="to-top"><i class="fa fa-angle-up"></i></div>

	<?php $this->endBody(); ?>

	<script type="text/javascript">
	/*
		$.extend( $.fn.dataTable.defaults, {
			responsive: true,
			"lengthChange": false,
			"searching": false,
			"ordering": false,
			"language": {
				"sEmptyTable": "Nenhum registro encontrado",
				"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
				"sInfoFiltered": "(Filtrados de _MAX_ registros)",
				"sInfoPostFix": "",
				"sInfoThousands": ".",
				"sLengthMenu": "_MENU_ resultados por página",
				"sLoadingRecords": "Carregando...",
				"sProcessing": "Processando...",
				"sZeroRecords": "Nenhum registro encontrado",
				"sSearch": "Procurar: ",
				"oPaginate": {
					"sNext": "Próximo",
					"sPrevious": "Anterior",
					"sFirst": "Primeiro",
					"sLast": "Último"
				},
				"oAria": {
					"sSortAscending": ": Ordenar colunas de forma ascendente",
					"sSortDescending": ": Ordenar colunas de forma descendente"
				}
			}
		} );
		tinymce.init({
			language : 'pt_BR',
			selector: "textarea#textForm",
			theme: "modern",
			menubar: false,
			height: 250,
			plugins: [
				"advlist autolink lists link image charmap print preview hr pagebreak",
				"searchreplace wordcount visualblocks visualchars code fullscreen",
				"insertdatetime nonbreaking save table contextmenu directionality",
				"paste textcolor colorpicker textpattern"
			],
			toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview | copy paste | forecolor backcolor | fullscreen code",
			image_advtab: true
		});
		*/
			jQuery(document).ready(function () {
				//$('#wrapper').on('click', '#cliente-form .alterar', saveCliente);
				theme.init();
				theme.initMainSlider();
				theme.initCountDown();
				theme.initPartnerSlider2();
				theme.initImageCarousel();
				theme.initTestimonials();
				theme.initGoogleMap();
			});
			jQuery(window).load(function () {
				theme.initAnimation();
			});

			jQuery(window).load(function () { jQuery('body').scrollspy({offset: 100, target: '.navigation'}); });
			jQuery(window).load(function () { jQuery('body').scrollspy('refresh'); });
			jQuery(window).resize(function () { jQuery('body').scrollspy('refresh'); });

			jQuery(document).ready(function () { theme.onResize(); });
			jQuery(window).load(function(){ theme.onResize(); });
			jQuery(window).resize(function(){ theme.onResize(); });

			jQuery(window).load(function() {
				if (location.hash != '') {
					var hash = '#' + window.location.hash.substr(1);
					if (hash.length) {
						jQuery('html,body').delay(0).animate({
							scrollTop: jQuery(hash).offset().top - 44 + 'px'
						}, {
							duration: 1200,
							easing: "easeInOutExpo"
						});
					}
				}
			});

/*
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

		function saveCliente(evt) {
			evt.preventDefault;
			var url = $('#url_save_cliente').attr('href');

			if( validar_dados() ){

				var form = $(evt.currentTarget).closest('form');
				var arrDados = form.serialize();
				var messageErrors = '';
				var endereco = 'field-endereco';
				var cliente = 'field-cliente';

				$.post( url , arrDados,  function( data ) {
					if (data.response) {
						//form[0].reset();
						message(data.message, 'alert-success');
						location.reload(true);
					} else {
						var objError = data.message ;
						for (var prop in objError) {
							var idProp = prop;
							$('.'+cliente+'-'+idProp.toLowerCase()).addClass('has-error');
							$('.'+endereco+'-'+idProp.toLowerCase()).addClass('has-error');
							messageErrors += objError[prop] +' <br>';
						}
						//'Verifique os campos em Vermelho'
						message(messageErrors, 'alert-danger');
					}
					
				});
			}

			return false;
		}
*/
	</script>
</body>
</html>
<?php $this->endPage() ?>
