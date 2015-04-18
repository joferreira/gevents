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

			// Email de confirmação
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
			// Email de ativação
			if ($arrParametros['STR_TIPO_ENVIO'] == 'ativacao') {
				$strSubject = 'Confirmação de Ativação - Gigante dos Eventos';

				$strMensagem = 
					"<p>Caro(a) organizador, ".$arrParametros['STR_NOME_COMPLETO']."<p>
					<p></p>
					<p>Sua ativação foi efetivada com sucesso no Gigante dos Eventos.</p>
					<p></p>
					<p>Não perca tempo e crie o seu evento e começe a divulgá-lo em nossa plataforma.</p>
					<p></p>
					<p>Gigante dos Eventos | Uma forma diferente de se fazer eventos</p>";

			}

			// Tratamento de e-mail de contato
			if ($arrParametros['STR_TIPO_ENVIO'] == 'contato') {
				$strSubject = 'Seu contato - Gigante dos Eventos';

				$strMensagem = "<p><h1>Seu contato</h1></p>
					<p></p>
					<p>Olá,</p>
					<p>Estamos felizes pelo seu contato com o Gigante dos Eventos.</p>
					<p></p>
					<p>Caso seja necessário de acordo com a sua mensagem entraremos em contato.</p>
					<p><strong>Mensagem, dúvida ou pergunta:</br></strong> <i>" . $arrParametros['STR_MENSAGEM'] . "</i></p>
					<p></p>
					<p>Nos vemos em http://www.gigantedoseventos.com.br</p>
					<p></p>
					<p>Agradecemos seu contato !</p>
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
