Constructors

When you create a new instance (a new object) of a (class) using the new keyword, a constructor for that (class) is 
called. 
Constructors are used to initialize the instance variables (fields) of an object. 
Constructors are similar to methods, but with some important differences. 
Constructor name is (class) name. A constructors must have the same name as the (class) its in.

//Default constructor. 
If you dont define a constructor for a (class), a default parameterless constructor is 
automatically created by the compiler. The default constructor calls the default parent constructor (super()) 
and initializes all instance variables to default value (zero for numeric types, null for object references, 
and false for booleans).

Default constructor is created only if there are no constructors. If you define any constructor for your (class), 
no default constructor is automatically created.

//Differences between methods and constructors. 
There is no return type given in a constructor signature (header). The value is this object itself so there is no 
need to indicate a return value. 
There is no return statement in the body of the constructor. 
The first line of a constructor must either be a call on another constructor in the same (class) (using this), 
or a call on the super(class) constructor (using super). 
If the first line is neither of these, the compiler automatically inserts a call to the parameterless super 
(class) constructor. 

These differences in syntax between a constructor and method are sometimes hard to see when looking at the source. 
It would have been better to have had a keyword to clearly mark constructors as some languages do. 
this(...) - Calls another constructor in same (class). Often a constructor with few parameters will call a 
constructor with more parameters, giving default values for the missing parameters. 
Use this to call other constructors in the same (class). 


//super(...): 
Use super to call a constructor in a parent (class). Calling the constructor for the super(class) 
must be the first statement in the body of a constructor. If you are satisfied with the default constructor 
in the super(class), there is no need to make a call to it because it will be supplied automatically. 

//Example of explicit this constructor call
public class Point {
    int m_x;
    int m_y;

    //============ Constructor
    public Point(int x, int y) {
        m_x = x;
        m_y = y;
    }

    //============ Parameterless default constructor
    public Point() {
        this(0, 0);  // Calls other constructor.
    }
    . . .
}
super(...) - The super(class) (parent) constructor

An object has the fields of its own (class) plus all fields of its parent (class), grandparent (class), 
all the way up to the root (class) Object. Its necessary to initialize all fields, therefore all constructors must 
be called! 
The Java compiler automatically inserts the necessary constructor calls in the process of constructor chaining, 
or you can do it explicitly. 

The Java compiler inserts a call to the parent constructor (super) if you dont have a constructor call as the first 
atement of you constructor. The following is the equivalent of the constuctor above. 
    //============ Constructor (same as in above example)
    public Point(int x, int y) {
        super();  // Automatically done if you don't call constructor here.
        m_x = x;
        m_y = y;
    }

//<--------------------     Why you might want to call super explicitly?    ------------------------>

Normally, you wont need to call the constructor for your parent (class) because its automatically generated, 
but there are two cases where this is necessary. 
You want to call a parent constructor which has parameters (the automatically generated super constructor call has 
no parameters). 
There is no parameterless parent constructor because only constructors with parameters are defined in the parent 
(class)