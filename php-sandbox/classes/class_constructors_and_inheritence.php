<?php

/*Constructors and Inheritance:
When you define a constructor in a child class, you become responsible for passing any arguments on to
the parent. If you fail to do this, you can end up with a partially constructed object.
To invoke a method in a parent class, you must first find a way of referring to the class itself: a
handle. PHP provides us with the parent keyword for this purpose.
To refer to a method(constructor or not) in the context of a class rather than an object you use :: rather than ->. So
parent::__construct()
means “Invoke the __construct() method of the parent class.”*/

class ShopProduct {

public $title;
public $producerMainName;
public $producerFirstName;
public $price;

function __construct( $title, $firstName,
$mainName, $price ) {
  $this->title = $title;
  $this->producerFirstName = $firstName;
  $this->producerMainName = $mainName;
  $this->price = $price;
}

function getProducer() {
  return "{$this->producerFirstName}".
  " {$this->producerMainName}";
}

function getSummaryLine() {
  $base = "{$this->title} ( {$this->producerMainName}, ";
  $base .= "{$this->producerFirstName} )";
  return $base;
  }
}
class CdProduct extends ShopProduct {

public $playLength;

function __construct( $title, $firstName,
  $mainName, $price, $playLength ) {
  parent::__construct( $title, $firstName,
  $mainName, $price );
  $this->playLength = $playLength;
  }

function getPlayLength() {
  return $this->playLength;
  }

function getSummaryLine() {
  $base = "{$this->title} ( {$this->producerMainName}, ";
  $base .= "{$this->producerFirstName} )";
  $base .= ": playing time - {$this->playLength}";
  return $base;
  }
}
class BookProduct extends ShopProduct {

public $numPages;

function __construct( $title, $firstName,
$mainName, $price, $numPages ) {
  parent::__construct( $title, $firstName,
  $mainName, $price );
  $this->numPages = $numPages;
  }

function getNumberOfPages() {
  return $this->numPages;
  }
function getSummaryLine() {
  $base = "$this->title ( $this->producerMainName, ";
  $base .= "$this->producerFirstName )";
  $base .= ": page count - $this->numPages";
  return $base;
  }
}

/*Each child class invokes the constructor of its parent before setting its own properties. The base
class now knows only about its own data. Child classes are generally specializations of their parents. As a
rule of thumb, you should avoid giving parent classes any special knowledge about their children.

call a constructor two levels up the class hierarchy, ignoring the immediate parent.  
In such a case, you need to explicitly reference the class name using the :: operator.


<---------------------------  Calling Parent class Functions using :: ---------------------------->

 Fortunately, just like using the 'parent' keyword PHP correctly recognizes that you are calling the function 
 from a protected context inside the object's class hierarchy.

 E.g:*/


class foo
{
   public function something()
   {
     echo __CLASS__; // foo
     var_dump($this);
   }
 }

 class foo_bar extends foo
{
   public function something()
   {
     echo __CLASS__; // foo_bar
     var_dump($this);
   }
 }

 class foo_bar_baz extends foo_bar
{
   public function something()
   {
     echo __CLASS__; // foo_bar_baz
     var_dump($this);
   }

   public function call()
   {
     echo self::something(); // self
     echo parent::something(); // parent
     echo foo::something(); // grandparent
   }
 }

error_reporting(-1);

$obj = new foo_bar_baz();
$obj->call();

// Output similar to:
 // foo_bar_baz
 // object(foo_bar_baz)[1]
 // foo_bar
 // object(foo_bar_baz)[1]
 // foo
 // object(foo_bar_baz)[1]


?> 