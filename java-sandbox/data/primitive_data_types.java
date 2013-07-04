Primitive Data Types: 8 types

The Java programming language is statically-typed, which means that all variables must first be declared before they 
can be used. This involves stating the variables type and name, as youve already seen:
int gear = 1;

Doing so tells your program that a field named "gear" exists, holds numerical data, and has an initial value of "1". 
A variables data type determines the values it may contain, plus the operations that may be performed on it. 
In addition to int, the Java programming language supports seven other primitive data types. 
A primitive type is predefined by the language and is named by a reserved keyword. 
Primitive values do not share state with other primitive values. 

//TODO: AutoBoxing, Integer.ParseInt("34"),......

//<-----------	The eight primitive data types supported by the Java programming language are:  ----------->


byte: 
	The byte data type is an 8-bit signed twos complement integer. It has a minimum value of -128 and a maximum 
	value of 127 (inclusive). The byte data type can be useful for saving memory in large arrays, where the memory 
	savings actually matters. They can also be used in place of int where their limits help to clarify your code; 
	the fact that a variables range is limited can serve as a form of documentation.


short: 
	The short data type is a 16-bit signed twos complement integer. It has a minimum value of -32,768 and a 
	maximum value of 32,767 (inclusive). As with byte, the same guidelines apply: you can use a short to save memory 
	in large arrays, in situations where the memory savings actually matters.


int: 
	The int data type is a 32-bit signed twos complement integer. It has a minimum value of -2,147,483,648 and a 
	maximum value of 2,147,483,647 (inclusive). For integral values, this data type is generally the default choice 
	unless there is a reason (like the above) to choose something else. This data type will most likely be large 
	enough for the numbers your program will use, but if you need a wider range of values, use long instead.


long: 
	The long data type is a 64-bit signed twos complement integer. It has a minimum value of 
	-9,223,372,036,854,775,808 and a maximum value of 9,223,372,036,854,775,807 (inclusive). Use this data type when 
	you need a range of values wider than those provided by int.


float: 
	The float data type is a single-precision 32-bit IEEE 754 floating point. Its range of values is beyond the 
	scope of this discussion, but is specified in the Floating-Point Types, Formats, and Values section of the 
	Java Language Specification. As with the recommendations for byte and short, use a float (instead of double) if 
	you need to save memory in large arrays of floating point numbers. This data type should never be used for 
	precise values, such as currency. For that, you will need to use the java.math.BigDecimal ((class)) instead. Numbers 
	and Strings covers BigDecimal and other useful (class)es provided by the Java platform.


double: 
	The double data type is a double-precision 64-bit IEEE 754 floating point. Its range of values is beyond the 
	scope of this discussion, but is specified in the Floating-Point Types, Formats, and Values section of the 
	Java Language Specification. For decimal values, this data type is generally the default choice. As mentioned 
	above, this data type should never be used for precise values, such as currency.


boolean: 
	The boolean data type has only two possible values: true and false. Use this data type for simple flags that track 
	true/false conditions. This data type represents one bit of information, but its "size" isnt something thats 
	precisely defined.


char: 
	The char data type is a single 16-bit Unicode character. It has a minimum value of \u0000 (or 0) and a maximum 
	value of \uffff (or 65,535 inclusive).

In addition to the eight primitive data types listed above, the Java programming language also provides special 
support for character strings via the java.lang.String (class). Enclosing your character string within double 
quotes will automatically create a new String object; for example, String s = "this is a string";. 
String objects are immutable, which means that once created, their values cannot be changed. The String (class) 
is not technically a primitive data type, but considering the special support given to it by the language, 
youll probably tend to think of it as such. 
Youll learn more about the String (class) in Simple Data Objects



//<-------------	Default Values for primitive variables as instance fields:   --------------->


Its not always necessary to assign a value when a field is declared. Fields that are declared but not 
initialized will be set to a reasonable default by the compiler. Generally speaking, this default will be zero 
or null, depending on the data type. Relying on such default values, however, is generally considered bad 
programming style.

The following chart summarizes the default values for the above data types.

Data Type				Default Value (for fields)
byte						0
short						0
int							0
long						0L
float						0.0f
double						0.0d
char						'\u0000'
String (or any object)  	null
boolean						false



