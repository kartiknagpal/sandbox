#-------------------------------------------------------------------------------
# Name:        module2
# Purpose:
#
# Author:      Kartik
#
# Created:     11/02/2013
# Copyright:   (c) Kartik 2013
# Licence:     <your licence>
#-------------------------------------------------------------------------------

import sqlite3 as db
def main():
    conn = db.connect('test.db')
    cursor = conn.cursor()
    #cursor.execute("create table films(title text, year text, director text)")
#    cursor.execute("insert into films values\
#    ('Annie Hall','1977','Woody Allen')")
#    cursor.execute("insert into films values\
#    ('The Godfather','1972','Francis Ford Coppola')")
#    print("table created")
    cursor.execute('select * from films')
    conn.close()

if __name__ == '__main__':
    main()
