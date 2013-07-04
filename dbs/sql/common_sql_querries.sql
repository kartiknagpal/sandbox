+-----------+
| DATABASES |
+-----------+

#list all databases
SHOW DATABASES;

#use a database
USE `db_name`;

#creating a new database - login into mysql -u root
CREATE DATABASE `database_name`;

#droping a database, i.e deleting a database	
DROP DATABASE database_name



+-----------+
|  TABLES 	|
+-----------+

#show all tables after selecting a database
SHOW TABLES;

#show table structure
DESCRIBE `table_name`;

#creating a new table after selecting a database	
CREATE TABLE `table_name`
(
column_name1 data_type,
column_name2 data_type,
column_name2 data_type,
...
);

#droping a table	
DROP TABLE table_name

#indexing a column in a table
CREATE INDEX `index_name`
ON `table_name` (`column_name`);

or

CREATE UNIQUE INDEX `index_name`
ON `table_name` (`column_name`);

#droping indexing from a column	
DROP INDEX table_name.index_name (SQL Server)
DROP INDEX index_name ON table_name (MS Access)
DROP INDEX index_name (DB2/Oracle)
ALTER TABLE table_name
DROP INDEX index_name (MySQL)

#altering,i.e, creating or deleting a table column
ALTER TABLE `table_name` 
ADD `column_name` datatype

or

ALTER TABLE table_name 
DROP COLUMN column_name

#using alias name for column: AS (alias)	
SELECT `column_name` AS `column_alias`
FROM `table_name`

#using alias name for table_name: AS (alias)	
SELECT `column_name`
FROM `table_name`  AS `table_alias`


+-----------+
| 	ROWS	|
+-----------+

#inserting into table values	
INSERT INTO `table_name`
VALUES (value1, value2, value3,....);

or

INSERT INTO `table_name`
(column1, column2, column3,...)
VALUES (value1, value2, value3,....);


#deleting row(s) from a table, using DELETE keyword:	
DELETE FROM `table_name`
WHERE `some_column`=some_value;
or
DELETE FROM `table_name`; 
(Note: Deletes the entire table!!)
or
DELETE * FROM `table_name`; 
(Note: Deletes the entire table!!)

#updating rows in a table	
UPDATE table_name
SET column1=value, column2=value,...
WHERE some_column=some_value

#----------------	FILTERING ROWS 	---------------# 
#using SELECT keyword:	
SELECT column_name(s)
FROM table_name;
or
SELECT *
FROM table_name;
or
SELECT DISTINCT column_name(s)
FROM table_name;

#using AND / OR	keywords
SELECT column_name(s)
FROM table_name
WHERE condition
AND|OR condition;

#using BETWEEN	keyword
SELECT column_name(s)
FROM table_name
WHERE column_name
BETWEEN value1 AND value2

#using IN keyword:	
SELECT column_name(s)
FROM table_name
WHERE column_name
IN (value1,value2,..);

#using WHERE keyword	
SELECT column_name(s)
FROM table_name
WHERE column_name operator value

#using LIKE keyword:	
SELECT column_name(s)
FROM table_name
WHERE column_name LIKE pattern

#using ORDER BY keyword:	
SELECT column_name(s)
FROM table_name
ORDER BY column_name [ASC|DESC]



#The GROUP BY Statement
#The GROUP BY statement is used in conjunction with the aggregate functions 
#to group the result-set by one or more columns.

SELECT column_name, aggregate_function(column_name)
FROM table_name
WHERE column_name operator value
GROUP BY column_name;

#-------------	JOIN	-------------#
#INNER JOIN:
SELECT column_name(s)
FROM table_name1
INNER JOIN table_name2 
ON table_name1.column_name=table_name2.column_name
#LEFT JOIN:	
SELECT column_name(s)
FROM table_name1
LEFT JOIN table_name2 
ON table_name1.column_name=table_name2.column_name
#RIGHT JOIN:	
SELECT column_name(s)
FROM table_name1
RIGHT JOIN table_name2 
ON table_name1.column_name=table_name2.column_name
#FULL JOIN:	
SELECT column_name(s)
FROM table_name1
FULL JOIN table_name2 
ON table_name1.column_name=table_name2.column_name

#-----------	UNION	-----------#	
SELECT column_name(s) FROM table_name1
UNION
SELECT column_name(s) FROM table_name2

#UNION ALL:	
SELECT column_name(s) FROM table_name1
UNION ALL
SELECT column_name(s) FROM table_name2

