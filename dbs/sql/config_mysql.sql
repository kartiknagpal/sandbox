#start mysql daemon
> mysqld

#test connection in a new cmd window
> telnet localhost 3306

#delete a user
DROP USER 'kartik'@'localhost';

# create a new user in MySQL and give it full access only to 1 database eg. dbTest all tables
GRANT ALL PRIVILEGES ON dbTest.* To 'user'@'hostname' IDENTIFIED BY 'password';