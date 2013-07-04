Thread Objects

Each thread is associated with an instance of the (class) Thread. There are two basic strategies for using Thread 
objects to create a concurrent application.

    - To directly control thread creation and management, simply instantiate Thread each time the application needs 
    to initiate an asynchronous task.
    
    - To abstract thread management from the rest of your application, pass the applications tasks to an executor.

This section documents the use of Thread objects. Executors are discussed with other high-level concurrency objects.

//Defining and Starting a Thread

An application that creates an instance of Thread must provide the code that will run in that thread. 
There are two ways to do this:

    //Provide a Runnable object. 
    
    The Runnable interface defines a single method, run, meant to contain the code 
    executed in the thread. The Runnable object is passed to the Thread constructor, as in the HelloRunnable example:


    public class HelloRunnable implements Runnable {

        public void run() {
            System.out.println("Hello from a thread!");
        }

        public static void main(String args[]) {
            (new Thread(new HelloRunnable())).start();
        }

    }

    //Subclass Thread. 

    The Thread class itself implements Runnable, though its run method does nothing. 
    An application can subclass Thread, providing its own implementation of run, as in the HelloThread example:


    public class HelloThread extends Thread {

        public void run() {
            System.out.println("Hello from a thread!");
        }

        public static void main(String args[]) {
            (new HelloThread()).start();
        }

    }

Notice that both examples invoke Thread.start in order to start the (new) thread.

Which of these idioms should you use? The first idiom, which employs a Runnable object, is more general, 
because the Runnable object can sub(class) a (class) other than Thread. The second idiom is easier to use in simple 
applications, but is limited by the fact that your task (class) must be a descendant of Thread. 
This lesson focuses on the first approach, which separates the Runnable task from the Thread object that executes 
the task. Not only is this approach more flexible, but it is applicable to the high-level thread management 
APIs covered later.

The Thread (class) defines a number of methods useful for thread management. These include static methods, 
which provide information about, or affect the status of, the thread invoking the method. 
The other methods are invoked from other threads involved in managing the thread and Thread object.

