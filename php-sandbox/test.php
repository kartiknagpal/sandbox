<?php
namespace shipping;

class Courier {
	private $name;
	private $home_country;
	public static $persons = 0;

	public function __construct($name,$home_country) {
		$this->name = $name;
		$this->home_country = $home_country;
		$persons++;
	}

	public static function get_persons() {
		return $persons;
	}

	public function send_courier() {
		//send courier
	}

	public function __toString() {
		return "Name: ".$name." Country: ".$home_country;
	}
}

$courier1 = new Courier('Kartik','India');
$courier1->send_courier();
var_dump(Courier::get_persons());

class MonotypeDelivery extends Courier{
	
}

?>