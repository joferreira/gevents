<!-- CONTATO -->

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

$this->title = 'Contato';
?>

<div id="page-wrapper">
	<div class="row">
		<div>
			<h1 class="page-header"><i class="fa fa-envelope fa-fw"></i> Contato</h1>
		</div>
	</div>
	<div class="row">
			
		<!-- FORMULÁRIO -->
		<div class="form">
			
		<?php $objFormContato = ActiveForm::begin(['id' => 'contato-form', 'method' => 'POST', 'action' => ['contato/formulario']]); ?>
			
			<div class="one-one">
				<blockquote>
					<h4>Entre em contato agora mesmo conosco. Escreva sua mensagem, dúvida ou pergunta.</h4>
				</blockquote>
			</div>
			
			<?php 
			$arrFlashMessages = Yii::$app->session->getAllFlashes();

			if ($arrFlashMessages) {
				echo '<div>';
				foreach($arrFlashMessages as $strKeyFlash => $strMessagem) {

					if( $strKeyFlash == 'info' )
						echo '<div class="button-normal alert skin-background-color16 skin-font-color3 skin-background-hover3">'.$strMessagem.'</div>';
						//echo TbHtml::blockAlert(TbHtml::ALERT_COLOR_INFO, $strMessagem, array('style' => 'width:800px;font-size:25px;'));

					if( $strKeyFlash == 'success' )
						echo '<div class="button-normal alert skin-background-color17 skin-font-color3 skin-background-hover3">'.$strMessagem.'</div>';
						//echo TbHtml::blockAlert(TbHtml::ALERT_COLOR_SUCCESS, $strMessagem, array('style' => 'width:800px;font-size:25px;'));

					if( $strKeyFlash == 'warning' )
						echo '<div class="button-normal alert skin-background-color16 skin-font-color3 skin-background-hover3">'.$strMessagem.'</div>';
						//echo TbHtml::blockAlert(TbHtml::ALERT_COLOR_WARNING, $strMessagem, array('style' => 'width:800px;font-size:25px;'));

					if( $strKeyFlash == 'error' )
						echo '<div class="button-normal alert skin-background-color24 skin-font-color3 skin-background-hover3">'.$strMessagem.'</div>';
						//echo TbHtml::blockAlert(TbHtml::ALERT_COLOR_ERROR, $strMessagem, array('style' => 'width:800px;font-size:25px;'));

					if( $strKeyFlash == 'danger' )
						echo '<div class="button-normal alert skin-background-color24 skin-font-color3 skin-background-hover3">'.$strMessagem.'</div>';
						//echo TbHtml::blockAlert(TbHtml::ALERT_COLOR_DANGER, $strMessagem, array('style' => 'width:800px;font-size:25px;'));
				}
				echo '</div>';
			}
			?>
			
			<div class="col-md-10 col-md-offset-2">
				<?php echo $objFormContato->field($objModelContato, 'STR_MENSAGEM')->label(FALSE)->textarea(['placeholder' => 'Escreva sua mensagem, dúvida ou pergunta', 'enableError' => TRUE, 'style' => 'height:200px;width:700px;font-size:25px;'])?>
			</div>
			
			<!-- SUBMIT E HIDDEN -->
			<div class="row">
				<div class="text-center">
					<?php echo $objFormContato->field($objModelContato, 'CLIENTE_INT_ID_CLIENTE')->label(FALSE)->hiddenInput(['name' => 'Contato[CLIENTE_INT_ID_CLIENTE]', 'value' => Yii::$app->session->get('INT_ID_CLIENTE')])?>
					<?php echo Html::submitInput('Enviar contato', ['class' => 'contato btn btn-primary']); ?>
				</div>
			</div>
			<!-- /SUBMIT E HIDDEN -->
			
			<div class="clearfix">&nbsp;</div>
			
			<div class="row">
				<ul>
					<li><span class="bold">E-mail:</span> gigante@gigantedoseventos.com.br</li>
					<li><span class="bold">Telefone:</span></li>
				</ul>
			</div>
			
		<?php ActiveForm::end();  ?>

		</div>
		<!-- /FORMULÁRIO -->

	</div>
</div>

<!-- /CONTATO -->