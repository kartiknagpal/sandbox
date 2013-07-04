<?php
/*Class Constants:

It is possible to define constant values on a per-class basis remaining the same and unchangeable. 
Constants differ from normal variables in that you don't use the $ symbol to declare or use them. 

The value must be a constant expression, not (for example) a variable, a property, a result of a mathematical 
operation, or a function call. 
It's also possible for interfaces to have constants.

It's possible to declare constant in base class, and override it in child, and access to correct value of the const 
from the static method is possible by 'get_called_class' method:*/

abstract class dbObject
{    
     const TABLE_NAME='undefined';
     
     public static function GetAll()
     {
         $c = get_called_class();
         return "SELECT * FROM `".$c::TABLE_NAME."`";
     }    
 }

 class dbPerson extends dbObject
{
     const TABLE_NAME='persons';
 }

 class dbAdmin extends dbPerson
{
     const TABLE_NAME='admins';
 }

 echo dbPerson::GetAll()."<br>";//output: "SELECT * FROM `persons`"
echo dbAdmin::GetAll()."<br>";//output: "SELECT * FROM `admins`"


?>