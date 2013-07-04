Inheritance revisited

Inheritance has always been available in JavaScript, but the examples on this page use some methods introduced in 
ECMAScript 5. See the different method pages to see if they can be emulated.

//Example

B shall inherit from A:

function A(a){
  this.varA = a;
}
 
A.prototype = {
  varA : null,
  doSomething : function(){
    // ...
  }
}
 
function B(a, b){
  A.call(this, a);
  this.varB = b;
}
B.prototype = Object.create(A.prototype, {
  varB : {
    value: null, 
    enumerable: true, 
    configurable: true, 
    writable: true
  },
  doSomething : { 
    value: function(){ // override
      A.prototype.doSomething.apply(this, arguments); // call super
      // ...
    },
    enumerable: true,
    configurable: true, 
    writable: true
  }
});
 
var b = new B();
b.doSomething();
The important parts are:

Types are defined in .prototype
You use Object.create() to inherit
prototype and Object.getPrototypeOf

JavaScript is a bit confusing for developers coming from Java or C++, as its all dynamic, all runtime, and it has no 
classes at all. Its all just instances (objects). Even the "classes" we simulate are just a function object.

You probably already noticed that our function A has a special property called prototype. This special property works with the JavaScript new operator. The reference to the prototype object is copied to the internal [[Prototype]] property of the new instance. For example, when you do var a1 = new A(), JavaScript (after creating the object in memory and before running function A() with this defined to it) sets a1.[[Prototype]] = A.prototype. When you then access properties of the instance, JavaScript first checks whether they exist on that object directly, and if not, it looks in [[Prototype]]. This means that all the stuff you define in prototype is effectively shared by all instances, and you can even later change parts of prototype and have the changes appear in all existing instances, if you wanted to.

If, in the example above, you do var a1 = new A(); var a2 = new A(); then a1.doSomething would actually refer to Object.getPrototypeOf(a1).doSomething, which is the same as the A.prototype.doSomething you defined, i.e. Object.getPrototypeOf(a1).doSomething == Object.getPrototypeOf(a2).doSomething == A.prototype.doSomething.

In short, prototype is for types, while Object.getPrototypeOf() is the same for instances.

[[Prototype]] is looked at recursively, i.e. a1.doSomething, Object.getPrototypeOf(a1).doSomething, 
Object.getPrototypeOf(Object.getPrototypeOf(a1)).doSomething etc., until its found or Object.getPrototypeOf returns 
null.

So, when you call

var o = new Foo();
JavaScript actually just does

var o = new Object();
o.[[Prototype]] = Foo.prototype;
o.Foo();
(or something like that) and when you later do

o.someProp;
it checks whether o has a property someProp. If not it checks Object.getPrototypeOf(o).someProp and if that doesnot 
exist it checks Object.getPrototypeOf(Object.getPrototypeOf(o)).someProp and so on.
