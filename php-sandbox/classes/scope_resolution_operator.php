<?php
/*Scope Resolution Operator (::)

The Scope Resolution Operator (also called Paamayim Nekudotayim) or in simpler terms, the double colon, is a 
token that allows access to static, constant, and overridden properties or methods of a class. 

When referencing these items from outside the class definition, use the name of the class. 

As of PHP 5.3.0, it's possible to reference the class using a variable. The variable's value can not 
be a keyword (e.g. self, parent and static). 

Paamayim Nekudotayim would, at first, seem like a strange choice for naming a double-colon. However, while 
writing the Zend Engine 0.5 (which powers PHP 3), that's what the Zend team decided to call it. 
It actually does mean double-colon - in Hebrew! 


Example #1 :: from outside the class definition
*/
class MyClass {
    const CONST_VALUE = 'A constant value';
}

$classname = 'MyClass';
echo $classname::CONST_VALUE; // As of PHP 5.3.0

echo MyClass::CONST_VALUE;
 
/*
Three special keywords self, parent and static are used to access properties or methods from inside the class 
definition. 
*/

//Example #2 :: from inside the class definition

class OtherClass extends MyClass
{
    public static $my_static = 'static var';

    public static function doubleColon() {
        echo parent::CONST_VALUE . "\n";
        echo self::$my_static . "\n";
    }
}

$classname = 'OtherClass';
echo $classname::doubleColon(); // As of PHP 5.3.0

OtherClass::doubleColon();
 

/*When an extending class overrides the parents definition of a method, PHP will not call the parent's method. 
It's up to the extended class on whether or not the parent's method is called. This also applies to Constructors 
and Destructors, Overloading, and Magic method definitions. 
*/

//Example #3 Calling a parent's method

class MyClass
{
    protected function myFunc() {
        echo "MyClass::myFunc()\n";
    }
}

class OtherClass extends MyClass
{
    // Override parent's definition
    public function myFunc()
    {
        // But still call the parent function
        parent::myFunc();
        echo "OtherClass::myFunc()\n";
    }
}

$class = new OtherClass();
$class->myFunc();

?> 