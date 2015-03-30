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
				$strSubject = 'Confirmação de inscrição - Distribuição Digital';

				$strMensagem = '<h1>Confirmação de inscrição</h1></br>'
						. 'Olá,</br></br>'
						. 'Estamos felizes em recebê-lo(a) no Distribuição Digital, o serviço de distribuição de música com uma diferença muito grande!</br></br>'
						. 'Construa a sua base de fãs, faça render dinheiro, libere a sua música no iTunes, Spotify e outras grandes lojas digitais.</br></br>'
						. 'Você mantém todos os direitos em receber por suas vendas efetuadas nas lojas digitais.</br></br>'
						. 'Você também irá obter o feedback de suas músicas e vendas através de nosso serviço DASHBOARD, que oferece relatórios de acompanhamentos.</br></br>'
						. 'É muito fácil começar:</br>'
						. '1 - Você já deu o primeiro passo em se inscrever</br>'
						. '<strong>E-mail:</strong> <i>' . $arrParametros['STR_EMAIL'] . '</i></br>'
						. '<strong>Senha:</strong> <i>' . $arrParametros['STR_SENHA'] . '</i></br>'
						. '2 - Complete o seu perfil</br>'
						. '3 - Envie seu single, EP ou Álbum</br>'
						. '4 - Conheça nosso DASHBOARD</br></br>'
						. 'Também certifique-se que você siga-nos no Twitter (https://twitter.com/distribuicaodig) e Facebook (https://pt-br.facebook.com/distribuicaodigital).</br></br>'
						. 'Se você tiver alguma dúvida, consulte o nosso FAQ (http://www.distribuicaodigital.com.br/faq) ou contacte-nos em http://www.distribuicaodigital.com.br/contato</br></br>'
						. 'Nos vemos em http://www.distribuicaodigital.com.br</br></br>'
						. 'Boa sorte !</br></br>'
						. 'Distribuição Digital | Sua música na internet';
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
			$objEmail->Username = 'digital@distribuicaodigital.com.br';
			$objEmail->Password = 'mu2si4ca6';
			
			// Formatação da mensagem e envio
			$objEmail->setFrom('digital@distribuicaodigital.com.br', 'Distribuição Digital | Sua música na internet');
			$objEmail->Subject = $strSubject;
			$objEmail->AltBody = 'Para ver a mensagem, por favor, use um visualizador de e-mail compatível com HTML!';
			$objEmail->msgHTML($strMensagem);
			$objEmail->addAddress($arrParametros['STR_EMAIL'], $arrParametros['STR_NOME'] . ' ' . $arrParametros['STR_NOME_COMPLEMENTO']);
			$objEmail->send();
		} catch (Exception $objException) {
			echo 'Exception: ' . $objException->getMessage() . '</br>';
		}
	}

}
