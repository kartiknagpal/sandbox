<?php
$arr = array('ceo'       => 'johnny' ,
			 'manager'   => 'cash'   ,
			 'instructor'=>	'pawn' );

foreach ($arr as $title => $name) {
	echo '<li><strong>'.$title.'</strong>-'.$name.'</li>';
}
?>
<!-- Using for loop  -->
<?php
$arr = array('johnny','judy','jdjewish');
for ($i=0; $i < count($arr) ; $i++) { 
	echo '<li>'.$arr[$i].'</li>';
}
echo'<hr>';
$i=0;
while ($i < count($arr)) {
	echo '<li>'.$arr[$i++].'</li>';
}


?>