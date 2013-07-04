<?php
/*
Type Hinting:
We can specify what type of parameters are acceptable for a method—and it works on functions too. 
You can type hint any object name, and you can also type hint for arrays. Since PHP is relaxed about its
data types (it is a dynamically and weakly typed language), there’s no type hinting
for simple types such as strings or numeric types.

Using type hinting allows us to be sure about the kind of object passed in to this function, and using it means 
we can make assumptions in our code about the properties and methods that will be available as a result.

*/

public function write( ShopProduct $shopProduct ) {
// ...
}

/*
Even though this automated type checking is a great way of preventing bugs, it is important to
understand that hints are checked at runtime. This means that a class hint will only report an error at the
moment that an unwanted object is passed to the method.*/

function setArray( array $storearray ) {
$this->array = $storearray;
}

/*
Support for array hinting was added to the language with version 5.1. Support for null default values
in hinted arguments was another late addition. This means that you can demand either a particular type
or a null value in an argument. Here’s how:
*/

function setWriter( ObjectWriter $objwriter=null ) {
$this->writer = $objwriter;
}

?>