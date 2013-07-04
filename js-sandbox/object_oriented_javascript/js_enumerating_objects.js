Enumerating all properties of an object

Starting with ECMAScript 5, there are three native ways to list/traverse object properties:

//<---------------	for...in loops	--------------------->

Iterates over the enumerable properties of an object, in arbitrary order. For each distinct property, 
statements can be executed.
This method traverses all enumerable properties of an object and its prototype chain.

for (variable in object) {
  ...
}


//Parameters
-variable
	A different property name is assigned to variable on each iteration.
-object
	Object whose enumerable properties are iterated.




Object.keys(o)
This method returns an array with all the own (not in the prototype chain) enumerable properties names ("keys") 
of an object o.

Object.getOwnPropertyNames(o)
This method returns an array containing all own properties names (enumerable or not) of an object o.
In ECMAScript 5, there is no native way to list all properties of an object. However, this can be achieved with 
the following function:

function listAllProperties(o){     
    var objectToInspect;     
    var result = [];
     
    for(objectToInspect = o; objectToInspect !== null; objectToInspect = Object.getPrototypeOf(objectToInspect)){  
        result = result.concat(Object.getOwnPropertyNames(objectToInspect));  
    }
     
    return result; 
}
This can be useful to reveal "hidden" properties (properties in the prototype chain which are not accessible through the object, because another property has the same name earlier in the prototype chain). Listing accessible properties only can easily be done by removing duplicates in the array.




//<---------------	for...in loops	--------------------->

//Description
A for...in loop does not iterate over non–enumerable properties. 
Objects created from built–in constructors like Array and Object have inherited non–enumerable properties from Object.prototype and String.prototype that are not enumerable, such as String's indexOf method or Object's toString method. The loop will iterate over all enumerable properties of the object itself and those the object inherits from its constructor's prototype (properties closer to the object in the prototype chain override prototypes' properties).

A for...in loop iterates over the properties of an object in an arbitrary order. 
If a property is modified in one iteration and then visited at a later time, its value in the loop is its value 
at that later time. A property that is deleted before it has been visited will not be visited later. 
Properties added to the object over which iteration is occurring may either be visited or omitted from iteration. 
In general it is best not to add, modify or remove properties from the object during iteration, 
other than the property currently being visited. There is no guarantee whether or not an added property will be 
visited, whether a modified property (other than the current one) will be visited before or after it is modified, 
or whether a deleted property will be visited before it is deleted.

If you only want to consider properties attached to the object itself, and not its prototypes, 
use getOwnPropertyNames or perform a hasOwnProperty check (propertyIsEnumerable can also be used). 
Alternatively, if you know there wont be any outside code interference, you can extend built-in prototypes with a 
check method.

for..in should not be used to iterate over an Array where index order is important. 
	Array indexes are just enumerable properties with integer names and are otherwise identical to general Object
    properties. There is no guarantee that for...in will return the indexes in any particular order and it will 
    return all enumerable properties, including those with non–integer names and those that are inherited.

Because the order of iteration is implementation dependent, iterating over an array may not visit elements in a 
consistent order. Therefore it is better to use a for loop with a numeric index 
(or Array.forEach or the non-standard for...of loop) when iterating over arrays where the order of access is 
important.

//Examples
The following function takes as its arguments an object and the objects name. It then iterates over all the objects 
enumerable properties and returns a string of the property names and their values.

var o = {a:1, b:2, c:3};
 
function show_props(obj, objName) {
  var result = "";
     
  for (var prop in obj) {
    result += objName + "." + prop + " = " + obj[prop] + "\n";
  }
     
  return result;
}
 
alert(show_props(o, "o")); /* alerts: o.a = 1 o.b = 2 o.c = 3 */

//The following function illustrates the use of hasOwnProperty: the inherited properties are not displayed.

var triangle = {a:1, b:2, c:3};
 
function ColoredTriangle() {
  this.color = "red";
}
 
ColoredTriangle.prototype = triangle;
 
function show_own_props(obj, objName) {
  var result = "";
     
  for (var prop in obj) {
    if( obj.hasOwnProperty( prop ) ) {
      result += objName + "." + prop + " = " + obj[prop] + "\n";
    } 
  }
     
  return result;
}
 
o = new ColoredTriangle();
alert(show_own_props(o, "o")); /* alerts: o.color = red */




//<-------------------	Object.keys	-------------------->
 
Returns an array of a given objects own enumerable properties, in the same order as that provided by a for-in loop 
(the difference being that a for-in loop enumerates properties in the prototype chain as well).

Method of Object
Implemented in	JavaScript 1.8.5
ECMAScript Edition	ECMAScript 5th Edition
Syntax

Object.keys(obj)

//Parameters
obj
	The object whose enumerable own properties are to be returned.



//Description

Object.keys returns an array whose elements are strings corresponding to the enumerable properties found directly 
upon object. The ordering of the properties is the same as that given by looping over the properties of the object 
manually.

//Examples

var arr = ["a", "b", "c"];
alert(Object.keys(arr)); // will alert "0,1,2"
 
// array like object
var obj = { 0 : "a", 1 : "b", 2 : "c"};
alert(Object.keys(obj)); // will alert "0,1,2"
 
// array like object with random key ordering
var an_obj = { 100: "a", 2: "b", 7: "c"};
alert(Object.keys(an_obj)); // will alert "2, 7, 100"
 
// getFoo is property which isn't enumerable
var my_obj = Object.create({}, { getFoo : { value : function () { return this.foo } } });
my_obj.foo = 1;
 
alert(Object.keys(my_obj)); // will alert only foo
If you want all properties, even the not enumerable, see Object.getOwnPropertyNames.