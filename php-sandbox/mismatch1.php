<?php


?>
<!doctype html>
<html>
<head>
<title>Mismatch - Find your mismatched partner</title>
</head>
<body>
	<h3>Mismatch - Where opposites attract!</h3>
	<ul>
		<?php
		//if(logged in cookie not set){ ?>
		<script>
$(document).ready(function() {
  $('#open').click(function() {
	 $('#login form').slideToggle(300);
	 $(this).toggleClass('close'); 
  }); // end click
}); // end ready
</script>

<div id="login">
 <p id="open">Login</p>
 <form method="post" action="">
	<p>
		<label for="username">Username:</label>
		<input type="text" name="username" id="username">
	</p>
	<p>
		<label for="password">Password: </label>
		<input type="text" name="password" id="password">
	</p>
	<p>
		<input type="submit" name="button" id="button" value="Submit" >
	</p>
 </form>
</div>
			
		<?php
		}
		//if(logged in cookie set){
		?>
		<li><a href="view_profile.php">View Profile</a></li>
		<li><a href="edit_profile.php">Edit Profile</a></li>
		<li><a href="logout.php">Logout<?php//display username?></a></li>
		<?php } ?>
	</ul>
<div>
	<h4>Latest Members</h4>
	<?php
	//if(logged in cookie not set)
		//write sql php to display latest records(only usernames) inserted in the db.
	//else
		//write sql php to display latest records(only usernames) inserted in the db as hyperlinks.
		//these hyperlinks display the entire user profile.

	?>

</div>
<?php //if(logged in cookie not set) {?>
<div>
	<h4>SignUp</h4>


</div>
<?php } ?>
</body>

</html>