<h2>
	POST method:
</h2>
<hr>
<br>
<li>
	<h3>
		Form submitted using post method.
	</h3>
</li>
<!--<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">-->
<form action="test_script.php" method="post">
	<label for="name">
		Enter name:
	</label>
	<input type="text" name="name">
	<input type="submit" value="submit" name="submitMe">
</form>