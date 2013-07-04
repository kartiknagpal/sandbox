<?php
/*Class Abstraction

PHP 5 introduces abstract classes and methods. Classes defined as abstract may not be instantiated, 
and any class that contains at least one abstract method must also be abstract. Methods defined as abstract 
simply declare the method's signature - they cannot define the implementation. 

When inheriting from an abstract class, all methods marked abstract in the parent's class declaration must be 
defined by the child; additionally, these methods must be defined with the same (or a less restricted) visibility. 
For example, if the abstract method is defined as protected, the function implementation must be defined as either 
protected or public, but not private. Furthermore the signatures of the methods must match, i.e. the type hints 
and the number of required arguments must be the same. This also applies to constructors as of PHP 5.4. 
Before 5.4 constructor signatures could differ. 
*/

//Example #1 Abstract class example

abstract class AbstractClass
{
    // Force Extending class to define this method
    abstract protected function getValue();
    abstract protected function prefixValue($prefix);

    // Common method
    public function printOut() {
        print $this->getValue() . "\n";
    }
}

class ConcreteClass1 extends AbstractClass
{
    protected function getValue() {
        return "ConcreteClass1";
    }

    public function prefixValue($prefix) {
        return "{$prefix}ConcreteClass1";
    }
}

class ConcreteClass2 extends AbstractClass
{
    public function getValue() {
        return "ConcreteClass2";
    }

    public function prefixValue($prefix) {
        return "{$prefix}ConcreteClass2";
    }
}

$class1 = new ConcreteClass1;
$class1->printOut();
echo $class1->prefixValue('FOO_') ."\n";

$class2 = new ConcreteClass2;
$class2->printOut();
echo $class2->prefixValue('FOO_') ."\n";
 


/*The above example will output:


ConcreteClass1
FOO_ConcreteClass1
ConcreteClass2
FOO_ConcreteClass2
*/
?>

