Java Notes: Variables

Variables are places in memory to store values. There are different kinds of variables, and every language offers 
slightly different characteristics. 

Name. 

Data Type specifies the kinds of data a variable an store. Java has two general kinds of data types. 
8 basic or primitive types (byte, short, int, long, float, double, char, boolean). 
An unlimited number of object types (String, Color, JButton, ...). 


//< ------------------------------------------------------------------------------------------------------->

Java object variables hold a reference (pointer) to the the object, not the object, 
which is always stored on the heap. 

//< -------------------------------------------------------------------------------------------------------->

Scope of a variable is who can see it. The scope of a variable is related program structure: 
eg, block, method, (class), package, child (class). 

Lifetime is the interval between the creation and destruction of a variable. The following is basically how things 
work in Java. Local variables and parameters are created when a method is entered and destroyed when the method 
returns. Instance variables are created by new and destroyed when there are no more references to them. 
Class (static) variables are created when the (class) is loaded and destroyed when the program terminates. 

Initial Value. 
What value does a variable have when it is created? There are several possibilites. 
No initial value. Java local variables have no initial value, however Java compilers perform a simple flow analysis 
to ensure that every local variable is assigned a value before it is used. 
These error messages are usually correct, but the analysis is simple-minded, so sometimes you will have to assign 
an initial value even tho you know that it is not necessary. 
User specified initial value. Java allows an assignment of intitial values in the declaration of a variable. 

Instance and static variables are given default initial values: zero for numbers, null for objects, 
and false for booleans. 

Declarations are required. Java, like many languages, requires you to declare variables -- 
tell the compiler the data type, etc. Declarations are good because they help the programmer build more reliable 
and efficient programs. 
Declarations allow the compiler to find places where variables are misused, eg, parameters of the wrong type. 
What is especially good is that these errors are detected at compile time. 
Bugs that make it past the compiler are harder to find, and may not be discovered until the program has been 
released to customers. This fits the fail early, fail often philosophy. 
A declaration is also the perfect place to write comments describing the variable and how it is used. 
Because declarations give the compiler more information, it can generate better code. 


//<----------------     Shadowing this:     ----------------------->


 When an inner (class) refers to this, it refers to the current instance of the inner (class). 
 To refer to the instance of the outer (class) from the inner (class), this must be qualified by the name of the 
 outer (class). 
Example of referring to outer this from inner (class)

class ShadowThis {
    public static void main(String[] args) {
        ShadowThis st = new ShadowThis();
        st.testOuter();
    }//end main
    
    private void testOuter() {
        System.out.println(this);
        InnerShadowThis ist = new InnerShadowThis();
        ist.testInner();
    }//end test
    
    class InnerShadowThis {
        void testInner() {
            System.out.println(this);
            System.out.println(ShadowThis.this);
        }
    }//end class InnerShadowThis
}//end class ShadowThis

 Produces the following output. 
ShadowThis@601bb1
ShadowThis$InnerShadowThis@ea2dfe
ShadowThis@601bb1
Typical usage
 The above example fails to show why referencing an outer this might be used. 
 A common situation is to implement an action listener as an inner (class) of a JPanel. 
 If the listener wants to display a dialog (eg, a JFileChooser), it may tell which component to center the dialog 
 over. The component is exactly the outer this. For example, this is from an inner (class) listener that wants 
 to center a file dialog over the current TestGUI panel. 
int retval = fileChooser.showOpenDialog(TestGUI.this);
 Some IDEs put no code in an inner (class) listener except a call to an outer method to process the action. 
 The same code could be used, but the need to refer to the outer this is no longer necessary.


Local/Instance/Class Variables

There are three kinds of Java variables:
Local variables are declared in a method, constructor, or block. When a method is entered, an area is pushed onto 
the call stack. This area contains slots for each local variable and parameter. When the method is called, 
the parameter slots are initialized to the parameter values. When the method exits, this area is popped off the 
stack and the memory becomes available for the next called method. Parameters are essentially local variables which 
are initialized from the actual parameters. Local variables are not visible outside the method. 
Instance variables are declared in a class, but outside a method. They are also called member or field variables. 
When an object is allocated in the heap, there is a slot in it for each instance variable value. 
Therefore an instance variable is created when an object is created and destroyed when the object is destroyed. 
Visible in all methods and constructors of the defining class, should generally be declared private, but may be 
given greater visibility. 
Class/static variables are declared with the static keyword in a class, but outside a method. There is only one 
copy per class, regardless of how many objects are created from it. They are stored in static memory. 
It is rare to use static variables other than declared final and used as either public or private constants. 


