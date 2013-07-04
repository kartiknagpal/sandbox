<?php
$string = 0;

if ($string == false) {
	echo "== statement is true.<br>";
	/*else*/ if ($string === false) {
	echo "=== statement is also true.";
  }
}
else  {
	echo 'None of the statement is true';
}
?>
<br>
<!--  Lookup associative array-->
<?php
$months = array('jan' => 'It is jan.' ,
				'feb' => 'It is feb.' ,
				'mar' => 'Ti is march.');
$month = 'feb';
echo isset($months[$month])?$months[$month]:'This is not the right month.';
$method = $_SERVER['REQUEST_METHOD'];
echo $method;
?>
