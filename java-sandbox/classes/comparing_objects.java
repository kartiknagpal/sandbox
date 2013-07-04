Comparing Object 


//<---------------	references with the == and != Operators:	-------------------->


The two operators that can be used with object references are comparing for equality (==) and inequality (!=). 
These operators compare two values to see if they refer to the same object. Although this comparison is very fast, 
it is often not what you want. 

 Usually you want to know if the objects have the same value, and not whether two objects are a reference to the 
 same object. For example, 
if (name == "Mickey Mouse")   // Legal, but ALMOST SURELY WRONG

This is true only if name is a reference to the same object that "Mickey Mouse" refers to. 
This will be false if the String in name was read from input or computed (by putting strings together or taking 
the substring), even though name really does have exactly those characters in it. 

Many (class)es (eg, String) define the equals() method to compare the values of objects. 


//<-----------------	Comparing Object values with the equals() Method:	---------------------->

Use the equals() method to compare object values. The equals() method returns a boolean value. 
The previous example can be fixed by writing: 
if (name.equals("Mickey Mouse"))  // Compares values, not references.

Because the equals() method makes a == test first, it can be fairly fast when the objects are identical. 
It only compares the values if the two references are not identical.

Note: If you override equals, you should also override hashCode()

//Overriding hashCode(). 
The hashCode() method of a (class) is used for hashing in library data structures such as HashSet and HashMap. 
If you override equals(), you should override hashCode() or your (class) will not work correctly in these 
(and some other) data structures.

//Should not .equals and .compareTo produce same result?

The general advice is that if a.equals(b) is true, then a.compareTo(b) == 0 should also be true. 
Curiously, BigDecimal violates this. Look at the Java API documentation for an explanation of the difference. 
This seems wrong, although their implementation has some plausibility. 


//<------------------------	Other comparisons - Comparable<T> interface:   ---------------------------->


The equals method and == and != operators test for equality/inequality, but do not provide a way to test for 
relative values. Some (class)es (eg, String and other (class)es with a natural ordering) implement the Comparable<T> 
interface, which defines a compareTo method. 
You will want to implement Comparable<T> in your (class) if you want to use it with Collections.sort() 
or Arrays.sort() methods. 

//Defining a Comparator object

You can create Comparators to sort any arbitrary way for any (class). For example, the String (class) defines the 
CASE_INSENSITIVE_ORDER comparator.

Other comparison methods

String has the specialized equalsIgnoreCase() and compareToIgnoreCase(). String also supplies the constant String.
CASE_INSENSITIVE_ORDER Comparator. 
The === operator (Does not exist - yet?)

Comparing objects is somewhat awkward, so a === operator has been proposed. One proposal is that 
a === b would be the same as ((a == b) || ((a != null) && a.equals(b))) 


//Common Errors

Using == instead of equals() with Objects
When you want to compare objects, you need to know whether you should use == to see if they are the same object, 
or equals() to see if they may be a different object, but have the same value. 
This kind of error can be very hard to find.
