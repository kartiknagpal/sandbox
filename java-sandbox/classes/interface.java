Java: Interfaces

An (interface) is a list of methods that must be defined by any (class) which implements that (interface). 
It may also define constants (public static final).

Similar to abstract (class). An (interface) is similar to a (class) without instance and static variables 
(static final constants are allowed), and without method bodies. This is essentially what a completely abstract 
(class) does, but abstract (class)es do allow static method definitions, and (interface)s donot.

//Contractual obligation. 
When a (class) specifies that it implements an (interface), it must define all methods of that (interface). 
A (class) can implement many different (interface)s. If a (class) doesnot define all methods of the (interface)s 
it agreed to define (by the implements clause), the compiler gives an error message, which typically says something 
like "This (class) must be declared abstract". An abstract (class) is one that doesnot implement all methods it said 
it would. The solution to this is almost always to implement the missing methods of the (interface). 
A misspelled method name or incorrect parameter list is the usual cause, not that it should have been abstract! 

A very common use of (interface)s is for listeners. A listener is an object from a (class) that implements the 
required methods for that (interface). You can create anonymous inner listeners, or implement the required 
(interface) in any (class). 

Interfaces are also used extensively in the data structures (Java Collections) package.


//Classes versus Interfaces:

Classes are used to represent something that has attributes (variables, fields) and capabilities/responsibilities 
(methods, functions). Interfaces are only about capabilities. For example, you are a human because you have the 
attributes of a human ((class)). You are a plumber because you have the ability of a plumber ((interface)). 
You can also be an electrician ((interface)). You can implement many (interface)s, but be only one (class). 

This analogy fails in one way however. Capabilities (methods) of a (class) are unchanging (if a (class) implements 
    an (interface), it is implemented for all instances), whereas the human skills we are talking about are dynamic 
and can be learned or forgotten. The analogy is flawed, as all analogies are, but it gives some idea of a 
distinction between (class)es and (interface)s. 


//Interfaces replace multiple inheritance:

Simpler. A C++ (class) can have more than one parent (class). This is called multiple inheritance. 
Managing instance variable definitions in multiple inheritance can be really messy, and leads to more problems 
(eg, the "Deadly Diamond of Death") than solutions. For this reason Java designers chose to allow only one parent 
(class), but allow multiple (interface)s. This provides most of the useful functionality of multiple inheritance, 
but without the difficulties. 


//Implementing an Interface:

You may implement as many (interface)s in a (class) as you wish; just separate them with commas. 
For example,
// Note: 
//   ActionListener requires defining actionPerformed(...)
//   MouseMotionListener requires defining mouseMoved(...) and mouseDragged(...).

public class MyPanel extends JPanel implements ActionListener, MouseMotionListener {
    public void actionPerformed(ActionEvent e) {
        /* Method body */
    }
    public void mouseDragged(MouseEvent me) {
        /* Method body */
    }
    public void mouseMoved(MouseEvent me) {
        /* Method body */
    }
    // Everything else in this (class).
}

It is common for a panel that does graphics and responds to the mouse to implement its own mouse listeners 
(but not action listeners) as above.


//Declaring an (interface):

For simple programs you are more likely to use an (interface) than define it. Here is what the 
java.awt.event.ActionListener (interface) definition looks something like the following.
public (interface) ActionListener {
      public void actionPerformed(ActionEvent e);
}


//Tagging Interfaces:

Java defines a few (interface)s that are just used as a boolean property of a (class), but donot actually require 
the implemenation of any methods. These are called tagging (interface)s. 

Tagging (interface)s are an abuse of the (interface) principle, but Java makes use of object-oriented features to 
solve all problems if possible, rather than invent a more appropriate feature. 

Common tagging (interface)s that you might see are:
Cloneable:
	Implementing this (interface) indicates that the (class) has overridden Objects clone() method. 
    But there is no check that this is true, and because sub(class)es inherit (interface)s, it will look like all 
    sub(class)es have defined clone() altho that is not necessarily true. 
    Yes, this is not the normal spelling of the English word. ??? Why needed. 
Serializable:
	This tagging (interface) indicates that a (class) can serialized - that an object of this (class) can be written 
    out and read back in using ???. This can be useful for short-term storage of objects, but should not be used 
    for long-term storage because any change to the (class) definition makes that persistent copy unreadable!