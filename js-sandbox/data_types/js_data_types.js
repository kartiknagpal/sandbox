//The ECMAScript standard defines six data types:
/*Object everything:

In JavaScript, almost everything is an object. 
All primitive types except null and undefined are treated as objects.
They can be assigned properties (assigned properties of some types are not persistent), and they have all 
characteristics of objects.*/

Number
String
Boolean
Object
	Function
	Array
	Date
	RegExp
null	-	null, which is an object of type 'object' that indicates a deliberate non-value
undefined	-	undefined, which is an object of type 'undefined' that indicates an uninitialized value

And there are some built in Error types as well. 
Functions are regular objects with the additional capability of being callable.

//Primitive values-

All types except objects define immutable values. Specifically, strings are immutable (unlike in C for instance). 
We refer to values of these types as "primitive values." 
This is explained in more detail in the section on Strings below.

//Boolean, null, and undefined

Within these types, four constants can be found: true, false, null, and undefined. Since these are constants, 
they cannot represent rich data (or data structures).

//Numbers:

According to the ECMAScript standard, there is only one number type: 
the "double-precision 64-bit binary format IEEE 754 value". There is no specific type for integers. 
In addition to being able to represent floating-point numbers, it has some symbolic values: +Infinity, -Infinity, 
and NaN (not-a-number).

The standard numeric operators are supported, including addition, subtraction, modulus (or remainder) arithmetic 
and so forth. There kis also a built-in object that I forgot to mention earlier called Math to handle more advanced 
mathematical functions and constants:

Math.sin(3.5);
var d = Math.PI * r * r;
You can convert a string to an integer using the built-in parseInt() function. This takes the base for the 
conversion as an optional second argument, which you should always provide:

> parseInt("123", 10)
123
> parseInt("010", 10)
10
If you do not provide the base, you can get surprising results in older browsers (pre-2013):

> parseInt("010")
8
That happened because the parseInt function decided to treat the string as octal due to the leading 0.

If you want to convert a binary number to an integer, just change the base:

> parseInt("11", 2)
3
Similarly, you can parse floating point numbers using the built-in parseFloat() function which uses base 10 always 
unlike its parseInt() cousin.

You can also use the unary + operator to convert values to numbers:

> + "42"
42 
A special value called NaN (short for "Not a Number") is returned if the string is non-numeric:

> parseInt("hello", 10)
NaN
NaN is toxic: if you provide it as an input to any mathematical operation the result will also be NaN:

> NaN + 5
NaN
You can test for NaN using the built-in isNaN() function:

> isNaN(NaN)
true
JavaScript also has the special values Infinity and -Infinity:

> 1 / 0
Infinity
> -1 / 0
-Infinity
You can test for Infinity, -Infinity and NaN values using the built-in isFinite() function:

> isFinite(1/0)
false
> isFinite(-Infinity)
false
> isFinite(NaN)
false
Note: The parseInt() and parseFloat() functions parse a string until they reach a character that is not valid 
for the specified number format, then return the number parsed up to that point. However the "+" operator simply 
	converts the string to NaN if there is any invalid character in it. Just try parsing the string "10.2abc" 
with each method by yourself in the console and you wll understand the differences better.

//Strings:

Strings in JavaScript are sequences of characters. More accurately, they are sequences of Unicode characters, 
with each character represented by a 16-bit number.
This should be welcome news to anyone who has had to deal with internationalisation. 
Unlike in languages like C, JavaScript strings are immutable. This means that once a string is created, 
it is not possible to modify it. However, it is still possible to create another string based on an operation 
on the original string.

If you want to represent a single character, you just use a string of length 1.

To find the length of a string, access its length property:

> "hello".length
5
Did I mention that strings are objects too? They have methods as well:

> "hello".charAt(0)
h
> "hello, world".replace("hello", "goodbye")
goodbye, world
> "hello".toUpperCase()
HELLO

 For example:

A substring of the original by picking individual letters or using String.substr().
A concatenation of two strings using the concatenation operator (+) or String.concat().
Beware of "stringly-typing" your code!

It can be tempting to use strings to represent complex data. Doing this comes with short-term benefits:

It is easy to build complex strings with concatenation.
Strings are easy to debug (what you see printed is always what is in the string).
Strings are the common denominator of a lot of APIs (input fields, local storage values, XMLHttpRequest responses 
when using responseText, etc.) and it can be tempting to only work with strings.
With conventions, it is possible to represent any data structure in a string. This does not make it a good idea. 
For instance, with a separator, one could emulate a list (while a JavaScript array would be more suitable). 
Unfortunately, when the separator is used in one of the "list" elements, then, the list is broken. 
An escape character can be chosen, etc. All of this requires conventions and creates an unneccessary maintenance 
burden.

Use strings for textual data and symbolic data. When representing complex data, parse strings and use the 
appropriate abstraction.

//Objects:

In JavaScript, objects can be seen as a bag of properties. With the object literal syntax, a limited set of 
properties are initialized; then properties can be added and removed. Property values can be values of any type, 
including other objects, which enables building complex data structures.

"Normal" objects, and functions

A JavaScript object is a mapping between keys and values. Keys are strings and values can be anything. 
This makes objects a natural fit for hashmaps. However, the non-standard __proto__ pseudo property must be used 
with caution. In environments that support it, assigning a new value to __proto__ also changes the value of the 
internal object prototype. In a context where it is not necessarily known where the string comes from 
(like an input field), caution is required: others have been burned by this. In that case, an alternative 
is to use a proper StringMap abstraction.

Functions are regular objects with the additional capability of being callable.

//Arrays:

Arrays are regular objects for which there is a particular relationship between integer-key-ed properties 
and the 'length' property. Additionally, arrays inherit from Array.prototype which provides to them a handful 
of convenient methods to manipulate arrays like indexOf (searching a value in the array) or push 
(adding an element to the array), etc. This makes arrays a perfect candidate to represent lists or sets.

//Dates:

When representing dates, the best choice is to use the built-in Date utility.

//WeakMaps, Maps, Sets:

Non-standard. Likely to be standardized as part of ECMAScript 6.

These data structures take object references as keys. A Set represents a set of objects, while WeakMaps and Maps 
associates a value to an object. The difference between Maps and WeakMaps is that in the former, object keys 
can be enumerated over. This allows garbage collection optimizations in the latter case.

One could implement Maps and Sets in pure ECMAScript 5. However, since objects cannot be compared 
(in the sense of "less than" for instance), look-up performance would necessarily be linear. 
Native implementations of them (including WeakMaps) can have look-up performance that is approximately 
logarithmic to constant time.

Usually, to bind data to a DOM node, one could set properties directly on the object or use data-* attributes. 
This has the downside that the data is available to any script running in the same context. Maps and WeakMaps 
make easy to privately bind data to an object.

//TypedArrays:

Non-standard. Likely to be standardized as part of ECMAScript 6.