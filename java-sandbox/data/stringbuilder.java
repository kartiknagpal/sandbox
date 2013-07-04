Summary - java.util.StringBuilder and java.util.StringBuffer 

Strings are immutable (cannot be changed), so manipulating strings often causes many temporary string objects to be 
created, which can be quite inefficient. StringBuilder (or StringBuffer) are better choices in these cases. 
Their toString() method can be used get a String value. It is not necessary to create them with a specific size, 
it will expand as necessary. Many StringBuilder methods return the same StringBuilder so that the call 
chaining style of programming can be used. 

StringBuilder is basically identical to the older StringBuffer, but is slightly faster because it is not synchronized.
Constructors
sb = 	new StringBuilder()	Creates empty StringBuilder
sb = 	new StringBuilder(n)	Creates empty StringBuilder with initial capacity n.
sb = 	new StringBuilder(s)	Creates StringBuilder with value initialized to String s.
Length
i = 	sb.length()	Length of the current contents of sb.
Modifying the content - These methods return the original StingBuilder to allow call chaining.
sb =	sb.append(x)	Appends x (char, int, String, ...) to end of sb.
sb =	sb.insert(offset, x)	Inserts x (char, int, String, ...) at position offset.
sb =	sb.setCharAt(index, c)	Replaces char at index with c
sb =	sb.deleteCharAt(i)	Deletes char at index i.
sb =	sb.delete(beg, end)	Deletes chars at index beg thru end.
sb =	sb.reverse()	Reverses the contents.
sb =	sb.replace(beg, end, s)	Replaces characters beg thru end with s.
Getting parts
c = 	sb.charAt(i)	char at position i in sb.
s = 	sb.substring(i)	substring from index i to the end of sb.
s = 	sb.substring(i, j)	substring from index i to BEFORE index j of sb.
Misc
s = 	sb.toString()	Returns a String for the contents of sb.
Searching -- Note: All "indexOf" methods return -1 if the string/char is not found
i = 	sb.indexOf(s)	index of the first occurrence of String s in s.
i = 	sb.indexOf(s, i)	index of String s at or after position i in sb.
i = 	sb.lastIndexOf(s)	index of last occurrence of s in sb.
i = 	sb.lastIndexOf(s, i)	index of last occurrence of s on or before i in sb.
Comparison (note: use this instead of == and !=)
b = 	sb.equals(sb2)	true if the two StringBuilders contain equal values