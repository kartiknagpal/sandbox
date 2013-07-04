A function can accept arbitrary number of arguments and store in arguments array.
The function body can contain as many statements as you like, and can declare its own variables which are local 
to that function. The return statement can be used to return a value at any time, terminating the function. 
If no return statement is used (or an empty return with no value), JavaScript returns undefined.

The named parameters turn out to be more like guidelines than anything else. You can call a function without 
passing the parameters it expects, in which case they will be set to undefined.

function avg() {
	var sum = 0;
	for (var i = 0, j=arguments.length; i < j; i++) {
		sum += arguments[i];
	}
	return sum/arguments.length;
}

avg(2,3,4,5);

/*
* Nested function
*/
function betterExampleNeeded() {
	var a = 1;
	function oneMoreThanA() {
		return a+1;
	}
	return oneMoreThanA();
}

 functions have access to an additional variable inside their body called arguments, which is an array-like object 
 holding all of the values passed to the function. Lets re-write the add function to take as many values as we want:

function add() {
    var sum = 0;
    for (var i = 0, j = arguments.length; i < j; i++) {
        sum += arguments[i];
    }
    return sum;
}
 
> add(2, 3, 4, 5)
14