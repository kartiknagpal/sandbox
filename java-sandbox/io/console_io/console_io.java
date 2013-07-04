I/O from the Command Line

A program is often run from the command line and interacts with the user in the command line environment. 
The Java platform supports this kind of interaction in two ways: 
through the Standard Streams and through the Console.

//Standard Streams:

Standard Streams are a feature of many operating systems. By default, they read input from the keyboard and write 
output to the display. They also support I/O on files and between programs, but that feature is controlled by the 
command line interpreter, not the program.

The Java platform supports three Standard Streams:

Standard Input, accessed through System.in; 
Standard Output, accessed through System.out; and 
Standard Error, accessed through System.err.

You might expect the Standard Streams to be character streams, but, for historical reasons, they are byte streams. 
System.out and System.err are defined as PrintStream objects. Although it is technically a byte stream, 
PrintStream utilizes an internal character stream object to emulate many of the features of character streams.

By contrast, System.in is a byte stream with no character stream features. To use Standard Input as a character 
stream, wrap System.in in InputStreamReader.

InputStreamReader cin = new InputStreamReader(System.in);

// ConsoleIO.java - Reads and prints lines from/to console.
// Fred Swartz - 2002-10-29

import java.io.*;
class ConsoleIO {
    public static void main(String[] args) throws IOException {
        // In order to read a line at a time from System.in,
        // which is type InputStream, it must be wrapped into
        // a BufferedReader, which requires wrapping it first
        // in an InputStreamReader.
        // Note the "throws" clause on the enclosing method (main).
        
        InputStreamReader isr = new InputStreamReader(System.in);
        BufferedReader input = new BufferedReader(isr);
        
        String line;  // holds each input line
        
        // Read and print lines in a loop.
        // Terminate with EOF: control-Z (Windows) or control-D (other)
        while ((line = input.readLine()) != null) {
            System.out.println(line);   // process each line
        }
    }
}


//Using stream with Scanner

Objects of type Scanner are useful for breaking down formatted input into tokens and translating individual tokens 
according to their data type.

// File:   average3/Average3Scanner.java
// Description: Average three ints.  Use Scanner.
// Author: Fred Swartz
// Date:   2005-08-30

// Note: Scanner was added in Java 5 (JDK 1.5).

import java.util.Scanner;

public class Average3Scanner {

    public static void main(String[] args) {

        //... Declare local variables;
        int a, b, c;  // No meaningful names are possible.
        int average;

        //... Initialize Scanner to read from console.
        Scanner input = new Scanner(System.in);

        //... Read three numbers from the console.
        System.out.print("Enter first number : ");
        a = input.nextInt();
        System.out.print("Enter second number: ");
        b = input.nextInt();
        System.out.print("Enter last number  : ");
        c = input.nextInt();

        //... Compute their average.
        average = (a + b + c) / 3;

        //... Display their average on the console.
        System.out.println("Average is " + average);
    }
}


//The Console

A more advanced alternative to the Standard Streams is the Console. This is a single, predefined object of type 
Console that has most of the features provided by the Standard Streams, and others besides. 
The Console is particularly useful for secure password entry. The Console object also provides input and output 
streams that are true character streams, through its reader and writer methods.

Before a program can use the Console, it must attempt to retrieve the Console object by invoking System.console(). 
If the Console object is available, this method returns it. 
If System.console returns NULL, then Console operations are not permitted, either because the OS doesnot support 
them or because the program was launched in a noninteractive environment.

import java.io.Console;
import java.util.Arrays;
import java.io.IOException;

public class Password {
    
    public static void main (String args[]) throws IOException {

        Console c = System.console();
        if (c == null) {
            System.err.println("No console.");
            System.exit(1);
        }

        String login = c.readLine("Enter your login: ");
        char [] oldPassword = c.readPassword("Enter your old password: ");

        if (verify(login, oldPassword)) {
            boolean noMatch;
            do {
                char [] newPassword1 = c.readPassword("Enter your new password: ");
                char [] newPassword2 = c.readPassword("Enter new password again: ");
                noMatch = ! Arrays.equals(newPassword1, newPassword2);
                if (noMatch) {
                    c.format("Passwords don't match. Try again.%n");
                } else {
                    change(login, newPassword1);
                    c.format("Password for %s changed.%n", login);
                }
                Arrays.fill(newPassword1, ' ');
                Arrays.fill(newPassword2, ' ');
            } while (noMatch);
        }

        Arrays.fill(oldPassword, ' ');
    }
    
    // Dummy change method.
    static boolean verify(String login, char[] password) {
        // This method always returns
        // true in this example.
        // Modify this method to verify
        // password according to your rules.
        return true;
    }

    // Dummy change method.
    static void change(String login, char[] password) {
        // Modify this method to change
        // password according to your rules.
    }
}