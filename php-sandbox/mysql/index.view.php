<!doctype html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
if ( $results ) {
	echo "<table><tr><th>Name</th><th>Score</th></tr>";

	foreach($results as $row) {
		echo "<tr><td>".$row->name . "</td><td>".$row->score."</td></tr>";
	}
	echo "</table>";
} else {
	echo 'No rows returned.';
}
?>

</body>
</html>