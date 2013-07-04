<?php

/*Developers with a C background may expect pass by reference semantics for arrays. 
It may be surprising that  pass by value is used for arrays just like scalars.*/

$months = array('jan','feb','mar','april','may');
$months = ["jan","feb","mar","april","may"]; //new syntax, for php>=5.4

//1 method to print out array/objects with most info
var_dump($months);	
//2 method with index -> item
print_r($less_months);	
?>
<ul>
<?php
foreach ($months as $month):
if (strlen($month)==3)
  echo '<li>'.ucwords($month).'</li>';?>

<?php endforeach; ?>
</ul>

---------/\/\ manipulating arrays /\/\-----------
<?php
array_push($months, "june");	//insert at last index
echo array_pop($months)."<br>";		//remove from last index
array_shift($months);			//remove from first index
array_unshift($months, "jan");	//insert at first index
$less_months = array_slice($months, 1,3);	//slice out a copy of selected months
print_r($less_months);
echo "<br>";

//Filters elements of an array using a anonymous callback function
$filtered = array_filter($months,function($month){
	return (strlen($month)==3);
});
print_r($filtered);
?>

<!-- Associative array -->
<?php
$months_assoc = array(
	'jan' => 'winter', 
	'feb' => 'autumn',
	'march' => 'init summer'
	);
	
foreach ($months_assoc as $key => $value) {
	echo "<li>".ucfirst($key)." is $value month.</li>";
}
?>