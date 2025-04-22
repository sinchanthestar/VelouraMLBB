<?php

date_default_timezone_set('Asia/Jakarta');
ini_set('memory_limit', '128M');

$config['db'] = array(
	'host' => 'localhost', //Server
	'name' => 'veloura', //Username
	'username' => 'admin', //Username DB
	'password' => 'admin' //Password DB
);

require 'lib/db.php';
require 'lib/model.php';
require 'lib/function.php';


session_start();
$model = new Model();

$config['web'] = array(
	'maintenance' =>  $model->db_query($db,"maintenance", "pgen", "id ='1'")['rows']['maintenance'],
	'FreeToken' => $model->db_query($db,"keygen", "pgen", "id ='1'")['rows']['keygen'],
	'title' => 'Veloura MLBB',
	'meta' => array(
		'description' => 'The Best Software Provider',
		'keywords' => 'Software',
		'author' => 'Veloura MLBB'
	),
	'base_url' => 'http://localhost:8000'
);
