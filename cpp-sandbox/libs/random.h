/*
* File: random.h
* --------------
* This interface provides several functions for generating psuedorandom numbers.
*/


#ifndef RANDOM_H_INCLUDED
#define RANDOM_H_INCLUDED

/*
* Function: RandomInteger
* Usage: n = RandomInteger(low, high);
* ------------------------------------
* This function returns a random integer in the range low to high, inclusive.
*/

int RandomInteger(int low, int high);

/*
* Function RandomReal
* Usage: d = RandomReal(low, high);
* ----------------------------------
* This function returns a random real number in the half-open interval
* [low .. high), meaning that the result is always grater than or equal to low
* but strictly less than high.
*/

double RandomReal(double low, double high);

/*
* Function: RandomChance
* Usage: if (RandomChance(p)) ...
* -------------------------------
* The RandomChance function returns true with the probablity indicated by p,
* which should be a floating point number b/w. 0 and 1.
* For eg, calling RandomChance(0.30) return true 30% of the percent of time.
*/

bool RandomChance(double p);

/*
* Function: RandomSize()
* Usage: RandomSize();
* ----------------------
* This function intializes the random-number generator so that its results are
* unpredictable . If this function is not called, the other functions will
* return the same values on each run.
*/

void Randomize();


#endif // RANDOM_H_INCLUDED
