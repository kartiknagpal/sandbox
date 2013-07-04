var a = new Array(1,2,3);
>>undefined
Array.prototype.foo = function() {return "foo"}
>>function () {return "foo"}
a.foo()
>>"foo"