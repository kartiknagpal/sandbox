<?php

/* USING THE OLD mysql API IS AN ANTI-PATTERN! ONLY FOR REFERENCE */

function connect($host = 'localhost', $username, $password, $db = null)
{
	$conn = mysql_connect($host, $username, $password);

	if ( !$conn ) {
		echo "mysql server connect fail.<br>";
		return null;
	}
	if ( $db && mysql_select_db($db, $conn)) {
		return $conn;
	}
	else echo "db not connected<br>";
	return null;
}

function query($query, $conn)
{
	$results = mysql_query($query, $conn);

	if ( $results ) {
		$rows = array();
		while($row = mysql_fetch_object($results)) {
			$rows[] = $row;
		}
		return $rows;
	}

	return false;
}

