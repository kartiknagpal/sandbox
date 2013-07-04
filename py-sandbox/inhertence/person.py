#-------------------------------------------------------------------------------
# Name:        module1
# Purpose:
#
# Author:      Kartik
#
# Created:     14/02/2013
# Copyright:   (c) Kartik 2013
# Licence:     <your licence>
#-------------------------------------------------------------------------------
#instance.method(arg1, arg2)
#class.method(instance, arg1, arg2)

class Person:
    def __init__(self,name,age,pay=0,job=None):
        self._name = name
        self._age = age
        self._pay = pay
        self._job = job
    def last_name(self):
        return self._name.split()[-1]
    def give_raise(self,percent):
        self._pay += percent*self._pay
        return self._pay
    def __str__(self):
        return 'Name: '+self._name+' age: '+str(self._age)+' pay: '+str(self._pay)+' job: '+self._job

class Manager(Person):
    def __init__(self,name,age,pay):
        Person.__init__(self,name,age,pay,'Manager')
    def give_raise(self,percent):
        self._pay = Person.give_raise(self,percent+1)
    def __str__(self):
         return 'Name: '+self._name+' age: '+str(self._age)+' pay: '+str(self._pay)

if __name__ == '__main__':
    alex = Person('Alex Pearson',34,230000,'IT')
    steve = Manager('Steve Jobs',49,1000000)
    print('Alex %s and Steve %s'%(alex.last_name(),steve.last_name()))
    alex.give_raise(3)
    steve.give_raise(5)
    print(alex)
    print(steve)
    db = dict()
    db['alex']= alex
    db['steve'] = steve
    import pprint
    for p in db.values():
        pprint.pprint(str(p))
