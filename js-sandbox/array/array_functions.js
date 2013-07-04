//Arrays:

Method name	Description
a.toString()	 
a.toLocaleString()	 
a.concat(item[, itemN])	Returns a new array with the items added on to it.
a.join(sep)	 
a.pop()	Removes and returns the last item.
a.push(item[, itemN])	Push adds one or more items to the end.
a.reverse()	 
a.shift()	 
a.slice(start, end)	Returns a sub-array.
a.sort([cmpfn])	Takes an optional comparison function.
a.splice(start, delcount[, itemN])	Lets you modify an array by deleting a section and replacing it with more items.
a.unshift([item])	Prepends items to the start of the array.

//<-------------------- Searching elem in array --------------------------->
A new way to find array element values is to use the indexOf() or lastIndexOf() methods, added in ECMAScript 5. 
Both work like the string counterparts, returning the indexed position in the array of the value if it is found. If
the value does not exist in the array, both methods return -1:
months.indexOf(‘February’); // 1
months.indexOf(‘Smarch’); // -1