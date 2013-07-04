Inheritance and the prototype chain

JavaScript is a bit confusing for developers experienced in class-based languages (like Java or C++), as it is 
dynamic and does not provide a class implementation (although the keyword class is a reserved keyword and cannot 
  be used as a variable name).

When it comes to inheritance, JavaScript only has one construct: objects. Each object has an internal link to 
another object called its prototype. That prototype object has a prototype of its own, and so on until an object 
is reached with null as its prototype. null, by definition, has no prototype, and acts as the final link in this 
prototype chain.



//<------------------ Inheritance with the prototype chain:  -------------------->


Inheriting properties

JavaScript objects are dynamic "bags" of properties (referred to as own properties) and each one has a link to a 
prototype object. Here is what happens when trying to access a property:

// Let's assume we have an object o with its prototype chain looking like:
// {a:1, b:2} ---> {b:3, c:4} ---> null
// 'a' and 'b' are o own properties.
 
// In this example, someObject.[[Prototype]] will designate the prototype of someObject.
// This is a pure notation (based on the one used in the ECMAScript standard) and cannot be used in scripts
 
console.log(o.a); // 1
// Is there an 'a' own property on o? Yes and its value is 1
 
console.log(o.b); // 2
// Is there a 'b' own property on o? Yes and its value is 2
// The prototype also has a 'b' property, but it's not visited. This is called "property shadowing"
 
console.log(o.c); // 4
// Is there a 'c' own property on o? No, check its prototype
// Is there a 'c' own property on o.[[Prototype]]? Yes, its value is 4
 
console.log(o.d); // undefined
// Is there a 'd' own property on o? No, check its prototype
// Is there a 'd' own property on o.[[Prototype]]? No, check it prototype
// o.[[Prototype]].[[Prototype]] is null, stop searching, no property found, return undefined
Setting a property to an object creates an own property. The only exception to the getting and setting behavior rules is when there is an inherited property with a getter or a setter.

Inheriting "methods"

JavaScript does not have "methods" in the form class-based languages define them. In JavaScript, any function can 
be added to an object in the form of a property. An inherited function acts just as any other property, 
including property shadowing as shown above (in this case, a form of method overriding).

When an inherited function is executed, the value of this points to the inheriting object, not to the prototype 
object where the function is an own property.

var o = {
  a: 2,
  m: function(b){
    return this.a + 1;
  }
};
 
console.log(o.m()); // 3
// When calling o.m in this case, 'this' refers to o
 
var p = Object.create(o);
// p is an object that inherits from o
 
p.a = 12; // creates an own property 'a' on p
console.log(p.m()); // 13
// when p.m is called, 'this' refers to p.
// So when p inherits the function m of o, 'this.a' means p.a, the own property 'a' of p



-> Different ways to create objects and the resulting prototype chain:


//<------------------ Objects created with syntax constructs[literal notation]  ---------------------->

var o = {a: 1};
 
// The newly created object o has Object.prototype as its [[Prototype]]
// o has no own property named 'hasOwnProperty'
// hasOwnProperty is an own property of Object.prototype. So o inherits hasOwnProperty from Object.prototype
// Object.prototype has null as its prototype.
// o ---> Object.prototype ---> null
 
var a = ["yo", "whadup", "?"];
 
// Arrays inherit from Array.prototype (which has methods like indexOf, forEach, etc.).
// The prototype chain looks like:
// a ---> Array.prototype ---> Object.prototype ---> null
 
function f(){
  return 2;
}
 
// Functions inherit from Function.prototype (which has methods like call, bind, etc.):
// f ---> Function.prototype ---> Object.prototype ---> null



//<---------------------- With a constructor:  ------------------------>

A "constructor" in JavaScript is "just" a function that happens to be called with the new operator.

function Graph() {
  this.vertexes = [];
  this.edges = [];
}
 
Graph.prototype = {
  addVertex: function(v){
    this.vertexes.push(v);
  }
};
 
var g = new Graph();
// g is an object with own properties 'vertexes' and 'edges'.
// g.[[Prototype]] is the value of Graph.prototype when new Graph() is executed.



//<---------------------- With Object.create  --------------------------->

ECMAScript 5 introduced a new method: Object.create. Calling this method creates a new object. 
The prototype of this object is the first argument of the function:

var a = {a: 1}; 
// a ---> Object.prototype ---> null
 
var b = Object.create(a);
// b ---> a ---> Object.prototype ---> null
console.log(b.a); // 1 (inherited)
 
var c = Object.create(b);
// c ---> b ---> a ---> Object.prototype ---> null
 
var d = Object.create(null);
// d ---> null
console.log(d.hasOwnProperty); // undefined, because d doesn't inherit from Object.prototype
