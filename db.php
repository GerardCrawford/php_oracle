<?PHP
// Connects to the database/service on the using the user(schema) and password.

//E.g. $conn = oci_connect('Paul', 'mypassword22', 'localhost/XE') - Connects to the XE database(service) on local machine, giving access to //tables in the 'Paul' schema using Pauls password. 

$conn = oci_connect('<username>', '<password>', '<machinename/service>');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>