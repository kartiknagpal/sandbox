Enum Types

Enums

Problem: How to represent a set of named constant values. First well look at the "old" Java solution, 
then see how Java 5 (enum)s substantially improve the situation. 

//<--------------   Older, but common, solution:    --------------->
Just define a number of public static final int constants. For example:
//... Constants to represent possible shapes.
public static final int RECTANGLE = 0;
public static final int CIRCLE    = 1;
public static final int LINE      = 2;
...
int drawing = RECTANGLE;   // But any int could be assigned.

These values can then be assigned to an integer variable, and can be used in switch statements. 
This style is useful, but is not a great solution. 

//Allows illegal values: 
    Any variable containing one of these values could also be assigned any integer value, although there are only 
    three legal choices. Eg, 
    drawing = 99;   // Illogical value, but allowed by compiler.
//Updates:
    not reflected in other code. If there are additions, deletions, or reorderings, code from other 
    (class)es will not automatically be readjusted to reflect these changes. 
    All code that uses these definitions would have to be recompiled. 
//No easy I/O: 
    To convert values to and from a string form requires maintaining an additional array and lookup code. 
//Fragile for loops: 
    There is no obvious first and last value so iterating over all values is subject to errors which are not 
    diagnosed at compile time if the values are rearranged, deleted, or added to. There is no way to use the 
    enhanced for loop. 
//No behavior: 
    This style is pre-OOP -- there are values, but no behavior defined for them.


//<--------------    Defining an (enum) type:   --------------------->



An (enum) type is a kind of (class) definition. The possible (enum) values are listed in the curly braces, 
separated by commas. By convention the value names are in upper case. 

public (enum) Shape { RECTANGLE, CIRCLE, LINE }


public (enum) Day {
    SUNDAY, MONDAY, TUESDAY, WEDNESDAY,
    THURSDAY, FRIDAY, SATURDAY 
}



//<--------------------     Declaring (enum) variables and using (enum) values:    ------------------->


The (enum) (class) name can be use like any other (class) type in declarations. 
Usually (enum) values must be prefixed with the (enum) type name.
Shape drawing = Shape.RECTANGLE;   // Only a Shape value can be assigned.


//Printing (enum) values:
The (enum) (class) has a toString() method defined that returns the unqualified string version of the value. 
This means that its easy to print these values without any special conversion effort. 
System.out.println(drawing);    // Prints RECTANGLE


//Looping over all (enum) values with foreach loop
The static values() method of an (enum) type returns an array of the (enum) values. 
The foreach loop is a good way to go over all of them. 
//... Loop over all values.
for (Shape shp : Shape.values()) {
    System.out.println(shp);       // Prints RECTANGLE, CIRCLE, ...
}


//Switch statement:

The switch statement was enhanced to allow a convenient use of (enum)s. 
Note that the case values dont have to be qualified with the (enum) (class) name, which can be determined from the 
switch control value. 
switch (drawing) {
    case RECTANGLE: g.drawRect(x, y, width, height);
                    break;
    case CIRCLE   : g.drawOval(x, y, width, height);
                    break;
    case LINE     : g.drawLine(x, y, x + width, y + height);
                    break;
}


//Getting an integer equivalent of an (enum) value:

Each (enum) value in an (enum) (class) has an associated default value, starting with zero for the first value 
and incrementing by one for each additional value. This may be accessed with the ordinal() method. 
System.out.println(drawing.ordinal());     // Prints 0 for RECTANGLE.

//Input:

The valueOf() method can be used to convert a string value to an (enum) value. 
Here is an example of reading in a Shape value from a Scanner object in. 
drawing = Shape.valueOf(in.next());
Defining additional fields, methods, and constants for your (enum) type

Methods can be defined for an (enum) (class), including defining a different method body for each of the constants. 
See the Sun article for examples of this. If you are using switch statements with cases for each of the (enum) 
constants, consider putting the code into the (enum) (class). 
Related data structure (class)es: EnumSet and EnumMap

The java.util.EnumSet (class) provides an efficient implementation of sets of (enum)s as bit maps, or powersets 
as they were called in Pascal. EnumSet can also generate an Iterable for use with subsets in the for-each statement. 

java.util.EnumMap provides an efficient implementation of a map for (enum)s based on an array.
An (enum) type is a type whose fields consist of a fixed set of constants. Common examples include compass 
directions (values of NORTH, SOUTH, EAST, and WEST) and the days of the week.

Because they are constants, the names of an (enum) types fields are in uppercase letters.

In the Java programming language, you define an (enum) type by using the (enum) keyword. For example, you would 
specify a days-of-the-week (enum) type as:


You should use (enum) types any time you need to represent a fixed set of constants. That includes natural 
(enum) types such as the planets in our solar system and data sets where you know all possible values at compile 
time—for example, the choices on a menu, command line flags, and so on.

