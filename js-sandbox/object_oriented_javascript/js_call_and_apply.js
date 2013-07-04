Select language
Skip to search
Skip to main content
MOZILLA DEVELOPER NETWORK
READ
DOCS  MAKE
APPS BUILD & USE
FIREFOX  SEE & SUBMIT
DEMOS GET
INVOLVED Sign in

powered by	
mozilla
This page
Print this page
New sub-page
Clone this page
History
Languages
Español
日本語
한국어
Polski
中文 (简体)
Add translation
JavaScript JavaScript Reference Global Objects Function Function.prototype.call
Function.prototype.call
 EDIT
This article is in need of a technical review.
TABLE OF CONTENTS

Summary
Syntax
Parameters
Description
Examples
Using call to chain constructors for an object
Using call to invoke an anonymous function
See also
TAGS FILES
Summary

Calls a function with a given this value and arguments provided individually.

NOTE: While the syntax of this function is almost identical to that of apply(), the fundamental difference is that call() accepts an argument list, while apply() accepts a single array of arguments.
Method of Function
Implemented in	JavaScript 1.3
ECMAScript Edition	ECMAScript 3rd Edition
Syntax

fun.call(thisArg[, arg1[, arg2[, ...]]])
Parameters

thisArg
The value of this provided for the call to fun. Note that this may not be the actual value seen by the method: if the method is a function in non-strict mode code, null and undefined will be replaced with the global object, and primitive values will be boxed.
arg1, arg2, ...
Arguments for the object.
Description

You can assign a different this object when calling an existing function. this refers to the current object, the calling object.

With call, you can write a method once and then inherit it in another object, without having to rewrite the method for the new object.

Examples

Using call to chain constructors for an object

You can use call to chain constructors for an object, similar to Java. In the following example, the constructor for the Product object is defined with two parameters, name and price. Two other functions Food and Toy invoke Product passing this and name and price. Product initializes the properties name and price, both specialized functions define the category.

1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
function Product(name, price) {
  this.name = name;
  this.price = price;
 
  if (price < 0)
    throw RangeError('Cannot create product "' + name + '" with a negative price');
  return this;
}
 
function Food(name, price) {
  Product.call(this, name, price);
  this.category = 'food';
}
Food.prototype = new Product();
 
function Toy(name, price) {
  Product.call(this, name, price);
  this.category = 'toy';
}
Toy.prototype = new Product();
 
var cheese = new Food('feta', 5);
var fun = new Toy('robot', 40);
Using call to invoke an anonymous function

In this purely constructed example, we create anonymous function and use call to invoke it on every object in an array. The main purpose of the anonymous function here is to add a print function to every object, which is able to print the right index of the object in the array. Passing the object as this value was not strictly necessary, but is done for explanatory purpose.

1
2
3
4
5
6
7
8
9
10
11
12
13
var animals = [
  {species: 'Lion', name: 'King'},
  {species: 'Whale', name: 'Fail'}
];
 
for (var i = 0; i < animals.length; i++) {
  (function (i) { 
    this.print = function () { 
      console.log('#' + i  + ' ' + this.species + ': ' + this.name); 
    } 
    this.print();
  }).call(animals[i], i);
}
See also

apply
TAGS (2)
JavaScript Reference  JavaScript
Contributors to this page: jswisher, ronin712, user01, evilpie, rwaldron, jeffozvold, Skorney, techlivezheng, Sheppy, CristianTincu, kswedberg, ziyunfei, anthonyryan1, Waldo, Inimino, adriaanlabusc, loopology, roydukkey, thomasburette, Sdwyer, Schorsch, nobuoka, ethertank, salty-horse, Mgjbot, Maian, Dria, liveaa.com 
Last updated by: techlivezheng, Apr 6, 2013 6:03:41 AM 
Last reviewed by: techlivezheng, Apr 6, 2013 6:03:41 AM
Is MDN helpful to you? Please share your feedback with us. Or join our mailing list about improving MDN content.






Select language
Skip to search
Skip to main content
MOZILLA DEVELOPER NETWORK
READ
DOCS  MAKE
APPS BUILD & USE
FIREFOX  SEE & SUBMIT
DEMOS GET
INVOLVED Sign in

powered by  
mozilla
This page
Print this page
New sub-page
Clone this page
History
Languages
Español
Polski
中文 (简体)
Add translation
JavaScript JavaScript Reference Global Objects Function Function.prototype.apply
Function.prototype.apply
 EDIT
TABLE OF CONTENTS

Summary
Syntax
Parameters
Description
Examples
Using apply to chain constructors
apply and built-in functions
See also
TAGS FILES
Summary

Calls a function with a given this value and arguments provided as an array (or an array like object).

NOTE: While the syntax of this function is almost identical to that of call(), the fundamental difference is that call() accepts an argument list, while apply() accepts a single array of arguments.
Method of Function
Implemented in  JavaScript 1.3
ECMAScript Edition  ECMA-262 3rd Edition
Syntax

fun.apply(thisArg[, argsArray])
Parameters

thisArg
The value of this provided for the call to fun. Note that this may not be the actual value seen by the method: if the method is a function in non-strict mode code, null and undefined will be replaced with the global object, and primitive values will be boxed.
argsArray
An array like object, specifying the arguments with which fun should be called, or null or undefined if no arguments should be provided to the function.
JavaScript 1.8.5 note
Starting in JavaScript 1.8.5 (Firefox 4), this method works according to the ECMAScript 5 specification. That is, the arguments can be a generic array-like object instead of an array.
See bug 562448 for details on the change described above.

