

//<------------plain old simple for loop  ---------------------->


for (var i = 0; i < a.length; i++) {
    // Do something with a[i]
}
This is slightly inefficient as you are looking up the length property once every loop. An improvement is this:

for (var i = 0, len = a.length; i < len; i++) {
    // Do something with a[i]
}
An even nicer idiom is:

for (var i = 0, item; item = a[i++];) {
    // Do something with item
}

For performance reasons, it’s best not to compare i against the array’s length with
each iteration of the loop, as that requires that JavaScript look up the array’s length
each time. A better version of the same loop assigns the array’s length to another
variable in the loop’s first clause and then uses this new variable for the conditional:

for (var i = 0, count = myList.length; i < count; i++) {
// Do something with myList[i].
}

Here we are setting up two variables. The assignment in the middle part of the for loop is also tested for 
truthfulness — if it succeeds, the loop continues. Since i is incremented each time, items from the array will 
be assigned to item in sequential order. The loop stops when a "falsy" item is found (such as undefined).

Note that this trick should only be used for arrays which you know do not contain "falsy" values 
(arrays of objects or DOM nodes for example). If you are iterating over numeric data that might include a 0 or 
string data that might include the empty string you should use the i, len idiom instead.




//<------------Using foreach and a callback function ---------------------->

Note: Note that if someone added new properties to Array.prototype, they will also be iterated over by this loop:

pets = ["Cat", "Dog", "Rabbit", "Hamster"]
pets.forEach(output)

//for each element in pets array output function is invoked
function output(element, index, array)
{
	document.write("Element at index " + index + " has the value " +
		element + "<br />")
}

//using join() on an array
document.write(pets.join()      + "<br />")
document.write(pets.join(' ')   + "<br />")
document.write(pets.join(' : ') + "<br />")