Here is some code that shows you how to use the Day (enum) defined above:

public (class) EnumTest {
    Day day;
    
    public EnumTest(Day day) {
        this.day = day;
    }
    
    public void tellItLikeItIs() {
        switch (day) {
            case MONDAY:
                System.out.println("Mondays are bad.");
                break;
                    
            case FRIDAY:
                System.out.println("Fridays are better.");
                break;
                         
            case SATURDAY: case SUNDAY:
                System.out.println("Weekends are best.");
                break;
                        
            default:
                System.out.println("Midweek days are so-so.");
                break;
        }
    }
    
    public static void main(String[] args) {
        EnumTest firstDay = new EnumTest(Day.MONDAY);
        firstDay.tellItLikeItIs();
        EnumTest thirdDay = new EnumTest(Day.WEDNESDAY);
        thirdDay.tellItLikeItIs();
        EnumTest fifthDay = new EnumTest(Day.FRIDAY);
        fifthDay.tellItLikeItIs();
        EnumTest sixthDay = new EnumTest(Day.SATURDAY);
        sixthDay.tellItLikeItIs();
        EnumTest seventhDay = new EnumTest(Day.SUNDAY);
        seventhDay.tellItLikeItIs();
    }
}

The output is:
Mondays are bad.
Midweek days are so-so.
Fridays are better.
Weekends are best.
Weekends are best.





//<----------------     More Info on Enums:   -------------->

Java programming language (enum) types are much more powerful than their counterparts in other languages. 
The (enum) declaration defines a (class) (called an (enum) type). The (enum) (class) body can include methods and 
other fields. The compiler automatically adds some special methods when it creates an (enum). 
For example, they have a static values method that returns an array containing all of the values of the (enum) 
in the order they are declared. This method is commonly used in combination with the for-each construct to iterate 
over the values of an (enum) type. 
For example, this code from the Planet (class) example below iterates over all the planets in the solar system.

for (Planet p : Planet.values()) {
    System.out.printf("Your weight on %s is %f%n",
                      p, p.surfaceWeight(mass));
}

Note: All (enum)s implicitly extend java.lang.Enum. Since Java does not support multiple inheritance, an (enum) 
cannot extend anything else. 

In the following example, Planet is an (enum) type that represents the planets in the solar system. 
They are defined with constant mass and radius properties.

Each (enum) constant is declared with values for the mass and radius parameters. These values are passed to the 
constructor when the constant is created. Java requires that the constants be defined first, prior to any fields 
or methods. Also, when there are fields and methods, the list of (enum) constants must end with a semicolon.
Note: The constructor for an (enum) type must be package-private or private access. It automatically creates the 
constants that are defined at the beginning of the (enum) body. You cannot invoke an (enum) constructor yourself. 

In addition to its properties and constructor, Planet has methods that allow you to retrieve the surface gravity 
and weight of an object on each planet. Here is a sample program that takes your weight on earth (in any unit) 
and calculates and prints your weight on all of the planets (in the same unit):

public (enum) Planet {
    MERCURY (3.303e+23, 2.4397e6),
    VENUS   (4.869e+24, 6.0518e6),
    EARTH   (5.976e+24, 6.37814e6),
    MARS    (6.421e+23, 3.3972e6),
    JUPITER (1.9e+27,   7.1492e7),
    SATURN  (5.688e+26, 6.0268e7),
    URANUS  (8.686e+25, 2.5559e7),
    NEPTUNE (1.024e+26, 2.4746e7);

    private final double mass;   // in kilograms
    private final double radius; // in meters
    Planet(double mass, double radius) {
        this.mass = mass;
        this.radius = radius;
    }
    private double mass() { return mass; }
    private double radius() { return radius; }

    // universal gravitational constant  (m3 kg-1 s-2)
    public static final double G = 6.67300E-11;

    double surfaceGravity() {
        return G * mass / (radius * radius);
    }
    double surfaceWeight(double otherMass) {
        return otherMass * surfaceGravity();
    }
    public static void main(String[] args) {
        if (args.length != 1) {
            System.err.println("Usage: java Planet <earth_weight>");
            System.exit(-1);
        }
        double earthWeight = Double.parseDouble(args[0]);
        double mass = earthWeight/EARTH.surfaceGravity();
        for (Planet p : Planet.values())
           System.out.printf("Your weight on %s is %f%n",
                             p, p.surfaceWeight(mass));
    }
}

If you run Planet.(class) from the command line with an argument of 175, you get this output:
$ java Planet 175
Your weight on MERCURY is 66.107583
Your weight on VENUS is 158.374842
Your weight on EARTH is 175.000000
Your weight on MARS is 66.279007
Your weight on JUPITER is 442.847567
Your weight on SATURN is 186.552719
Your weight on URANUS is 158.397260
Your weight on NEPTUNE is 199.207413