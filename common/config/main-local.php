<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=fjgames.com.br.md-28.webhostbox.net;dbname=fjgamtjo_gevents',
            'username' => 'fjgamtjo_gevents0',
            'password' => 'R[+!{]pTc#me',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
// .3V{lLoXaGwZ R[+!{]pTc#me .3.S52Pqdb fjgamtjo_gevents 20
/*
            'dsn' => 'mysql:host=104.131.186.117;dbname=database',
            'username' => 'clins',
            'password' => 'clinsbcl824010',
*/