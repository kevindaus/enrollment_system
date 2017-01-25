<?php
$databaseConfiguration = [
	    'class' => 'yii\db\Connection',
	    'dsn' => "mysql:host=localhost;dbname=enrollment",
	    'username' => "root",
	    'password' => "",
	    'charset' => 'utf8',
];

if (YII_DEBUG && YII_ENV === 'dev') {
	$databaseConfiguration = [
	    'class' => 'yii\db\Connection',
	    'dsn' => "mysql:host=localhost;dbname=enrollment",
	    'username' => "root",
	    'password' => "",
	    'charset' => 'utf8',	
	];
}
return $databaseConfiguration;