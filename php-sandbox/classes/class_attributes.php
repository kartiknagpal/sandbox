<?php
/*Properties:

Class member variables are called "properties". You may also see them referred to using other terms such as 
"attributes" or "fields", but for the purposes of this reference we will use "properties". 
They are defined by using one of the keywords public, protected, or private, followed by a normal variable 
declaration. This declaration may include an initialization, but this initialization must be a constant 
value--that is, it must be able to be evaluated at compile time and must not depend on run-time information in 
order to be evaluated. 

In fact, PHP does not force us to declare all our properties in the class. You could add properties
dynamically to an object.
However, this method of assigning properties to objects is not considered good practice in object oriented
programming and is almost never used.
Why is it bad practice to set properties dynamically? 
When you create a class you define a type. You inform the world that your class (and any object instantiated from it)
consists of a particular set of fields and functions.

Within class methods the properties, constants, and methods may be accessed by using the form $this->property 
(where property is the name of the property) unless the access is to a static property within the context of 
a static class method, in which case it is accessed using the form self::$property.
The pseudo-variable $this is available inside any class method when that method is called from within an object 
context. $this is a reference to the calling object.

*/
//Example #1 property declarations

class SimpleClass
{
   // invalid property declarations:
   public $var1 = 'hello ' . 'world';
   public $var2 = <<<EOD
hello world
EOD;
   public $var3 = 1+2;
   public $var4 = self::myStaticMethod();
   public $var5 = $myVar;

   // valid property declarations:
   public $var6 = myConstant;
   public $var7 = array(true, false);

   // This is allowed only in PHP 5.3.0 and later.
   public $var8 = <<<'EOD'
hello world
EOD;
}



?>