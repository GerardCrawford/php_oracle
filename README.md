# Inserting and selecting data from Oracle DB via PHP
This project is a simple example of how to connect to an Oracle DB through PHP. Connection string is used to connect, a web form is used to collect user data and insert into DB table, then dynamically retrieves all data from DB table and iis echoed in html table on webpage.

Note: This project is focused on use in Windows 64bit, however 32 bit versions of all software used can also be utilised.

### Prerequisites

Windows 64/32 bit Machine.
At least 1.5 GB Disk space and 256 MB minimum RAM for Oracle installation (further info can be found at docs.oracle.com specific to which version of Windows you are using).
Web Browser for testing purposes.

### Install/Local Deployment

Download files/folder.
Download and install OracleXE 11G R2 64/32 bit version for Windows, dependant on your machine. (Instructions at docs.oracle.com)
Download and install XAMPP web server solution. (Instructions at www.apachefriends.org)
Download Instant Client Basic for Windows 64/32 bit, dependant on your machine. (http://www.oracle.com/technetwork/database/features/instant-client)

Place downloaded Github folder in 'htdocs' folder. (Found in the xampp directory, where you chose to save at installation)

During Oracle installation you should have created a username and password for your database (XE).
Launch Windows Command Line, or Powershell and type 'SQLPLUS' and hit enter, then enter you username and password to connect to Oracle Database.
Create a new tablespace and datafile name of your choice by entering the following code at command line and hitting enter;

CREATE BIGFILE TABLESPACE <tablespacename>
  DATAFILE <'datafilename.dbf'>
  SIZE 20M AUTOEXTEND ON;
  
To check that tablespace has been successfully created, enter the following code;
SELECT TABLESPACE_NAME from USER_TABLESPACES;

Now Create Table MYBOOKS using the following code;
CREATE TABLE MYBOOKS (title VARCHAR2(60), genre VARCHAR2(30), type VARCHAR2(30), author_name VARCHAR2(60), pub_year NUMBER(4))
TABLESPACE <tablespacename>
STORAGE ( INITIAL 50K);

Next open downloaded files in your chosen text editor and amend connection string in db.php to reflect your own username, password and machine details.

Launch XAMPP desktop application and start services.

Open browser and navigate to location of downloaded folder, (which you placed in 'htdocs' folder), e.g. http://localhost/<foldername>. This will automatically pick up the index.php file and webpage.

From here you should be able to enter data into the web form and when submit button is clicked, record added to the MYBOOKS table.
Function in index.php will also select this data from the MYBOOKS table and display in a table in webpage, populated dynamically each time a new record is added.


## Deployment

In order to deploy this on a live system, webpage would have to be hosted in web server, and accessed through a live domain.
This would also require the changing of the connection string db.php to reflect the domain and/or service(database) used.

## Built With

* [ORACLE Express x64] (http://www.oracle.com/) - The RDBMS used
* [ORACLE Instant Client x64] (http://www.oracle.com/) - Used to facilitate connection from PHP and DB using OCI8
* [XAMPP] (http://www.apachefriends.org/) - Web development environment used for PHP


## License

http://www.oracle.com/technetwork/licenses/database-11g-express-license-459621.html

 Creative Commons Attribution 3.0 License

## Acknowledgments

* PHP Manual Oracle connecton example (http://php.net/)
* Oracle Express (www.oracle.com)

