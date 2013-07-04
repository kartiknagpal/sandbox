//Variables:

New variables in JavaScript are declared using the var keyword:

var a;
var name = "simon";
If you declare a variable without assigning any value to it, its type is undefined. 

An important difference from other languages like Java is that in JavaScript, blocks do not have scope; 
only functions have scope. So if a variable is defined using var in a compound statement 
(for example inside an if control structure), it will be visible to the entire function.

//Operators:

JavaScript numeric operators are +, -, *, / and % - which is the remainder operator. Values are assigned using =, 
and there are also compound assignment statements such as += and -=. These extend out to x = x operator y.

x += 5
x = x + 5
You can use ++ and -- to increment and decrement respectively. These can be used as prefix or postfix operators.

The + operator also does string concatenation:

> "hello" + " world"
hello world
If you add a string to a number (or other value) everything is converted in to a string first. 
This might catch you out:

> "3" + 4 + 5
345
> 3 + 4 + "5"
75
Adding an empty string to something is a useful way of converting it.

Comparisons in JavaScript can be made using <, >, <= and >=. These work for both strings and numbers. 
Equality is a little less straightforward. The double-equals operator performs type coercion if you give it 
different types, with sometimes interesting results:

> "dog" == "dog"
true
> 1 == true
true
To avoid type coercion, use the triple-equals operator:

> 1 === true
false
> true === true
true
There are also != and !== operators.

JavaScript also has bitwise operations. If you want to use them, they are there.