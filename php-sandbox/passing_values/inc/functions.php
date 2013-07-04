<?php 
//displays header
function display_header_info($method) {
	if ($method === 'GET') {
		get_method();
	}
	elseif ($method === 'POST') {
		post_method();
	}
	echo "<a href='superglobal.php'>Go back</a>";
    echo"<hr>";
}

//returns assoc array of appropiate superglobal
function get_superglobals($method) {
	//check for get
	if ($method === 'GET') {
		if (!empty($_SESSION) && empty($_GET)) {
			filter_global_array($GLOBALS['_SESSION']);
			return ($GLOBALS['_SESSION']);
		}
		else {
		filter_global_array($GLOBALS['_GET']);
		return ($GLOBALS['_GET']);
		}
	}
	//check for post
	if ($method === 'POST') {
		filter_global_array($GLOBALS['_POST']);
		return ($GLOBALS['_POST']);
	}
}

function get_method() {
	//if session superglobal set
	if (!empty($_SESSION) && empty($_GET)) {
	 echo <<< _END
     Instead of url encoding sessions are used, session data is stored on server
	
	<form action="${_SERVER['PHP_SELF']}" method="get" >
		<input type="submit" name="destroy" value="destroy session">
	</form>
_END;
	 }
	//no session variables are set
	else {
		echo "Url of the page refelects get array.";		
      } 
}

function post_method() {
	echo "post array values are hidden from the url";   
}

//pass by reference
function filter_global_array(&$assoc_array) {
	foreach ($assoc_array as $key => $value) {
		$assoc_array[$key] = htmlspecialchars($assoc_array[$key]);
	}
}
?>