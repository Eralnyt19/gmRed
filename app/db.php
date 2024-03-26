<?php
$servername = "localhost";
$username = "xxx";
$password = "yyy"; //  in upper case: NCV6(5D8EL note v and l in lower case 
$dbname = "zzz";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
