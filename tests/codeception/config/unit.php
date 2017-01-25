<?php
/**
 * Application configuration for unit tests
 */
$tempContainer = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../../config/web.php'),
    require(__DIR__ . '/config.php')

);
$tempContainer = \yii\helpers\ArrayHelper::merge(
    $tempContainer,
    [
        'bootstrap' => ['log'],
        'components'=>[
            'db'=>[
                'class' => 'yii\db\Connection',
                'dsn' => "mysql:host=localhost;dbname=enrollment_sys_test",
                'username' => "root",
                'password' => "",
                'charset' => 'utf8',
            ],
            'log' => [
                'traceLevel' => 3,
                'targets' => [
                    [
                        'class' => 'yii\log\FileTarget',
                        // 'levels' => ['error', 'warning','trace'],
                        'levels' => ['warning','error'],
                        'logFile'=>'@app/runtime/logs/test_log'
                    ],
                ],
            ],           
        ]

    ]
);

return $tempContainer;