characteristic    Local variable             Instance variable                  Class variable
Where declared    In a method, constructor, 
                  or block.                  In a class, but outside a method.   In a class, but outside a 
                                             Typically private.                  method. Must be declared 
                                                                                 static. Typically also final.
                                                                                             
                                                                        
Use               Local variables hold values  Instance variables hold values that    Class variables are mostly 
                  used in computations in a    method must be referenced by more than  used for constants, variables 
                                               one method. (for example, components   that never change from their 
                                               that hold values like text fields,     initial value.
                                               variables that control drawing, etc), 
                                               or that are essential parts of an objects
                                               state that must exist from one method 
                                               invocation to another.    


Lifetime         Created when method or        Created when instance of (class) is created Created when the program starts.
                 constructor is entered.       with new.Destroyed when there are no more    Destroyed when the program stops.
                Destroyed on exit.             references to enclosing object                  
                                               (made available for garbage collection).
       
 
Scope/Visibility  Local variables 
                  (including formal parameters) 
                  are visible only in the method, 
                  constructor, or block in which 
                  they are declared. Access 
                  modifiers (private, public, ...) 
                  can not be used with local 
                  variables. All local variables 
                  are effectively private to the 
                  block in which they are declared. 
                  No part of the program outside 
                  of the method / block can see 
                  them. A special case is that 
                  local variables declared in the 
                  initializer part of a for 
                  statement have a scope of the 
                  for statement.                    Instance (field) variables 
                                                    can been seen by all methods 
                                                    in the class. Which other classes 
                                                    can see them is determined by 
                                                    their declared access: 
                                                    private should be your default 
                                                    choice in declaring them. 
                                                    No other (class) can see private 
                                                    instance variables. This is 
                                                    regarded as the best choice. 
                                                    Define getter and setter 
                                                    methods if the value has to 
                                                    be gotten or set from outside 
                                                    so that data consistency can 
                                                    be enforced, and to preserve 
                                                    internal representation flexibility.
                                                    Default (also called package visibility) 
                                                    allows a variable to be seen by any 
                                                    (class) in the same package. 
                                                    private is preferable.
                                                    public. Can be seen from any class. 
                                                    Generally a bad idea.
                                                    protected variables are only visible 
                                                    from any descendant classes. 
                                                    Uncommon, and probably a bad choice.    
                                                                                            Same as instance variable, 
                                                                                            but are often declared 
                                                                                            public to make constants 
                                                                                            available to users of the class.
                      


Declaration Declare    before use anywhere in a 
                       method or block.             Declare anywhere at (class) level 
                                                    (before or after use).  
                                                                                            Declare anywhere at 
                                                                                            (class) level with static.
Initial value       None. Must be assigned a 
                    value before the first use.    Zero for numbers, false for booleans, 
                                                    or null for object references. 
                                                    May be assigned value at declaration 
                                                    or in constructor.    
                                                                                            Same as instance variable, 
                                                                                            and it addition can be 
                                                                                            assigned value in special 
                                                                                            static initializer block.
Access from outside Impossible. Local variable 
                    names are known only within 
                    the method.  
                                                    Instance variables should be declared
                                                   private to promote information hiding, 
                                                   so should not be accessed from outside 
                                                   a (class). However, in the few cases 
                                                   where there are accessed from outside 
                                                   the class, they must be qualified by 
                                                   an object (eg, myPoint.x).    
                                                                                            (Class) variables are qualified 
                                                                                            with the (class) name 
                                                                                            (eg, Color.BLUE). 
                                                                                            They can also be qualified with 
                                                                                            an object, but this is a 
                                                                                            deceptive style.

Name syntax     Standard rules.                 Standard rules, but are often prefixed 
                                                to clarify difference from local 
                                                variables, eg with my, m, or m_ (for member) 
                                                as in myLength, or this as in this.length. 
                                                                                            static public final variables 
                                                                                            (constants) are all uppercase, 
                                                                                            otherwise normal naming 
                                                                                            conventions. 
                                                                                            Alternatively prefix the 
                                                                                            variable with "c_" (for class) 
                                                                                            or something similar.