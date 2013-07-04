//Custom objects:

In classic Object Oriented Programming, objects are collections of data and methods that operate on that data. 
JavaScript is a prototype-based language which contains no class statement, such as is found in C++ or Java. 
(This is sometimes confusing for programmers accustomed to languages with a class statement.) Instead, JavaScript 
uses functions as classes. Lets consider a person object with first and last name fields. 
There are two ways in which the name might be displayed: as "first last" or as "last, first". Using the functions 
and objects that weve discussed previously, heres one way of doing it:

Note: An object property name can be any valid JavaScript string, or anything that can be converted to a string, 
including the empty string.

Ways of creating Objects:
1) Object literal notation; no constructor is invoked for built-in types(eg., array literal notation,[])
    - can be returned by object Factory
2) Constructor function; using both this and new, functionName.prototype available
3) Object.create(prototype)

<---------------------- Using Factory Functions -------------------->


//Functions in global namespace - Using functions as classes, eg., here makePerson is a class
function makePerson(first, last) {
    return {
        first: first,
        last: last
    }
}
function personFullName(person) {
    return person.first + ' ' + person.last;
}
function personFullNameReversed(person) {
    return person.last + ', ' + person.first
}
> s = makePerson("Simon", "Willison");
> personFullName(s)
Simon Willison
> personFullNameReversed(s)
Willison, Simon

Note: This works, but its pretty ugly. You end up with dozens of functions in your global namespace. 
What we really need is a way to attach a function to an object. Since functions are objects, this is easy:

//Attaching a function within an object
function makePerson(first, last) {
    return {
        first: first,
        last: last,
        fullName: function() {
            return this.first + ' ' + this.last;
        },
        fullNameReversed: function() {
            return this.last + ', ' + this.first;
        }
    }
}

Note: Here each object has its own copy of each method.
> s = makePerson("Simon", "Willison")
> s.fullName()
Simon Willison
> s.fullNameReversed()
Willison, Simon


//'this' keyword:
 Used inside a function, 'this' refers to the  current object. What that actually means is specified by the way 
 in which you called that function. 
If you called it using dot notation or bracket notation on an object, that object becomes 'this'. 
If dot notation wasnt used for the call, 'this' refers to the global object. This is a frequent cause of mistakes. 
For example:

> s = makePerson("Simon", "Willison")
> var fullName = s.fullName;
> fullName()
undefined undefined

When we call fullName(), 'this' is bound to the global object. Since there are no global variables called 
first or last we get undefined for each one.



<---------------------  Using Constructor Functions  ------------------------>
//Functions that are designed to be called by 'new' are called constructor functions. 
//''new returns this.''
//Note: Once Object is instantiated, modifying its ConstructorFunctionName.prototype does not affect it.
//But newly instantiated Objects are affected.


We can take advantage of the 'this' keyword to improve our makePerson function:

function Person(first, last) {
    this.first = first;
    this.last = last;
    this.fullName = function() {
        return this.first + ' ' + this.last;
    }
    this.fullNameReversed = function() {
        return this.last + ', ' + this.first;
    }
}
var s = new Person("Simon", "Willison");

//keyword: 'new' 
new is strongly related to 'this'. What it does is it creates a brand new  empty object, and then calls the 
function specified, with 'this' set to that new object. Functions that are designed to be called by 'new' are 
called constructor functions. 
Common practise is to capitalise these functions as a reminder to call them with new.

Our person objects are getting better, but there are still some ugly edges to them. Every time we create a person 
object we are creating two brand new function objects within it — wouldnt it be better if this code was shared?

function personFullName() {
    return this.first + ' ' + this.last;
}
function personFullNameReversed() {
    return this.last + ', ' + this.first;
}


//Best Constructor form
function Person(first, last) {
    this.first = first;
    this.last = last;
    this.fullName = personFullName;
    this.fullNameReversed = personFullNameReversed;
}
Thats better: we are creating the method functions only once, and assigning references to them inside the 
constructor. Can we do any better than that? The answer is yes:

//Best Constructor form - using prototype
function Person(first, last) {
    this.first = first;
    this.last = last;
}
Person.prototype.fullName = function() {
    return this.first + ' ' + this.last;
}
Person.prototype.fullNameReversed = function() {
    return this.last + ', ' + this.first;
}
Person.prototype is an object shared by all instances of Person. It forms part of a lookup chain 
(that has a special name, "prototype chain"): any time you attempt to access a property of Person that isnt set, 
JavaScript will check Person.prototype to see if that property exists there instead. As a result, anything 
assigned to Person.prototype becomes available to all instances of that constructor via the this object.

