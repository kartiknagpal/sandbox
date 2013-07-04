Java: OOP Summary

//Objects:
All objects are allocated on the heap.
Objects consist of instance fields for the ((class)) of the object, plus instance fields for its super(class)es.
Every object is created by a ((class)) constructor. Interfaces dont have constructors.

//Reference variables:
All non-primitive variables contain only references to objects on the heap. They never contain the object. 
C++ object variables may be either, but Java supports only object references. 

//Assignment:
Reference variable assignment is fast because only the reference is copied (currently 4 bytes).
Making a copy of an object requires using clone().
Assigning up the inheritance hierarchy is always possible without a cast. (is-a is obvious)
Assigning down the inheritance hierarchy is only possible with a cast. Downcasting makes a run-time check to be sure 
its legal. (is-a is possible)
Assignment to an ((interface)) type variable from a reference type (implements) that (interface) is possible without 
a cast. (is-a is obvious).
Assignment to an (interface) type variable from a reference type that does not implement that (interface) requires 
an explicit cast which causes a run-time check to make sure that the objects (class) really does implement this 
(interface). (is-a is possible)
null can be assigned to any reference type.

//Inheritance and (interface)s:
Every (class) has one super(class), except Object, which is the root (class) for all other (class)es.
A (class) may implement many (interface)s, but extend only one (class).

//Overriding and polymorphism:
Methods (non-final) may be redefined in a sub(class).
The @Override annotation provides compiler checking.
Polymorphism: When a method is called, the overridden method corresponding to the actual object type is called, 
regardless of reference variable type. 

//Generics:
Generics add compile-time checking and documentation.
Java uses type erasure so generic types are actually implmented as Object.

//Terminology:
Super(class) - sub(class). Parent (class) - child (class). Base (class) - derived (class).
Overloading is reusing method names with different parameters.

//Interfaces:
Interfaces list methods that implementing (class)es must define.
Interfaces have no constructors.

//Static variables:
There is only one copy of a static variable, not one per object.

//Constructors:
A default no-parameter constructor is created automatically when no constructor is defined.
If you define any constructor, no default constructor is created.
Constructor chaining. The first statement of a constructor is either a call to another constructor in the same 
(class) using this, or a call to the super (class) constructor using super. If not called explicitly, a call to 
the no-parameter super constructor is inserted by the compiler. 

//Inner (class)es:
A (class) that is defined inside another (class) is called an inner (class). There are four kinds of inner (class)es, 
but only two are commonly used: named inner (class)es, which are members of the outer (class), and anonymous inner 
(class)es which are created in a code block (eg, in a method).
Typical use: An inner (class) is commonly used for listeners, comparators, and other (interface) implementations as 
 easy way to provide an object with the required methods.
Advantage: An inner (class) can access the outer (class)s instance variable. For example, this lets an inner (class) 
button listener refer to GUI text fields, etc. 
Two common kinds: named inner (class)es, and anonymous inner (class)es.
Named inner (class)es: 
	Defined within the outer (class).
	May extend any (class).
	May implement many (interface)s.
	May have constructors like any normal (class).
	May reference the enclosing (class)es instance variables.
Anonymous inner (class)es: 
	Defined inside a method.
	Sub(class) of Object.
	Implement exactly one (interface).
	Are instantiated at the point of definition.
	No constructor.
	Have names created by the compiler. Usually have a $ in them.

//Casting:
Casting an object reference is necessary when the compiler cant tell that the actual object is of the needed type. 
The cast creates a runtime check to make sure. There are two cases where a cast is required: 
To cast down the inheritance hierarchy. For example, 
  Object ob = "abc";      // No cast needed to assign up hierarchy.
  String s = ob;          // BAD. Requires a cast
  String s = (String)ob;  // Required.

All Strings are Objects, but not all Objects are Strings.
To cast from an (interface) type to a (class) type. (String implements Comparable) 
  Comparable com = "def"; // No cast to assign to implemented (interface)
  String s = com;         // BAD. Requires a cast.
  String s = (String)com; // Required.

All Strings are Comparables, but not all Comparables are Strings.