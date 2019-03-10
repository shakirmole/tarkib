<?php

	$config = array(
		'server' => 'localhost',
		'username' => 'root',
		'password' => 'root',
		'database' => 'tarkib',
	);
	
	ORM::configure('mysql:host='.$config['server'].';dbname='.$config['database']);
	ORM::configure('username', $config['username']);
	ORM::configure('password', $config['password']);
	ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	
	define('REPORT_PATH', 'files/');
?>