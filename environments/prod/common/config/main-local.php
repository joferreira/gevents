<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=208.91.199.77;dbname=fjgamtjo_gevents',
            'username' => 'fjgamtjo_gevents',
            'password' => 'R[+!{]pTc#me',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
