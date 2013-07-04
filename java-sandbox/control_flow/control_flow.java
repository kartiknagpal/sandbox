Control Flow

Each control statement is one logical statement, which often encloses a block of statements in curly braces {}. 

Indenting is essential. Four spaces is most common.


//<---------------- if Statement:  ------------------------->


//----- if statement with a true clause
   if (expression) {
       statements // do these if expression is true
   }
   
//----- if statement with true and false clause
   if (expression) {
       statements // do these if expression is true
   } else {
       statements // do these if expression is false
   }
   
//----- if statements with many parallel tests
   if (expression1) {
       statements // do these if expression1 is true
   } else if (expression2) {
       statements // do these if expression2 is true
   } else if (expression3) {
       statements // do these if expression3 is true
   . . .
   } else {
       statements // do these no expression was true
   }


//<------------------------ switch Statement: -------------------------->


switch chooses one case depending on an integer value. This is equivalent to a series of cascading if statements, 
but switch is easier to read if all comparisons are against one value. The break statement exits from the switch 
statement. If there is no break at the end of a case, execution falls thru into the next case, which is almost 
always an error. 
   switch (expr) {
      case c1:
            statements // do these if expr == c1
            break;
      case c2: 
            statements // do these if expr == c2
            break;
      case c2:
      case c3:
      case c4:         //  Cases can simply fall thru.
            statements // do these if expr ==  any of c's
            break;
      . . .
      default:
            statements // do these if expr != any above
   }



//<-----------------------  while loop:  --------------------------->

 The while statement tests the expression. If the expression evaluates to true, it executes the body of the while. 
 If it is false, execution continues with the statement after the while body. Each time after the body is executed, 
 execution starts with the test again. This continues until the expression is false or some other statement 
 (break or return) stops the loop. 
   while (testExpression) {
       statements
   }



//<---------------------  Other loop controls:  ---------------------->

 All loop statements can be labeled, so that break and continue can be used from any nesting depth. 
   break;       //exit innermost loop or switch
   break label; //exit from loop label
   continue;    //start next loop iteration
   continue label; //start next loop label
 Put label followed by colon at front of loop. 
outer: for (. . .) {
         . . .
               continue outer;	   	

//for loop
 Many loop have an initialization before the loop, and some "increment" before the next loop. The for loop is the standard way of combining these parts. 
   for (initialStmt; testExpr; incrementStmt) {
       statements
   }
 This is the same as (except continue will increment): 
   initialStmt;
   while (testExpr) {
       statements
       incrementStmt
   }


//do-while loop:

 This is the least used of the loop statements, but sometimes a loop that executes one time before testing is used. 
   do {
      statements
   } while (testExpression);
Other Flow Control Statements
Method Return
   return;      //no value for void method
   return expr; //method value to return


//Simple try...catch for exceptions:

   try {
       . . . // statements that might cause exceptions
   } catch (exception-type x) {
       . . . // statements to handle exception
   }
throw
   throw exception-object;		Multiple catch clauses and finally clause
 Executes first catch clause that specifies the exception class or a super class. The finally clause is always executed (regardless of whether there was an exception or not) so resources can be cleaned up (eg, closing a file). 
   try {
       . . . // statements that might cause exceptions
   } catch (exception-type x) {
       . . . // statements to handle exception
   } catch (exception-type x) {
       . . . // statements to handle exception
   } finally (exception-type x) {
       . . . // statements that will always be executed, exception or not.
   }