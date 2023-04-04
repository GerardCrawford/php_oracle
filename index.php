
<!DOCTYPE html>

<?php

//Use the db.php file and open connection...
include 'db.php';

// Before attempting to insert data from webpage, the table must first be created; Run the below code from command line through *SQLPLUS:
// CREATE TABLE MYBOOKS (title VARCHAR2(60), genre VARCHAR2(30), type VARCHAR2(30), author_name VARCHAR2(60), pub_year NUMBER(4)); 
// In order to test whether the table creation has been successful, use the the below query to insert a record;

//INSERT INTO MYBOOKS (title, genre, type, author_name, pub_year) VALUES ('Moby-Dick', 'Adventure/Fiction', 'Novel', 'Herman Melville', 1851);

//Then type... SELECT * FROM MYBOOKS;
//This will return the created record.

//'IF' the submit button is clicked on the webpage (after inserting data)...
if(isset($_POST['insert_record'])){
    
    
//... the INSERT statement (line 13) is populated with the user data entered.

$insert = oci_parse($conn, 'INSERT INTO MYBOOKS (title, genre, type, author_name, pub_year) VALUES(:title, :genre, :type, :author_name, :pub_year)');

///Assign form data to global variables...
$title=$_POST['title'];
$genre=$_POST['genre'];
$type=$_POST['type'];
$author_name=$_POST['author_name'];
$pub_year=$_POST['pub_year'];


//Use bind by name function for db performance and to enhance security...
oci_bind_by_name($insert, ':title', $title);
oci_bind_by_name($insert, ':genre', $genre);
oci_bind_by_name($insert, ':type', $type);
oci_bind_by_name($insert, ':author_name', $author_name);
oci_bind_by_name($insert, ':pub_year', $pub_year);

// Execute and commit the transaction...
$execute = oci_execute($insert);  


if ($execute) {
    //Uncomment below line if needed for testing
    
    //print "Row Inserted";
    
    //Parse and execute commit statement to oracle, committing transaction.
    $commit = oci_parse($conn, 'Commit');
oci_execute($commit);
}

oci_free_statement($insert);

}
?>

<html>
    
    <head>
        <!--link for css-->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
        <title>Insert Books</title>
    
    </head>
    
<body>
    <h1>My Books</h1>
<h2>Add a new book record:</h2>

    
<!--wrap form in div-->
<div class="form-div">
    
    <!--create form-->
    <form action="index.php" method="post" id="form">
    
        <!--create and label form fields, (assign type e.g. 'firstname' would be text, 'age' would be number-->
        <label for="title">Book Title</label><br>
        <input type="text" name="title" /><br><br>

        <label for="genre">Genre</label><br>
        <input type="text" name="genre" /><br><br>

        <label for="type">Type</label><br>
        <input type="text" name="type" /><br><br>

        <label for="author_name">Authors' Name</label><br>
        <input type="text" name="author_name" /><br><br>

        <label for="pub_year">Year Published (e.g. 2001)</label><br>
        <input type="number" name="pub_year" /><br><br><br>
    
        <!--create submit button-->
    <input type="submit" name="insert_record"/>

</form>
</div>
    
  <!--wrap table in div-->
    <div class="results">
    <?PHP

//parse and execute SQL statement to select all existing data from MYBOOKS table.
$stid = oci_parse($conn, 'SELECT * FROM MYBOOKS ORDER BY MYBOOKS.title ASC');
oci_execute($stid);

//Fetch data, and print out and populate table
echo "<table>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlspecialchars($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

?>

        </div>      
            
</body>
    
</html>

