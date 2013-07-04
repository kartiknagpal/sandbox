SQL Constraints
Constraints are used to limit the type of data that can go into a table.

Constraints can be specified when a table is created (with the CREATE TABLE statement) or after the table is created (with the ALTER TABLE statement).

We will focus on the following constraints:

NOT NULL	-	The NOT NULL constraint enforces a column to NOT accept NULL values.
UNIQUE		-	The UNIQUE constraint uniquely identifies each record in a database table.

				The UNIQUE and PRIMARY KEY constraints both provide a guarantee for uniqueness for a column or set of columns.

				A PRIMARY KEY constraint automatically has a UNIQUE constraint defined on it.

				Note that you can have many UNIQUE constraints per table, but only one PRIMARY KEY constraint per table.

PRIMARY KEY	-	The PRIMARY KEY constraint uniquely identifies each record in a database table.

				Primary keys must contain unique values.

				A primary key column cannot contain NULL values.
				Each table should have a primary key, and each table can have only ONE primary key.

FOREIGN KEY -	A FOREIGN KEY in one table points to a PRIMARY KEY in another table.
				The FOREIGN KEY constraint also prevents invalid data from being inserted into the foreign key column, because it has to be one of the values contained in the table it points to.

CHECK -			The CHECK constraint is used to limit the value range that can be placed in a column.
				If you define a CHECK constraint on a single column it allows only certain values for this column.
				If you define a CHECK constraint on a table it can limit the values in certain columns based on values in other columns in the row.

DEFAULT -		The DEFAULT constraint is used to insert a default value into a column.
				The default value will be added to all new records, if no other value is specified.


<-----------	SQL UNIQUE Constraint on CREATE table   --------------->
The following SQL creates a UNIQUE constraint on the "P_Id" column when the "Persons" table is created:

MySQL:

CREATE TABLE Persons
(
P_Id int NOT NULL,
LastName varchar(255) NOT NULL,
FirstName varchar(255),
Address varchar(255),
City varchar(255),
UNIQUE (P_Id)
)

To allow naming of a UNIQUE constraint, and for defining a UNIQUE constraint on multiple columns, use the following SQL syntax:

MySQL / SQL Server / Oracle / MS Access:

CREATE TABLE Persons
(
P_Id int NOT NULL,
LastName varchar(255) NOT NULL,
FirstName varchar(255),
Address varchar(255),
City varchar(255),
CONSTRAINT uc_PersonID UNIQUE (P_Id,LastName)
)

SQL UNIQUE Constraint on ALTER TABLE
To create a UNIQUE constraint on the "P_Id" column when the table is already created, use the following SQL:

MySQL / SQL Server / Oracle / MS Access:

ALTER TABLE Persons
ADD UNIQUE (P_Id)
To allow naming of a UNIQUE constraint, and for defining a UNIQUE constraint on multiple columns, use the following SQL syntax:

MySQL / SQL Server / Oracle / MS Access:

ALTER TABLE Persons
ADD CONSTRAINT uc_PersonID UNIQUE (P_Id,LastName)

To DROP a UNIQUE Constraint
To drop a UNIQUE constraint, use the following SQL:

MySQL:

ALTER TABLE Persons
DROP INDEX uc_PersonID


<---------------	SQL PRIMARY KEY Constraint on CREATE TABLE  ----------------->
The following SQL creates a PRIMARY KEY on the "P_Id" column when the "Persons" table is created:

MySQL:

CREATE TABLE Persons
(
P_Id int NOT NULL,
LastName varchar(255) NOT NULL,
FirstName varchar(255),
Address varchar(255),
City varchar(255),
PRIMARY KEY (P_Id)
)

To allow naming of a PRIMARY KEY constraint, and for defining a PRIMARY KEY constraint on multiple columns, use the following SQL syntax:

MySQL / SQL Server / Oracle / MS Access:

CREATE TABLE Persons
(
P_Id int NOT NULL,
LastName varchar(255) NOT NULL,
FirstName varchar(255),
Address varchar(255),
City varchar(255),
CONSTRAINT pk_PersonID PRIMARY KEY (P_Id,LastName)
)
Note: In the example above there is only ONE PRIMARY KEY (pk_PersonID). However, the value of the pk_PersonID is made up of two columns (P_Id and LastName).

SQL PRIMARY KEY Constraint on ALTER TABLE
To create a PRIMARY KEY constraint on the "P_Id" column when the table is already created, use the following SQL:

MySQL / SQL Server / Oracle / MS Access:

ALTER TABLE Persons
ADD PRIMARY KEY (P_Id)
To allow naming of a PRIMARY KEY constraint, and for defining a PRIMARY KEY constraint on multiple columns, use the following SQL syntax:

MySQL / SQL Server / Oracle / MS Access:

