Why do we need fast and compact serialisation? 
Many of our systems are distributed and we need to communicate by passing state between processes efficiently. 
This state lives inside our objects. I’ve profiled many systems and often a large part of the cost is the 
serialisation of this state to-and-from byte buffers. I’ve seen a significant range of protocols and mechanisms 
used to achieve this. At one end of the spectrum are the easy to use but inefficient protocols likes 
Java Serialisation, XML and JSON. At the other end of this spectrum are the binary protocols that can be very fast 
and efficient but they require a deeper understanding and skill.

In this article I will illustrate the performance gains that are possible when using simple binary protocols and 
introduce a little known technique available in Java to achieve similar performance to what is possible with 
native languages like C or C++.

The three approaches to be compared are:

- Java Serialization: The standard method in Java of having an object implement Serializable.

- Binary via ByteBuffer: A simple protocol using the ByteBuffer API to write the fields of an object in binary format. This is our baseline for what is considered a good binary encoding approach.

- Binary via Unsafe: Introduction to Unsafe and its collection of methods that allow direct memory manipulation. 
				   Here I will show how to get similar performance to C/C++.