This is an incredibly powerful tool. JavaScript lets you modify somethings prototype at any time in your program, 
which means you can add extra methods to existing objects at runtime:

> s = new Person("Simon", "Willison");
> s.firstNameCaps();
TypeError on line 1: s.firstNameCaps is not a function
> Person.prototype.firstNameCaps = function() {
    return this.first.toUpperCase()
}
> s.firstNameCaps()
SIMON
Interestingly, you can also add things to the prototype of built-in JavaScript objects. Lets add a method to 
String that returns that string in reverse:

> var s = "Simon";
> s.reversed()
TypeError on line 1: s.reversed is not a function
> String.prototype.reversed = function() {
    var r = "";
    for (var i = this.length - 1; i >= 0; i--) {
        r += this[i];
    }
    return r;
}
> s.reversed()
nomiS
Our new method even works on string literals!

> "This can now be reversed".reversed()
desrever eb won nac sihT
As I mentioned before, the prototype forms part of a chain. The root of that chain is Object.prototype, 
whose methods include toString() — it is this method that is called when you try to represent an object as a string. 
This is useful for debugging our Person objects:

> var s = new Person("Simon", "Willison");
> s
[object Object]
> Person.prototype.toString = function() {
    return '<Person: ' + this.fullName() + '>';
}
> s
<Person: Simon Willison>
Remember how avg.apply() had a null first argument? We can revisit that now. The first argument to apply() is the 
object that should be treated as 'this'. For example, heres a trivial implementation of 'new':

function trivialNew(constructor) {
    var o = {}; // Create an object
    constructor.apply(o, arguments);
    return o;
}
This isnt an exact replica of new as it doesnt set up the prototype chain. apply() (it would be difficult to 
illustrate). This is not something you use very often, but its useful to know about.

apply() has a sister function named call, which again lets you set 'this' but takes an expanded argument list 
as opposed to an array.

function lastNameCaps() {
    return this.last.toUpperCase();
}
var s = new Person("Simon", "Willison");
lastNameCaps.call(s);
// Is the same as:
s.lastNameCaps = lastNameCaps;
s.lastNameCaps();



<---------------------------    Mozilla Dev Network  --------------->


JavaScript is designed on a simple object-based paradigm. An object is a collection of properties, and a property 
is an association between a name and a value. A value of property can be a function, which is then known as the 
objects method. In addition to objects that are predefined in the browser, you can define your own objects.

This chapter describes how to use objects, properties, functions, and methods, and how to create your own objects.

//Objects overview

Objects in JavaScript, just as many other programming languages, can be compared to objects in real life. 
The concept of objects in JavaScript can be understood with real life, tangible objects.

In JavaScript, an object is a standalone entity, with properties and type. Compare it with a cup for example. 
A cup is an object, with properties. A cup has a colour, a design, weight, a material it is made of, etc. 
The same way, JavaScript objects can have properties, which define their characteristics.

Objects and properties

A JavaScript object has properties associated with it. A property of an object can be explained as a variable 
that is attached to the object. Object properties are basically the same as ordinary JavaScript variables, 
except for the attachment to objects. The properties of an object define the characteristics of the object. 
You access the properties of an object with a simple dot-notation:
objectName.propertyName
Like all JavaScript variables, both the object name (which could be a normal variable) and property name are 
case sensitive. You can define a property by assigning it a value. For example, lets create an object named myCar 
and give it properties named make, model, and year as follows:

var myCar = new Object();
myCar.make = "Ford";
myCar.model = "Mustang";
myCar.year = 1969;
Properties of JavaScript objects can also be accessed or set using a bracket notation. 
Objects are sometimes called associative arrays, since each property is associated with a string value that can be 
used to access it. So, for example, you could access the properties of the myCar object as follows:

myCar["make"] = "Ford";
myCar["model"] = "Mustang";
myCar["year"] = 1969;
An object property name can be any valid JavaScript string, or anything that can be converted to a string, 
including the empty string. However, any property name that is not a valid JavaScript identifier 
(for example, a property name that has space or dash, or starts with a number) can only be accessed using 
the square bracket notation. This notation is also very useful when property names are to be dynamically determined 
(when the property name is not determined until runtime). Examples are as follows:

var myObj = new Object(),
    str = "myString",
    rand = Math.random(),
    obj = new Object();
 
myObj.type              = "Dot syntax";
myObj["date created"]   = "String with space";
myObj[str]              = "String value";
myObj[rand]             = "Random Number";
myObj[obj]              = "Object";
myObj[""]               = "Even an empty string";
 
