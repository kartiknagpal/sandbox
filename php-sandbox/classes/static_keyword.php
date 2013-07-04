<?php
/*Static Keyword:

Declaring class properties or methods as static makes them accessible without needing an instantiation of the class. 
A property declared as static can not be accessed with an instantiated class object (though a static method can). 

For compatibility with PHP 4, if no visibility declaration is used, then the property or method will be treated as 
if it was declared as public. 

Because static methods are callable without an instance of the object created, the pseudo-variable $this is not 
available inside the method declared as static. 

Static properties cannot be accessed through the object using the arrow operator ->. 

Calling non-static methods statically generates an E_STRICT level warning. 

Like any other PHP static variable, static properties may only be initialized using a literal or constant; 
expressions are not allowed. So while you may initialize a static property to an integer or array (for instance), 
you may not initialize it to another variable, to a function return value, or to an object. 

As of PHP 5.3.0, it's possible to reference the class using a variable. The variable's value can not be a keyword 
(e.g. self, parent and static). 
*/

//Example #1 Static property example

class Foo
{
    public static $my_static = 'foo';

    public function staticValue() {
        return self::$my_static;
    }
}

class Bar extends Foo
{
    public function fooStatic() {
        return parent::$my_static;
    }
}


print Foo::$my_static . "\n";

$foo = new Foo();
print $foo->staticValue() . "\n";
print $foo->my_static . "\n";      // Undefined "Property" my_static 

print $foo::$my_static . "\n";
$classname = 'Foo';
print $classname::$my_static . "\n"; // As of PHP 5.3.0

print Bar::$my_static . "\n";
$bar = new Bar();
print $bar->fooStatic() . "\n";
?>  


Example #2 Static method example


<?php
class Foo {
    public static function aStaticMethod() {
        // ...
    }
}

Foo::aStaticMethod();
$classname = 'Foo';
$classname::aStaticMethod(); // As of PHP 5.3.0

?> 