<?php
echo <<< _END
<h2>Sessions: </h2>
<hr>
<br>
<li>
	<h3>Form submits itself using post method, which generates session array</h3>
</li>
_END;
//populate session array, if form has been submitted
if (isset($_POST['submitMe'])) {
	$_SESSION['name'] = $_POST['name'];
    $_SESSION['submitMe'] = $_POST['submitMe'];
}

if (!empty($_SESSION)) {
	//header( "refresh:5;url=./../test_script.php" );
    echo <<< _END
	<h4>Session superglobal isset.</h4><br>
	<a href="test_script.php">Go to test script</a>
_END;
}
echo <<< _END
<form action="${_SERVER['PHP_SELF']}" method="POST">
     	<label for="name">Enter name: </label>
     	<input type="text" name="name">
     	<input type="submit" value="submit" name="submitMe">
</form>
<br>
_END;
?>