console.log(myObj);
You can also access properties by using a string value that is stored in a variable:

var propertyName = "make";
myCar[propertyName] = "Ford";
 
propertyName = "model";
myCar[propertyName] = "Mustang";
You can use the bracket notation with for...in to iterate over all the enumerable properties of an object. 
To illustrate how this works, the following function displays the properties of the object when you pass the object 
and the objects name as arguments to the function:

function showProps(obj, objName) {
  var result = "";
  for (var i in obj) {
    if (obj.hasOwnProperty(i)) {
        result += objName + "." + i + " = " + obj[i] + "\n";
    }
  }
  return result;
}
So, the function call showProps(myCar, "myCar") would return the following:

myCar.make = Ford
myCar.model = Mustang
myCar.year = 1969

//Object everything

In JavaScript, almost everything is an object. All primitive types except null and undefined are treated as objects. 
They can be assigned properties (assigned properties of some types are not persistent), and they have all 
characteristics of objects.

//Enumerating all properties of an object

Starting with ECMAScript 5, there are three native ways to list/traverse object properties:

for...in loops
This method traverses all enumerable properties of an object and its prototype chain
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
This can be useful to reveal "hidden" properties (properties in the prototype chain which are not accessible 
    through the object, because another property has the same name earlier in the prototype chain). 
Listing accessible properties only can easily be done by removing duplicates in the array.

//Creating new objects

JavaScript has a number of predefined objects. In addition, you can create your own objects. In JavaScript 1.2 
and later, you can create an object using an object initializer. Alternatively, you can first create a 
constructor function and then instantiate an object using that function and the new operator.

//Using object initializers

In addition to creating objects using a constructor function, you can create objects using an object initializer. 
Using object initializers is sometimes referred to as creating objects with literal notation. 
"Object initializer" is consistent with the terminology used by C++.

The syntax for an object using an object initializer is:

var obj = { property_1:   value_1,   // property_# may be an identifier...
            2:            value_2,   // or a number...
            // ...,
            "property n": value_n }; // or a string
where obj is the name of the new object, each property_i is an identifier 
(either a name, a number, or a string literal), and each value_i is an expression whose value is assigned to 
the property_i. The obj and assignment is optional; 
if you do not need to refer to this object elsewhere, you do not need to assign it to a variable. 
    (Note that you may need to wrap the object literal in parentheses if the object appears where a statement 
        is expected, so as not to have the literal be confused with a block statement.)

If an object is created with an object initializer in a top-level script, JavaScript interprets the object each 
time it evaluates an expression containing the object literal. In addition, an initializer used in a function 
is created each time the function is called.

The following statement creates an object and assigns it to the variable x if and only if the expression cond is 
true.

if (cond) var x = {hi: "there"};
The following example creates myHonda with three properties. Note that the engine property is also an object 
with its own properties.

var myHonda = {color: "red", wheels: 4, engine: {cylinders: 4, size: 2.2}};
You can also use object initializers to create arrays. See array literals.

In JavaScript 1.1 and earlier, you cannot use object initializers. You can create objects only using their 
constructor functions or using a function supplied by some other object for that purpose. 

//Using a constructor function

Alternatively, you can create an object with these two steps:

Define the object type by writing a constructor function. There is a strong convention, with good reason, 
to use a capital initial letter.
Create an instance of the object with new.
To define an object type, create a function for the object type that specifies its name, properties, and methods. 
For example, suppose you want to create an object type for cars. You want this type of object to be called car, 
and you want it to have properties for make, model, and year. To do this, you would write the following function:

function Car(make, model, year) {
  this.make = make;
  this.model = model;
  this.year = year;
}
Notice the use of 'this' to assign values to the objects properties based on the values passed to the function.

Now you can create an object called mycar as follows:

var mycar = new Car("Eagle", "Talon TSi", 1993);
This statement creates mycar and assigns it the specified values for its properties. 
Then the value of mycar.make is the string "Eagle", mycar.year is the integer 1993, and so on.

You can create any number of car objects by calls to new. For example,

var kenscar = new Car("Nissan", "300ZX", 1992);
var vpgscar = new Car("Mazda", "Miata", 1990);
An object can have a property that is itself another object. For example, suppose you define an object called 
person as follows:

function Person(name, age, sex) {
  this.name = name;
  this.age = age;
  this.sex = sex;
}
and then instantiate two new person objects as follows:

