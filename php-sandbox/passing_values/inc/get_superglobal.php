<?php
echo <<< _END
<h2>GET Method: </h2><hr><br>
<li>
	<h3>Value is passed using url encoding which populates get array</h3>
</li>
    
_END;

//max scope of a variable in a single php script is throughout that entire script
$var = 1; //var is available to the entire script

/*to increase scope of variables upto multiple scripts, use one of the predefined
superglobal array, eg. - $_GET[]*/

$_GET['var'] = 1;
$var = $_GET['var'];
print_r($_GET);

echo <<< _END
<a href='test_script.php?var=$var'>Go to test script</a>


<li>
	<h3>Form is posted using get method</h3>
</li>
<form name="log" action="test_script.php" method="get">
	<label for="name">Enter name: </label>
	<input type="text" name="name" id="name">
	<input type="submit" name="submit" value="Go to test script">
</form>
<br>
_END;
?>