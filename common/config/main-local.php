<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=gevents',
            'username' => 'root',
            'password' => '',
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
// .3V{lLoXaGwZ R[+!{]pTc#me .3.S52Pqdb fjgamtjo_gevents 208.91.199.77
/*
            'dsn' => 'mysql:host=104.131.186.117;dbname=database',
            'username' => 'clins',
            'password' => 'clinsbcl824010',
*/