var rand = new Person("Rand McKinnon", 33, "M");
var ken = new Person("Ken Jones", 39, "M");
Then, you can rewrite the definition of car to include an owner property that takes a person object, as follows:

6
function Car(make, model, year, owner) {
  this.make = make;
  this.model = model;
  this.year = year;
  this.owner = owner;
}
To instantiate the new objects, you then use the following:

var car1 = new Car("Eagle", "Talon TSi", 1993, rand);
var car2 = new Car("Nissan", "300ZX", 1992, ken);
Notice that instead of passing a literal string or integer value when creating the new objects, 
the above statements pass the objects rand and ken as the arguments for the owners. 
Then if you want to find out the name of the owner of car2, you can access the following property:

car2.owner.name
Note that you can always add a property to a previously defined object. For example, the statement

car1.color = "black";
adds a property color to car1, and assigns it a value of "black." However, this does not affect any other objects. To add the new property to all objects of the same type, you have to add the property to the definition of the car object type.

//Using the Object.create method

Objects can also be created using the Object.create method. This method can be very useful, because it allows you to 
choose the prototype object for the object you want to create, without having to define a constructor function. 
For more detailed information on the method and how to use it, see Object.create method.

                    

//Object.create

Creates a new object with the specified prototype object and properties.

Method of Object
Implemented in  JavaScript 1.8.5
ECMAScript Edition  ECMAScript 5th Edition
Syntax

Object.create(proto [, propertiesObject ])

//Parameters
proto
    The object which should be the prototype of the newly-created object.
propertiesObject
    If specified and not undefined, an object whose enumerable own properties (that is, those properties defined 
    upon itself and not enumerable properties along its prototype chain) specify property descriptors to be added 
    to the newly-created object, with the corresponding property names.


//Description
Throws a TypeError exception if the proto parameter is not null or an object.

//Examples

Classical inheritance with Object.create

Below is an example of how to use Object.create to achieve classical inheritance. This is for single inheritance, 
which is all that Javascript supports.

//Shape - superclass
function Shape() {
  this.x = 0;
  this.y = 0;
}
 
//superclass method
Shape.prototype.move = function(x, y) {
    this.x += x;
    this.y += y;
    console.info("Shape moved.");
};
 
// Rectangle - subclass
function Rectangle() {
  Shape.call(this); //call super constructor.
}
 
//subclass extends superclass
Rectangle.prototype = Object.create(Shape.prototype);
Rectangle.prototype.constructor = Rectangle;
 
var rect = new Rectangle();
 
rect instanceof Rectangle //true.
rect instanceof Shape //true.
 
rect.move(1, 1); //Outputs, "Shape moved."

If you wish to inherit from multiple objects, then mixins are a possibility.

function MyClass() {
     SuperClass.call(this);
     OtherSuperClass.call(this);
}
 
MyClass.prototype = Object.create(SuperClass.prototype); //inherit
mixin(MyClass.prototype, OtherSuperClass.prototype); //mixin
 
MyClass.prototype.myMethod = function() {
     // do a thing
};
The mixin function would copy the functions from the superclass prototype to the subclass prototype, the mixin 
function needs to be supplied by the user. An example of a mixin like function would be jQuery.extend.

Using <propertiesObject> argument with Object.create

var o;
 
// create an object with null as prototype
o = Object.create(null);
 
 
o = {};
// is equivalent to:
o = Object.create(Object.prototype);
 
 
// Example where we create an object with a couple of sample properties.
// (Note that the second parameter maps keys to *property descriptors*.)
o = Object.create(Object.prototype, {
  // foo is a regular "value property"
  foo: { writable:true, configurable:true, value: "hello" },
  // bar is a getter-and-setter (accessor) property
  bar: {
    configurable: false,
    get: function() { return 10 },
    set: function(value) { console.log("Setting `o.bar` to", value) }
}});
 
 
function Constructor(){}
o = new Constructor();
// is equivalent to:
o = Object.create(Constructor.prototype);
// Of course, if there is actual initialization code in the Constructor function, the Object.create cannot reflect it
 
 
// create a new object whose prototype is a new, empty object
// and a adding single property 'p', with value 42
o = Object.create({}, { p: { value: 42 } })
 
// by default properties ARE NOT writable, enumerable or configurable:
o.p = 24
o.p
//42
 
o.q = 12
for (var prop in o) {
   console.log(prop)
}
//"q"
 
delete o.p
//false
 
//to specify an ES3 property
o2 = Object.create({}, { p: { value: 42, writable: true, enumerable: true, configurable: true } });