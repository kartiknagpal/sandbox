<?php

/*PHP supports eight primitive types.

Four scalar types:
boolean
integer
float (floating-point number, aka double)
string

Two compound types:
array
object

And finally two special types:
resource
NULL

This manual also introduces some pseudo-types for readability reasons:
mixed
number
callback
And the pseudo-variable $....

Type Checking   Function Type       Description
is_bool()       Boolean             One of the two special values true or false
is_integer()    Integer             A whole number
is_double()     Double              A floating point number (a number with a decimal point)
is_string()     String              Character data
is_object()     Object              An object
is_array()      Array               An array
is_resource()   Resource            A handle for identifying and working with external
                                    resources such as databases or files
is_null()       Null                An unassigned value
Checking the type of a variable can be particularly important when you work with method and
function arguments.

Consider double the same as float; the two names exist only for historic reasons.

The type of a variable is not usually set by the programmer; rather, it is decided at runtime by PHP 
depending on the context in which that variable is used.

Note: To check the type and value of an expression, use the var_dump() function.

To get a human-readable representation of a type for debugging, use the gettype() function. 
To check for a certain type, do not use gettype(), but rather the is_type functions. 
To forcibly convert a variable to a certain type, either cast the variable or use the settype() 
function on it.

Some examples:
*/
<?php
$a_bool = TRUE;   // a boolean
$a_str  = "foo";  // a string
$a_str2 = 'foo';  // a string
$an_int = 12;     // an integer

echo gettype($a_bool); // prints out:  boolean
echo gettype($a_str);  // prints out:  string

// If this is an integer, increment it by four
if (is_int($an_int)) {
    $an_int += 4;
}

// If $a_bool is a string, print it out
// (does not print out anything)
if (is_string($a_bool)) {
    echo "String: $a_bool";
}

/*
Boolean:
	To specify a boolean literal, use the keywords TRUE or FALSE. Both are case-insensitive.
	Typically, the result of an operator which returns a boolean value is passed on to a 
	control structure. 

*/

// == is an operator which tests
// equality and returns a boolean
if ($action == "show_version") {
    echo "The version is 1.23";
}

// this is not necessary...
if ($show_separators == TRUE) {
    echo "<hr>\n";
}

// ...because this can be used with exactly the same meaning:
if ($show_separators) {
    echo "<hr>\n";
}

/*
Integers:

An integer is a number of the set ℤ = {..., -2, -1, 0, 1, 2, ...}. 

Syntax

Integers can be specified in decimal (base 10), hexadecimal (base 16), octal (base 8) or binary (base 2) notation, optionally preceded by a sign (- or +). 

Binary integer literals are available since PHP 5.4.0. 

To use octal notation, precede the number with a 0 (zero). To use hexadecimal notation precede 
the number with 0x. To use binary notation precede the number with 0b. 


Example #1 Integer literals*/


$a = 1234; // decimal number
$a = -123; // a negative number
$a = 0123; // octal number (equivalent to 83 decimal)
$a = 0x1A; // hexadecimal number (equivalent to 26 decimal)
 

/*Formally, the structure for integer literals is: 



decimal     : [1-9][0-9]*
            | 0

hexadecimal : 0[xX][0-9a-fA-F]+

octal       : 0[0-7]+

binary      : 0b[01]+

integer     : [+-]?decimal
            | [+-]?hexadecimal
            | [+-]?octal
            | [+-]?binary


The size of an integer is platform-dependent, although a maximum value of about two billion is 
the usual value (that's 32 bits signed). 64-bit platforms usually have a maximum value of about 9E18. 
PHP does not support unsigned integers. Integer size can be determined using the constant 
PHP_INT_SIZE, and maximum value using the constant PHP_INT_MAX since PHP 4.4.0 and PHP 5.0.5.

Integer overflow:

If PHP encounters a number beyond the bounds of the integer type, it will be interpreted as a 
float instead. Also, an operation which results in a number beyond the bounds of the integer 
type will return a float instead. 

Example #3 Integer overflow on a 32-bit system
*/

$large_number = 2147483647;
var_dump($large_number);                     // int(2147483647)

$large_number = 2147483648;
var_dump($large_number);                     // float(2147483648)

$million = 1000000;
$large_number =  50000 * $million;
var_dump($large_number);                     // float(50000000000)

/*Converting to integer

To explicitly convert a value to integer, use either the (int) or (integer) casts. 
However, in most cases the cast is not needed, since a value will be automatically converted if an 
operator, function or control structure requires an integer argument. 
A value can also be converted to integer with the intval() function. 

From booleans

FALSE will yield 0 (zero), and TRUE will yield 1 (one).*/ 


/*Floating point numbers:
The size of a float is platform-dependent, although a maximum of ~1.8e308 with a precision of 
roughly 14 decimal digits is a common value (the 64 bit IEEE format). 
Floating point numbers (also known as "floats", "doubles", or "real numbers") can be specified 
using any of the following syntaxes: 

*/

