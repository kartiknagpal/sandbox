<?php 
require 'pdo_functions.php';
require 'config.php';

$conn = connect($config['DB_HOST'],
				$config['DB_USERNAME'],
				$config['DB_PASSWORD'],
				'kartik');
if ($conn) {
	$results = query('SELECT * FROM guitarwars', $conn);
}
else {
	die("Problem in connecting to the database");
}

require 'index.view.php';
