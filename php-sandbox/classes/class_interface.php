<?php
/*Object Interfaces:

Object interfaces allow you to create code which specifies which methods a class must implement, without having 
to define how these methods are handled. 

Interfaces are defined using the interface keyword, in the same way as a standard class, but without any of the 
methods having their contents defined. 

All methods declared in an interface must be public, this is the nature of an interface. 


implements

To implement an interface, the implements operator is used. All methods in the interface must be implemented 
within a class; failure to do so will result in a fatal error. Classes may implement more than one interface if 
desired by separating each interface with a comma. 
Note: 
A class cannot implement two interfaces that share function names, since it would cause ambiguity. 
Note: 
Interfaces can be extended like classes using the extends operator. 

Note: 
The class implementing the interface must use the exact same method signatures as are defined in the interface. Not doing so will result in a fatal error. 

Constants
It's possible for interfaces to have constants. Interface constants works exactly like class constants except they cannot be overridden by a class/interface that inherits them. 

Examples

*/
//Example #1 Interface example

// Declare the interface 'iTemplate'
interface iTemplate
{
    public function setVariable($name, $var);
    public function getHtml($template);
}

// Implement the interface
// This will work
class Template implements iTemplate
{
    private $vars = array();
  
    public function setVariable($name, $var)
    {
        $this->vars[$name] = $var;
    }
  
    public function getHtml($template)
    {
        foreach($this->vars as $name => $value) {
            $template = str_replace('{' . $name . '}', $value, $template);
        }
 
        return $template;
    }
}

// This will not work
// Fatal error: Class BadTemplate contains 1 abstract methods
// and must therefore be declared abstract (iTemplate::getHtml)
class BadTemplate implements iTemplate
{
    private $vars = array();
  
    public function setVariable($name, $var)
    {
        $this->vars[$name] = $var;
    }
}

//Example #2 Extendable Interfaces


<?php
interface a
{
    public function foo();
}

interface b extends a
{
    public function baz(Baz $baz);
}

// This will work
class c implements b
{
    public function foo()
    {
    }

    public function baz(Baz $baz)
    {
    }
}

// This will not work and result in a fatal error
class d implements b
{
    public function foo()
    {
    }

    public function baz(Foo $foo)
    {
    }
}


//Example #3 Multiple interface inheritance

interface a
{
    public function foo();
}

interface b
{
    public function bar();
}

interface c extends a, b
{
    public function baz();
}

class d implements c
{
    public function foo()
    {
    }

    public function bar()
    {
    }

    public function baz()
    {
    }
}

//Example #4 Interfaces with constants

interface a
{
    const b = 'Interface constant';
}

// Prints: Interface constant
echo a::b;


// This will however not work because it's not allowed to 
// override constants.
class b implements a
{
    const b = 'Class constant';
}


/*An interface, together with type-hinting, provides a good way to make sure that a particular object contains 
particular methods. See instanceof operator and type hinting. 
*/
?>