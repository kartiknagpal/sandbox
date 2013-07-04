<?php

class MyClass
{
   // This is the CLASS DEFINITION (everything in the curly brackets).

   // $myVar is DECLARED, but it is not INITIALIZED (assigned a value).
   protected $myVar;

   public function __construct($value = 'What?')
   {
     $this->setMyVar($value); // $myVar will now be INITIALIZED
   }

   public function setMyVar($value)
   {
     if(!is_string($value))
     {
       $value = (string)'Non-String type passed in argument';
     }

     $this->myVar = $value;
   }

    public function __toString() {
     return "You ordered ($this->qty) '$this->name'" . ($this->qty == 1 ? "" : "s") .
     " at \$$this->price, for a total of: \$$this->total.";
   }

   // this will be called automatically at the end of scope
    public function __destruct() {
       mysql_close( $this->_Link );
    }

 }

/*With regards to Singleton patterns (and variable class names) - try: */

class MyClass { 

   // singleton instance 
   private static $instance; 

   // private constructor function 
   // to prevent external instantiation 
   private __construct() { } 

   // getInstance method 
   public static function getInstance() { 

     if(!self::$instance) { 
       self::$instance = new self(); 
     } 

     return self::$instance; 

   }  

} 
/*
When you have a class name in a variable and want to create a new instance of that class, you can simply use:
*/
 $className = "ClassName";
$instance = new $className();


 /*If, however, you have a class that is part of a singleton pattern where you cannot create it with new and need to use:*/

 $instance = ClassName::GetInstance();


/*We can't create easily anonymous objects like in JavaScript. 
 JS example : 

     var o = { 
         aProperty : "value", 
         anotherProperty : [ "element 1", "element 2" ] } ; 
     alert(o.anotherProperty[1]) ; // "element 2" 

 So I have created a class Object : */

     class Object { 
         function __construct( ) { 
             $n = func_num_args( ) ; 
             for ( $i = 0 ; $i < $n ; $i += 2 ) { 
                 $this->{func_get_arg($i)} = func_get_arg($i + 1) ; 
             } 
         } 
     } 

     $o = new Object( 
         'aProperty', 'value', 
         'anotherProperty', array('element 1', 'element 2')) ; 
     echo $o->anotherProperty[1] ; // "element 2" 



/*get_called_class

(PHP 5 >= 5.3.0)

get_called_class — the "Late Static Binding" class name


Description

string get_called_class ( void )

Gets the name of the class the static method is called in. 


Return Values

Returns the class name. Returns FALSE if called from outside a class. 


Examples*/


//Example #1 Using get_called_class()

class foo {
    static public function test() {
        var_dump(get_called_class());
    }
}

class bar extends foo {
}

foo::test();
bar::test();


/*The above example will output:


string(3) "foo"
string(3) "bar"
*/

?> 