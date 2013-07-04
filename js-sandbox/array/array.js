//Arrays:

Arrays in JavaScript are actually a special type of object. They work very much like regular objects 
(numerical properties can naturally be accessed only using [] syntax) but they have one magic property 
called 'length'. This is always one more than the highest index in the array.

//<-------------------	Appending an item to the end of the array  ---------------------->

You cannot add new items to the array using this syntax:
people[] = ‘Dee’; // Won’t work in javascript!
In php, it appends the literal in the end;

If you want to append an item to an array, the safest way to do it is like this:

a[a.length] = item;                 // same as a.push(item);
Since a.length is one more than the highest index, you can be assured that you are assigning to an empty position 
at the end of the array.


//<--------------------- Creating an array ------------------------->

There are two ways you can create an array. The first is to use the new operator:

var myVar = new Array();

 a[0] = "dog";
 a[1] = "cat";
 a[2] = "hen";
 a.length
>>3

Remember — the length of the array is one more than the highest index.

If you query a non-existent array index, you get undefined:

> typeof a[90]
undefined

To establish the array’s contents while creating
it, add the values, separated by commas, between the parentheses:

var myList = new Array(1, 2, 3);
var people = new Array(‘Fred’, ‘Daphne’, ‘Velma’, ‘Shaggy’);
var options = new Array(true, false);

As with any value in JavaScript, you should quote strings but not other types.
The second way you can create an array is to use literal syntax. Literal syntax,
a phrase less advanced than it sounds, is actually something you’ve been doing
thus far. When you create a number, string, or Boolean using the following code,
you’re using literal syntax:

var n = 2;
var lang = ‘JavaScript’;
var test = true;

Those variables can also be created more formally by creating Number, String,
and Boolean objects:

var n = new Number(2);
var lang = new String(‘JavaScript’);
var true = new Boolean(true);

There are minor differences as to the impact on your overall code when you
use object syntax (i.e., use new) versus literal syntax, but simple variable types are
almost always created literally. With arrays, you can also use literal syntax, with
the square brackets being the array notation indicators:

var myVar = [];
var myList = [1, 2, 3];
var people = [‘Fred’, ‘Daphne’, ‘Velma’, ‘Shaggy’];

As with the simple types, it’s most common to create arrays using literal syntax.
In fact, as you’ll see by the end of the chapter, the general preference is to create
any standard variable type using literal syntax (except for Date, which does not
have a literal equivalent).



//<---------------------- Sparsely populated Arrays ------------------------>

Arrays in JavaScript have an odd behavior in that they can be sparsely populated,
meaning they can have “holes” in their lists of values. These holes
appear when you:
- Delete an element
- use a value other than the array’s length for the indexed position of an item being added
- Skip values whem creating arrays

The latter can occur if you use this syntax:
var myList = [1, , 3, , 5];
That array has two undefined values. As a best practice, though, if you need
to create an array with holes, it’s best to be explicit about it:
var myList = [1, undefined, 3, undefined, 5];
Never use an empty comma at the end, though, as JavaScript will ignore it
(and older browsers will choke on it).