Local variables are slightly different; the compiler never assigns a default value to an uninitialized local 
variable. If you cannot initialize your local variable where it is declared, make sure to assign it a value 
before you attempt to use it. Accessing an uninitialized local variable will result in a compile-time error.


//<----------	Literals:   ----------->


You may have noticed that the new keyword isn't used when initializing a variable of a primitive type. 
Primitive types are special data types built into the language; they are not objects created from a (class). 
A literal is the source code representation of a fixed value; literals are represented directly in your code 
without requiring computation. As shown below, its possible to assign a literal to a variable of a primitive type:
boolean result = true;
char capitalC = 'C';
byte b = 100;
short s = 10000;
int i = 100000;


Integer Literals:
An integer literal is of type long if it ends with the letter L or l; otherwise it is of type int. 
It is recommended that you use the upper case letter L because the lower case letter l is hard to distinguish 
from the digit 1.

Values of the integral types byte, short, int, and long can be created from int literals. Values of type long that 
exceed the range of int can be created from long literals. 
Integer literals can be expressed by these number systems:
Decimal: Base 10, whose digits consists of the numbers 0 through 9; this is the number system you use every day
Hexadecimal: Base 16, whose digits consist of the numbers 0 through 9 and the letters A through F
Binary: Base 2, whose digits consists of the numbers 0 and 1 (you can create binary literals in Java SE 7 and later)

For general-purpose programming, the decimal system is likely to be the only number system youll ever use. 
However, if you need to use another number system, the following example shows the correct syntax. 
The prefix 0x indicates hexadecimal and 0b indicates binary:
// The number 26, in decimal
int decVal = 26;
//  The number 26, in hexadecimal
int hexVal = 0x1a;
// The number 26, in binary
int binVal = 0b11010;
Floating-Point Literals

A floating-point literal is of type float if it ends with the letter F or f; otherwise its type is double and it 
can optionally end with the letter D or d.

The floating point types (float and double) can also be expressed using E or e (for scientific notation), 
F or f (32-bit float literal) and D or d (64-bit double literal; this is the default and by convention is omitted).
double d1 = 123.4;
// same value as d1, but in scientific notation
double d2 = 1.234e2;
float f1  = 123.4f;
Character and String Literals

Literals of types char and String may contain any Unicode (UTF-16) characters. If your editor and file system 
allow it, you can use such characters directly in your code. If not, you can use a "Unicode escape" such as 
'\u0108' (capital C with circumflex), or "S\u00ED Se\u00F1or" (Sí Señor in Spanish). Always use 'single quotes' 
for char literals and "double quotes" for String literals. Unicode escape sequences may be used elsewhere in a 
	program (such as in field names, for example), not just in char or String literals.

The Java programming language also supports a few special escape sequences for char and String literals: \b 
(backspace), \t (tab), \n (line feed), \f (form feed), \r (carriage return), \"" (double quote), \'' (single quote), 
and \\ (backslash).

Theres also a special null literal that can be used as a value for any reference type. null may be assigned to any 
variable, except variables of primitive types. Theres little you can do with a null value beyond testing for its 
presence. Therefore, null is often used in programs as a marker to indicate that some object is unavailable.

Finally, theres also a special kind of literal called a ((class)) literal, formed by taking a type name and 
appending ".(class)"; for example, String.(class). This refers to the object (of type Class) that represents the 
type itself.



//<------------		Using Underscore Characters in Numeric Literals:	-------------->


In Java SE 7 and later, any number of underscore characters (_) can appear anywhere between digits in a numerical 
literal. This feature enables you, for example. to separate groups of digits in numeric literals, which can improve 
the readability of your code.
For instance, if your code contains numbers with many digits, you can use an underscore character to separate 
digits in groups of three, similar to how you would use a punctuation mark like a comma, or a space, as a separator.
The following example shows other ways you can use the underscore in numeric literals:
long creditCardNumber = 1234_5678_9012_3456L;
long socialSecurityNumber = 999_99_9999L;
float pi =  3.14_15F;
long hexBytes = 0xFF_EC_DE_5E;
long hexWords = 0xCAFE_BABE;
long maxLong = 0x7fff_ffff_ffff_ffffL;
byte nybbles = 0b0010_0101;
long bytes = 0b11010010_01101001_10010100_10010010;