Description

You can assign a different this object when calling an existing function. this refers to the current object, the calling object. With apply, you can write a method once and then inherit it in another object, without having to rewrite the method for the new object.

apply is very similar to call, except for the type of arguments it supports. You can use an arguments array instead of a named set of parameters. With apply, you can use an array literal, for example, fun.apply(this, ['eat', 'bananas']), or an Array object, for example, fun.apply(this, new Array('eat', 'bananas')).

You can also use arguments for the argsArray parameter. arguments is a local variable of a function. It can be used for all unspecified arguments of the called object. Thus, you do not have to know the arguments of the called object when you use the apply method. You can use arguments to pass all the arguments to the called object. The called object is then responsible for handling the arguments.

Since ECMAScript 5th Edition you can also use any kind of object which is array like, so in practice this means it's going to have a property length and integer properties in the range [0...length). As an example you can now use a NodeList or a own custom object like {'length': 2, '0': 'eat', '1': 'bananas'}.

Note: Most browsers, including Chrome 14 and Internet Explorer 9, still do not accept array like objects and will throw an exception.
Examples

Using apply to chain constructors

You can use apply to chain constructors for an object, similar to Java. In the following example we will create a global Function method called construct, which will make you able to use an array-like object with a constructor instead of an arguments list.

1
2
3
4
5
Function.prototype.construct = function (aArgs) {
    var fConstructor = this, fNewConstr = function () { fConstructor.apply(this, aArgs); };
    fNewConstr.prototype = fConstructor.prototype;
    return new fNewConstr();
};
Example usage:

1
2
3
4
5
6
7
8
9
10
11
12
function MyConstructor () {
    for (var nProp = 0; nProp < arguments.length; nProp++) {
        this["property" + nProp] = arguments[nProp];
    }
}
 
var myArray = [4, "Hello world!", false];
var myInstance = MyConstructor.construct(myArray);
 
alert(myInstance.property1); // alerts "Hello world!"
alert(myInstance instanceof MyConstructor); // alerts "true"
alert(myInstance.constructor); // alerts "MyConstructor"
Note: This non-native Function.construct method will not work with some native constructors (like Date, for example). In these cases you have to use the Function.bind method (for example, imagine to have an array like the following, to be used with Date constructor: [2012, 11, 4]; in this case you have to write something like: new (Function.prototype.bind.apply(Date, [null].concat([2012, 11, 4])))() – anyhow this is not the best way to do things and probably should not be used in any production environment).
apply and built-in functions

Clever usage of apply allows you to use built-ins functions for some tasks that otherwise probably would have been written by looping over the array values. As an example here we are going to use Math.max/Math.min to find out the maximum/minimum value in an array.

1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
/* min/max number in an array */
var numbers = [5, 6, 2, 3, 7];
 
/* using Math.min/Math.max apply */
var max = Math.max.apply(null, numbers); /* This about equal to Math.max(numbers[0], ...) or Math.max(5, 6, ..) */
var min = Math.min.apply(null, numbers);
 
/* vs. simple loop based algorithm */
max = -Infinity, min = +Infinity;
 
for (var i = 0; i < numbers.length; i++) {
  if (numbers[i] > max)
    max = numbers[i];
  if (numbers[i] < min) 
    min = numbers[i];
}
But beware: in using apply this way, you run the risk of exceeding the JavaScript engine's argument length limit. The consequences of applying a function with too many arguments (think more than tens of thousands of arguments) vary across engines (JavaScriptCore has hard-coded argument limit of 65536), because the limit (indeed even the nature of any excessively-large-stack behavior) is unspecified. Some engines will throw an exception. More perniciously, others will arbitrarily limit the number of arguments actually passed to the applied function. (To illustrate this latter case: if such an engine had a limit of four arguments [actual limits are of course significantly higher], it would be as if the arguments 5, 6, 2, 3 had been passed to apply in the examples above, rather than the full array.) If your value array might grow into the tens of thousands, use a hybrid strategy: apply your function to chunks of the array at a time:

1
2
3
4
5
6
7
8
9
10
11
12
13
function minOfArray(arr) {
  var min = Infinity;
  var QUANTUM = 32768;
 
  for (var i = 0, len = arr.length; i < len; i += QUANTUM) {
    var submin = Math.min.apply(null, arr.slice(i, Math.min(i + QUANTUM, len)));
    min = Math.min(submin, min);
  }
 
  return min;
}
 
var min = minOfArray([5, 6, 2, 3, 7]);
See also

call, bind, arguments
TAGS (2)
apply  JavaScript
Contributors to this page: fusionchess, jswisher, himoundary, ronin712, user01, evilpie, rwaldron, Napotopia, techlivezheng, Sheppy, CristianTincu, qw3n, Nickolay, cronco, mattcg, Waldo, Inimino, AllenZ, kswedberg, anthonyryan1, PaulNovitski, wormboy, tiangolo, .void., Dexbol, Jackytck, Paul Visco1, nobuoka, ethertank, Mgjbot, tehsis, Maian, Dria 
Last updated by: techlivezheng, Apr 6, 2013 6:21:12 AM 
Last reviewed by: techlivezheng, Apr 6, 2013 6:21:12 AM
Is MDN helpful to you? Please share your feedback with us. Or join our mailing list about improving MDN content.


© 2005 - 2013 Mozilla Developer Network and individual contributors
Content is available under these licenses • About MDN • Contribute to the code • Privacy Policy
Other languages:  