$a = 1.234; 
$b = 1.2e3; 
$c = 7E-10;


/*Comparing floats

As noted in the warning above, testing floating point values for equality is problematic, 
due to the way that they are represented internally. However, there are ways to make comparisons 
of floating point values that work around these limitations. 

To test floating point values for equality, an upper bound on the relative error due to rounding 
is used. This value is known as the machine epsilon, or unit roundoff, and is the smallest acceptable 
difference in calculations. 

$a and $b are equal to 5 digits of precision. */

$a = 1.23456789;
$b = 1.23456780;
$epsilon = 0.00001;

if(abs($a-$b) < $epsilon) {
    echo "true";
}


/*NaN

Some numeric operations can result in a value represented by the constant NAN. This result represents 
an undefined or unrepresentable value in floating-point calculations. Any loose or strict comparisons 
of this value against any other value, including itself, will have a result of FALSE. 

Because NAN represents any number of different values, NAN should not be compared to other values, 
including itself, and instead should be checked for using is_nan(). */

/*
Strings:

A string is series of characters, where a character is the same as a byte. 
This means that PHP only supports a 256-character set, and hence does not offer native Unicode support. 
See details of the string type. 
Note: string can be as large as 2GB.  

Syntax

A string literal can be specified in four different ways: 
single quoted  
double quoted  
heredoc syntax  
nowdoc syntax (since PHP 5.3.0) 

Single quoted

The simplest way to specify a string is to enclose it in single quotes (the character '). 

To specify a literal single quote, escape it with a backslash (\). To specify a literal backslash, 
double it (\\). All other instances of backslash will be treated as a literal backslash: 
this means that the other escape sequences you might be used to, such as \r or \n, will be output 
literally as specified rather than having any special meaning. 

Note:  Unlike the double-quoted and heredoc syntaxes, variables and escape sequences for special 
characters will not be expanded when they occur in single quoted strings. 

Heredoc:

A third way to delimit strings is the heredoc syntax: <<<. After this operator, an identifier is 
provided, then a newline. The string itself follows, and then the same identifier again to close 
the quotation. 

The closing identifier must begin in the first column of the line. Also, the identifier must 
follow the same naming rules as any other label in PHP: it must contain only alphanumeric characters 
and underscores, and must start with a non-digit character or underscore.

*/

#2 Heredoc string quoting example

$str = <<<EOD
Example of string
spanning multiple lines
using heredoc syntax.
EOD;

/* More complex example, with variables. */
class foo
{
    var $foo;
    var $bar;

    function foo()
    {
        $this->foo = 'Foo';
        $this->bar = array('Bar1', 'Bar2', 'Bar3');
    }
}

$foo = new foo();
$name = 'MyName';

echo <<<EOT
My name is "$name". I am printing some $foo->foo.
Now, I am printing some {$foo->bar[1]}.
This should print a capital 'A': \x41
EOT;



/*ARRAYS:

An array in PHP is actually an ordered map. A map is a type that associates values to keys. 
This type is optimized for several different uses; it can be treated as an array, list (vector), 
hash table (an implementation of a map), dictionary, collection, stack, queue, and probably more. 
As array values can be other arrays, trees and multidimensional arrays are also possible. 

Syntax-
Specifying with array()

An array can be created using the array() language construct. It takes any number of comma-separated 
key => value pairs as arguments. */

array(
    key  => value,
    key2 => value2,
    key3 => value3,
    ...
)

/*The comma after the last array element is optional and can be omitted. This is usually done 
for single-line arrays, i.e. array(1, 2) is preferred over array(1, 2, ). 
For multi-line arrays on the other hand the trailing comma is commonly used, as it allows easier 
addition of new elements at the end. 

As of PHP 5.4 you can also use the short array syntax, which replaces array() with []. 


Example #1 A simple array
*/

$array = array(
    "foo" => "bar",
    "bar" => "foo",
);

// as of PHP 5.4
$array = [
    "foo" => "bar",
    "bar" => "foo",
];  

/*The key can either be an integer or a string. The value can be of any type. 

Additionally the following key casts will occur: 
Strings containing valid integers will be cast to the integer type. E.g. the key "8" will actually 
be stored under 8. On the other hand "08" will not be cast, as it isn't a valid decimal integer.  
Floats are also cast to integers, which means that the fractional part will be truncated. 
E.g. the key 8.7 will actually be stored under 8.  
Bools are cast to integers, too, i.e. the key true will actually be stored under 1 and the key 
false under 0.  
Null will be cast to the empty string, i.e. the key null will actually be stored under "".  
Arrays and objects can not be used as keys. Doing so will result in a warning: Illegal offset type. 
 
Creating/modifying with square bracket syntax

An existing array can be modified by explicitly setting values in it. 

This is done by assigning values to the array, specifying the key in brackets. The key can also be omitted, resulting in an empty pair of brackets ([]). 
$arr[key] = value;
$arr[] = value;
key may be an integer or string
value may be any value of any type

If $arr doesn't exist yet, it will be created, so this is also an alternative way to create an array. 
This practice is however discouraged because if $arr already contains some value (e.g. string from 
request variable) then this value will stay in the place and [] may actually stand for string access 
operator. It is always better to initialize variable by a direct assignment. 

To change a certain value, assign a new value to that element using its key. To remove a key/value 
pair, call the unset() function on it. 

Note: 

As mentioned above, if no key is specified, the maximum of the existing integer indices is taken, 
and the new key will be that maximum value plus 1 (but at least 0). If no integer indices exist yet, 
the key will be 0 (zero). 

Note that the maximum integer key used for this need not currently exist in the array. 
It need only have existed in the array at some time since the last time the array was re-indexed. 
The following example illustrates: 

 */


