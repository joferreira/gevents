<?php

/**
 * Classe de ajuda para E-mail.
 * 
 * @package common
 * @subpackage helpers
 * @author Bemerson C. Lins <bemerson.lins@distribuicaodigital.com.br>
 */
namespace yii\helpers;

use Yii;

class EmailHelper {

	/**
	 * Método de envio de e-mails.
	 * 
	 * @param array Parâmetros para envio de e-mail
	 * @throws Exception
	 */
	public static function SendEmail($arrParametros = array()) {
		try {
			if (empty($arrParametros))
				Yii::$app->session->setFlash('error', 'Parâmetros inválidos para envio de e-mail!');

			if ($arrParametros['STR_TIPO_ENVIO'] == 'confirmacao') {
				$strSubject = 'Confirmação de Cadastro - Gigante dos Eventos';

				$strMensagem = 
					"<p>Caro(a) organizador,<p>
					<p>Estamos felizes em recebê-lo(a) no Gigante dos Eventos, a ferramenta de eventos online!</p>
					<p></p>
					<p><strong>E-mail:</strong> <i>".$arrParametros['STR_EMAIL']."</i></p>
					<p><strong>Senha:</strong> <i>".$arrParametros['STR_SENHA']."</i></p>
					<p></p>
					<p>Construa sua base de inscrições, crie e divulgue seus eventos no HotEvent.</p>
					<p></p>
					<p>Gigante dos Eventos | Uma forma diferente de se fazer eventos</p>";

			}

			// Configuração para envio de e-mail Google
			$objEmail = new \PHPMailer();
			$objEmail->isSMTP();
			$objEmail->SMTPDebug = 0;
			$objEmail->CharSet = 'utf-8';
			$objEmail->SMTPAuth = TRUE;
			$objEmail->Port = '587'; //587 - 465
			$objEmail->Mailer = 'smtp';
			$objEmail->SMTPSecure = 'tls';
			$objEmail->Host = 'smtp.gmail.com'; // SMTP GOOGLE E-MAIL
			
			// Usuário e Senha
			$objEmail->Username = 'josemar.ferreira.jf@gmail.com';
			$objEmail->Password = 'jF@81692098';
			
			// Formatação da mensagem e envio
			$objEmail->setFrom('josemar.ferreira.jf@gmail.com', 'Gigante dos Eventos');
			$objEmail->Subject = $strSubject;
			$objEmail->AltBody = 'Para ver a mensagem, por favor, use um visualizador de e-mail compatível com HTML!';
			$objEmail->msgHTML($strMensagem);
			$objEmail->addAddress($arrParametros['STR_EMAIL'], $arrParametros['STR_NOME_COMPLETO']);
			$objEmail->send();
		} catch (Exception $objException) {
			echo 'Exception: ' . $objException->getMessage() . '</br>';
		}
	}

}