ALTER TABLE Persons
ADD CONSTRAINT pk_PersonID PRIMARY KEY (P_Id,LastName)
Note: If you use the ALTER TABLE statement to add a primary key, the primary key column(s) must already have been declared to not contain NULL values (when the table was first created).

To DROP a PRIMARY KEY Constraint
To drop a PRIMARY KEY constraint, use the following SQL:

MySQL:

ALTER TABLE Persons
DROP PRIMARY KEY

<--------------  SQL FOREIGN KEY Constraint on CREATE TABLE ---------------->
The following SQL creates a FOREIGN KEY on the "P_Id" column when the "Orders" table is created:

MySQL:

CREATE TABLE Orders
(
O_Id int NOT NULL,
OrderNo int NOT NULL,
P_Id int,
PRIMARY KEY (O_Id),
FOREIGN KEY (P_Id) REFERENCES Persons(P_Id)
)

SQL FOREIGN KEY Constraint on ALTER TABLE
To create a FOREIGN KEY constraint on the "P_Id" column when the "Orders" table is already created, use the following SQL:

MySQL / SQL Server / Oracle / MS Access:

ALTER TABLE Orders
ADD FOREIGN KEY (P_Id)
REFERENCES Persons(P_Id)

To DROP a FOREIGN KEY Constraint
To drop a FOREIGN KEY constraint, use the following SQL:

MySQL:

ALTER TABLE Orders
DROP FOREIGN KEY fk_PerOrders


<-----------  SQL CHECK Constraint on CREATE TABLE   ------------->

The following SQL creates a CHECK constraint on the "P_Id" column when the "Persons" table is created. The CHECK constraint specifies that the column "P_Id" must only include integers greater than 0.

MySQL:

CREATE TABLE Persons
(
P_Id int NOT NULL,
LastName varchar(255) NOT NULL,
FirstName varchar(255),
Address varchar(255),
City varchar(255),
CHECK (P_Id>0)
)
SQL Server / Oracle / MS Access:

CREATE TABLE Persons
(
P_Id int NOT NULL CHECK (P_Id>0),
LastName varchar(255) NOT NULL,
FirstName varchar(255),
Address varchar(255),
City varchar(255)
)
To allow naming of a CHECK constraint, and for defining a CHECK constraint on multiple columns, use the following SQL syntax:

MySQL / SQL Server / Oracle / MS Access:

CREATE TABLE Persons
(
P_Id int NOT NULL,
LastName varchar(255) NOT NULL,
FirstName varchar(255),
Address varchar(255),
City varchar(255),
CONSTRAINT chk_Person CHECK (P_Id>0 AND City='Sandnes')
)

SQL CHECK Constraint on ALTER TABLE
To create a CHECK constraint on the "P_Id" column when the table is already created, use the following SQL:

MySQL / SQL Server / Oracle / MS Access:

ALTER TABLE Persons
ADD CHECK (P_Id>0)
To allow naming of a CHECK constraint, and for defining a CHECK constraint on multiple columns, use the following SQL syntax:

MySQL / SQL Server / Oracle / MS Access:

ALTER TABLE Persons
ADD CONSTRAINT chk_Person CHECK (P_Id>0 AND City='Sandnes')

To DROP a CHECK Constraint
To drop a CHECK constraint, use the following SQL:

SQL Server / Oracle / MS Access:

ALTER TABLE Persons
DROP CONSTRAINT chk_Person
MySQL:

ALTER TABLE Persons
DROP CHECK chk_Person


<------------- SQL DEFAULT Constraint on CREATE TABLE  ------------>

The following SQL creates a DEFAULT constraint on the "City" column when the "Persons" table is created:

My SQL / SQL Server / Oracle / MS Access:

CREATE TABLE Persons
(
P_Id int NOT NULL,
LastName varchar(255) NOT NULL,
FirstName varchar(255),
Address varchar(255),
City varchar(255) DEFAULT 'Sandnes'
)
The DEFAULT constraint can also be used to insert system values, by using functions like GETDATE():

CREATE TABLE Orders
(
O_Id int NOT NULL,
OrderNo int NOT NULL,
P_Id int,
OrderDate date DEFAULT GETDATE()
)

SQL DEFAULT Constraint on ALTER TABLE
To create a DEFAULT constraint on the "City" column when the table is already created, use the following SQL:

MySQL:

ALTER TABLE Persons
ALTER City SET DEFAULT 'SANDNES'
SQL Server / MS Access:

ALTER TABLE Persons
ALTER COLUMN City SET DEFAULT 'SANDNES'
Oracle:

ALTER TABLE Persons
MODIFY City DEFAULT 'SANDNES'

To DROP a DEFAULT Constraint
To drop a DEFAULT constraint, use the following SQL:

MySQL:

ALTER TABLE Persons
ALTER City DROP DEFAULT
SQL Server / Oracle / MS Access:

ALTER TABLE Persons
ALTER COLUMN City DROP DEFAULT