<?php session_start(); require 'inc/functions.php'; ?>
	<!doctype html>
	<html>
		<head>
			<title>
				Test Script
			</title>
			<style type="text/css">
				
a {
	margin-left: 25px;
	text-decoration: none;
	color: #BADA55;
}

			</style>
		</head>
		<body>
			<?php $method=$_SERVER[ 'REQUEST_METHOD']; if (isset($_GET[ 'destroy'])) { session_destroy(); $_SESSION=array(); } ?>
				<header>
					<?php display_header_info($method); ?>
				</header>
				<p>
					<?php print_r(get_superglobals($method)); ?>
				</p>
		</body>
	
	</html>