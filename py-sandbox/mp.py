#-------------------------------------------------------------------------------
# Name:        module1
# Purpose:
#
# Author:      Kartik
#
# Created:     10/04/2013
# Copyright:   (c) Kartik 2013
# Licence:     <your licence>
#-------------------------------------------------------------------------------

import queue, threading
from tkinter import *
from tkinter.scrolledtext import ScrolledText

class Model:

    def __init__ (self):
        self.clickCount = 0
        self.q = queue.Queue()

    def incrementClickCount(self):
        self.clickCount += 1

class View(Frame):
    def __init__ (self,parent=None):
        Frame.__init__(self,parent)
        self.pack()
        self.makeWidgets()
        self.scrolltext = ScrolledText(master=self)
        self.scrolltext.pack()

    def makeWidgets(self):
        btn = Button(text='Hello World',command=self.onClick)
        btn.pack(side=TOP)

    def onClick(self):
        '''Delegate event handling to Controller'''
        app.controller.handleClick()

class Controller:

    def __init__ (self):
        self.lock = threading.Lock()
        self.threadName = None

    def handleClick(self):
        '''Start a new thread'''
        t = threading.Thread(target=self.producer,args=())
        self.threadName = t.getName()
        t.start()

    def producer(self):
        '''Manipulate model in the thread and put result in a shared queue'''
        self.lock.acquire()
        app.model.incrementClickCount()
        print('clicked son',app.model.clickCount,'thread : ',self.threadName)
        app.model.q.put('your click count: %d'%app.model.clickCount)
        self.lock.release()

    def consumer(self):
        '''Try to retrieve result from queue after every 0.25sec and if result
            available update the view'''
        #global app

        try:
           x = app.model.q.get(block=False)
        except queue.Empty:
            pass
        else:
            app.view.scrolltext.insert('end','%s\n'%str(x))
        app.view.scrolltext.after(250, lambda: self.consumer())

class App:
    def __init__(self):
        root = Tk()
        self.model = Model()
        self.view = View(root)
        self.controller = Controller()
        #print(globals()['app'])


if __name__ == '__main__':

    '''Create and Assign instances of MVC Pattern'''
    app = App()
    app.controller.consumer()
    app.view.mainloop()

