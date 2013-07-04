<?php

function connect($host = 'localhost', $username, $password, $db = null) {
	try {
		$conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
	return $conn;
}

function query($query, $conn) {
	$stmt = $conn->prepare($query);
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$stmt->execute();
	return $stmt->fetchAll();

}
