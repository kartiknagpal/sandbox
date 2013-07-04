<?php
session_start();
if(empty($_SESSION['first_view']))
	echo "Welcome new visitor";
	$_SESSION['first_view'] = false;

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Order Form</title>
	<?php require_once '.\process_form1.php';?>
</head>
<body>

	<?php 
	echo session_id();
	//Show form only if submit is not clicked
	if (!isset($_REQUEST['submit'])) { ?>
	<header><h2>This is an order form.</h2></header>
	<section>
		<form action="" method="post">
			<label>Choose your beans: </label>
			<select name="beans">
				<option value="Blend">House Blend</option>
				<option value="Supremo">Shade Grown Bolivia Supremo</option>
				<option value="Kenya">Kenya</option>
			</select><br/>
			<label>Type: </label><br/>
			<input type="radio" name="type" value="Whole bean" />Whole bean<br/>
			<input type="radio" name="type" value="Ground" />Ground<br/>
			<label>Extras:</label><br/>
			<input type="checkbox" value="Gift Wrap" name="Extras[]"/>Gift Wrap<br/>
			<input type="checkbox" value="Include Catalog with order" name="Extras[]"/>
			Include Catalog with order<br/><hr/>
			<label>Ship to:</label><br/>
			<label for="name">Name: </label>
			<input type="text" name="name"/><br/>
			<label for="address">Address: </label>
			<input type="text" name="address"/><br/>
			<label for="city">City: </label>
			<input type="text" name="city"/><br/>
			<label for="state">State: </label>
			<input type="text" name="state"/><br/>
			<label for="zip">Zip: </label>
			<input type="text" name="zip"/><br/><br/>

			<label for="comments">Customer Comments: </label><br/><br/>
			<textarea name="comments" rows="10" cols="50"></textarea><br/>

			<input type="submit" name="submit" value="Order now" />



		</form>

	</section>
	<?php } ?>
</body>
</html>