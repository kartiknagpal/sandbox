<?php
/*Functions:
All functions and classes in PHP have the global scope - they can be called outside a function even if they were 
defined inside and vice versa. 

Any valid PHP code may appear inside a function, even other functions and class definitions. 
PHP does not support function overloading, nor is it possible to undefine or redefine previously-declared functions. 

Note:  Function names are case-insensitive, though it is usually good form to call functions as they appear in 
their declaration.

User-defined functions
Variable functions
Internal (built-in) functions
Anonymous functions


function_exists

(PHP 4, PHP 5)

function_exists — Return TRUE if the given function has been defined


Description

bool function_exists ( string $function_name )

Checks the list of defined functions, both built-in (internal) and user-defined, for function_name.


<----------------   @args   ---------------->
 func_num_args(), func_get_arg() and func_get_args() allow user-defined functions to accept variable-length argument lists.

 Example #1 func_num_args() example*/

function foo()
{
    $numargs = func_num_args();
    echo "Number of arguments: $numargs\n";
}

foo(1, 2, 3);   
 


/*The above example will output:


Number of arguments: 3

<----------  @return  ------------>

To return a reference from a function, use the reference operator & in both the function declaration and when 
assigning the returned value to a variable: 

Example #3 Returning a reference from a function
*/

function &returns_reference()
{
    return $someref;
}

$newref =& returns_reference();

/*Developers with a C background may expect pass by reference semantics for arrays. 
It may be surprising that  pass by value is used for arrays just like scalars. 
Objects are implicitly passed by reference.*/


# (1) Objects are always passed by reference and returned by reference

class Obj {
     public $x;
 }

 function obj_inc_x($obj) {
     $obj->x++;
     return $obj;
 }

$obj = new Obj();
$obj->x = 1;

$obj2 = obj_inc_x($obj);
obj_inc_x($obj2);

 print $obj->x . ', ' . $obj2->x . "\n";

# (2) Scalars are not passed by reference or returned as such

function scalar_inc_x($x) {
     $x++;
     return $x;
 }

$x = 1;

$x2 = scalar_inc_x($x);
scalar_inc_x($x2);

 print $x . ', ' . $x2 . "\n";

# (3) You have to force pass by reference and return by reference on scalars

function &scalar_ref_inc_x(&$x) {
     $x++;
     return $x;
 }

$x = 1;

$x2 =& scalar_ref_inc_x($x);    # Need reference here as well as the function sig
scalar_ref_inc_x($x2);

 print $x . ', ' . $x2 . "\n";

# (4) Arrays use pass by value sematics just like scalars

function array_inc_x($array) {
     $array{'x'}++;
     return $array;
 }

$array = array();
$array['x'] = 1;

$array2 = array_inc_x($array);
array_inc_x($array2);

 print $array['x'] . ', ' . $array2['x'] . "\n";

# (5) You have to force pass by reference and return by reference on arrays

function &array_ref_inc_x(&$array) {
     $array{'x'}++;
     return $array;
 }

$array = array();
$array['x'] = 1;

$array2 =& array_ref_inc_x($array); # Need reference here as well as the function sig
array_ref_inc_x($array2);

 print $array['x'] . ', ' . $array2['x'] . "\n";


/*Variable functions:

PHP supports the concept of variable functions. This means that if a variable name has parentheses appended to it, 
PHP will look for a function with the same name as whatever the variable evaluates to, and will attempt to execute 
it. Among other things, this can be used to implement callbacks, function tables, and so forth. 

Variable functions won't work with language constructs such as echo(), print(), unset(), isset(), empty(), 
include(), require() and the like. Utilize wrapper functions to make use of any of these constructs as variable 
functions. 

Example #1 Variable function example:
*/

function foo() {
    echo "In foo()<br />\n";
}

function bar($arg = '')
{
    echo "In bar(); argument was '$arg'.<br />\n";
}

// This is a wrapper function around echo
function echoit($string)
{
    echo $string;
}

$func = 'foo';
$func();        // This calls foo()

$func = 'bar';
$func('test');  // This calls bar()

$func = 'echoit';
$func('test');  // This calls echoit()
 

/*An object method can also be called with the variable functions syntax. 


Example #2 Variable method example*/

class Foo
{
    function Variable()
    {
        $name = 'Bar';
        $this->$name(); // This calls the Bar() method
    }
    
    function Bar()
    {
        echo "This is Bar";
    }
}

$foo = new Foo();
$funcname = "Variable";
$foo->$funcname();  // This calls $foo->Variable()


/*
When calling static methods, the function call is stronger than the static property operator: 


Example #3 Variable method example with static properties
*/

class Foo
{
    static $variable = 'static property';
    static function Variable()
    {
        echo 'Method Variable called';
    }
}

echo Foo::$variable; // This prints 'static property'. It does need a $variable in this scope.
$variable = "Variable";
Foo::$variable();  // This calls $foo->Variable() reading $variable in this scope.


/*Anonymous functions:

Anonymous functions, also known as closures, allow the creation of functions which have no specified name. 
They are most useful as the value of callback parameters, but they have many other uses. 

Example #1 Anonymous function example*/


echo preg_replace_callback('~-([a-z])~', function ($match) {
    return strtoupper($match[1]);
}, 'hello-world');
// outputs helloWorld
 

/*Closures can also be used as the values of variables; PHP automatically converts such expressions into instances 
of the Closure internal class. Assigning a closure to a variable uses the same syntax as any other assignment, 
including the trailing semicolon:

Example #2 Anonymous function variable assignment example
*/

$greet = function($name)
{
    printf("Hello %s\r\n", $name);
};

$greet('World');
$greet('PHP');

/*
Closures may also inherit variables from the parent scope. Any such variables must be declared in the function 
header. Inheriting variables from the parent scope is not the same as using global variables. 
Global variables exist in the global scope, which is the same no matter what function is executing. 
The parent scope of a closure is the function in which the closure was declared (not necessarily the function 
it was called from). See the following example: 

Example #3 Closures and scoping

*/

// A basic shopping cart which contains a list of added products
// and the quantity of each product. Includes a method which
// calculates the total price of the items in the cart using a
// closure as a callback.
class Cart
{
    const PRICE_BUTTER  = 1.00;
    const PRICE_MILK    = 3.00;
    const PRICE_EGGS    = 6.95;

    protected $products = array();
    
    public function add($product, $quantity)
    {
        $this->products[$product] = $quantity;
    }
    
    public function getQuantity($product)
    {
        return isset($this->products[$product]) ? $this->products[$product] :
               FALSE;
    }
    
    public function getTotal($tax)
    {
        $total = 0.00;
        
        $callback =
            function ($quantity, $product) use ($tax, &$total)
            {
                $pricePerItem = constant(__CLASS__ . "::PRICE_" .
                    strtoupper($product));
                $total += ($pricePerItem * $quantity) * ($tax + 1.0);
            };
        
        array_walk($this->products, $callback);
        return round($total, 2);
    }
}

$my_cart = new Cart;

// Add some items to the cart
$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);

// Print the total with a 5% sales tax.
print $my_cart->getTotal(0.05) . "\n";
// The result is 54.29

/*
Anonymous functions are implemented using the Closure class.*/


?>