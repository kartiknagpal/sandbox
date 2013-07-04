<?php
//clean and secure form input data
// if (isset($_REQUEST['submit'])) {
// 	foreach ($_REQUEST as $key => $value) {
// 		if (!empty($value)) {
// 			foreach ($variable as $key => $value) {
// 				# code...
// 			}
// 		}
// 	}
// }
// $required[] = {};
// $missing[] = {};
//to check if submit button has been clicked
if (isset($_REQUEST['submit'])) {	
	//traverse each element of $_POST superglobal associative array
	foreach ($_REQUEST as $key => $value) {	
		//if associated value of each key is not empty
		if (!empty($value)) {	
			//if value is itself an array
			if(is_array($value))	
				//traverse through the inner $value array
				foreach ($value as $key => $val) {	
					//print out the inner $value array
					echo $val."<br/>";	
				}	//end of inner array traversal
				//otherwise printout the normal value
			else
				echo $key." => ".$value."<br/>";	
		}
	}	//end of $_POST traversal

	// 	/echo print_r($key => $value);

	// }
	//$yo = is_array($_POST['Extras']);
	//echo $yo;
	//echo print_r($_POST);
	// if (isset($_POST['Extras']) && !(empty($_POST['Extras'])) ) {
	// 	foreach ($_POST['Extras'] as $key => $value) {
	// 		echo $value. "<br/>";
	// 	}
	// }
  }


?>