// Create a simple array.
$array = array(1, 2, 3, 4, 5);
print_r($array);

// Now delete every item, but leave the array itself intact:
foreach ($array as $i => $value) {
    unset($array[$i]);
}
print_r($array);

// Append an item (note that the new key is 5, instead of 0).
$array[] = 6;
print_r($array);

// Re-index:
$array = array_values($array);
$array[] = 7;
print_r($array);
 

/*The above example will output:
*/

Array
(
    [0] => 1
    [1] => 2
    [2] => 3
    [3] => 4
    [4] => 5
)
Array
(
)
Array
(
    [5] => 6
)
Array
(
    [0] => 6
    [1] => 7
)

Objects


/*Object Initialization

To create a new object, use the new statement to instantiate a class: 
*/

class foo
{
    function do_foo()
    {
        echo "Doing foo."; 
    }
}

$bar = new foo;
$bar->do_foo(); 

/*
Converting to object

If an object is converted to an object, it is not modified. If a value of any other type is converted 
to an object, a new instance of the stdClass built-in class is created. If the value was NULL, 
the new instance will be empty. Arrays convert to an object with properties named by keys, 
and corresponding values. For any other value, a member variable named scalar will contain the value.
*/

/*Resources

A resource is a special variable, holding a reference to an external resource. 
Resources are created and used by special functions. 

Converting to resource

As resource variables hold special handlers to opened files, database connections, image canvas 
areas and the like, converting to a resource makes no sense. 

NULL:

The special NULL value represents a variable with no value. NULL is the only possible value 
of type NULL. 

A variable is considered to be null if: 

 it has been assigned the constant NULL. 

 it has not been set to any value yet. 

 it has been unset(). 

Syntax

There is only one value of type null, and that is the case-insensitive constant NULL. 

See also the functions is_null() and unset(). 

Casting to NULL

Casting a variable to null using (unset) $var will not remove the variable or unset its value. 
It will only return a NULL value. 

*/

/*Callbacks

Some functions like call_user_func() or usort() accept user-defined callback functions as a parameter. 
Callback functions can not only be simple functions, but also object methods, including static class 
methods. 


Passing

A PHP function is passed by its name as a string. Any built-in or user-defined function can be used, 
except language constructs such as: array(), echo(), empty(), eval(), exit(), isset(), list(), print() 
or unset(). 

A method of an instantiated object is passed as an array containing an object at index 0 and the method 
name at index 1. 

Static class methods can also be passed without instantiating an object of that class by passing the 
class name instead of an object at index 0. As of PHP 5.2.3, it is also possible to pass 
'ClassName::methodName'. 

Apart from common user-defined function, create_function() can also be used to create an anonymous 
callback function. As of PHP 5.3.0 it is possible to also pass a closure to a callback parameter. 

Example #1 Callback function examples */


// An example callback function
function my_callback_function() {
    echo 'hello world!';
}

// An example callback method
class MyClass {
    static function myCallbackMethod() {
        echo 'Hello World!';
    }
}

// Type 1: Simple callback
call_user_func('my_callback_function'); 

// Type 2: Static class method call
call_user_func(array('MyClass', 'myCallbackMethod')); 

// Type 3: Object method call
$obj = new MyClass();
call_user_func(array($obj, 'myCallbackMethod'));

// Type 4: Static class method call (As of PHP 5.2.3)
call_user_func('MyClass::myCallbackMethod');

// Type 5: Relative static class method call (As of PHP 5.3.0)
class A {
    public static function who() {
        echo "A\n";
    }
}

class B extends A {
    public static function who() {
        echo "B\n";
    }
}

call_user_func(array('B', 'parent::who')); // A



/*Example #2 Callback example using a Closure */


// Our closure
$double = function($a) {
    return $a * 2;
};

// This is our range of numbers
$numbers = range(1, 5);

// Use the closure as a callback here to 
// double the size of each element in our 
// range
$new_numbers = array_map($double, $numbers);

print implode(' ', $new_numbers); 


/*The above example will output:


2 4 6 8 10*/


?> 

