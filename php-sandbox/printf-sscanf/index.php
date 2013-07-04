<?php

/*
printf()
sprintf()
sscanf()
*/
printf("Month - %s, Day - %s, Year - %d",'June','7th',2013);
?>
<br>
<?php
//store string in a variable - sprinf returns a formatted string
$string = sprintf("Month - %s, Day - %s, Year - %d",'June','7th',2013);
echo $string;

?>
<br>
<?php

list($month,$day,$year) = sscanf("Month - June, Day - 7th, Year - 2013","Month - %[^,], Day - %[^,], Year - %d");
echo 'Month - '.$month.', Day - '.$day.', Year - '.$year;
?>