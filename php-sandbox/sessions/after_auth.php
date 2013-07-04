<?php // continue.php
/*
* Sessions neatly confine to a single program the extensive code required to authenticate
* and log in a user. Once a user has been authenticated and you have created a session,
* your program code becomes very simple indeed. You need only call up session_start and 
* look up any variables to which you need access from $_SESSION.
*/

session_start();

if (isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$forename = $_SESSION['forename'];
	$surname  = $_SESSION['surname'];

	echo "Welcome back $forename.<br />
		  Your full name is $forename $surname.<br />
		  Your username is '$username'
		  and your password is '$password'.";
}
else echo "Please <a href=user_auth.php>click here</a> to log in.";
?>