<?php
//require_once('/dbinitialisation.php');
$servername = "localhost";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";

$conn = new mysqli($servername, $username, $password, '');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<br>");
} 
if (!$conn->select_db($dbname)) {
	die( "Error: Failed to select database '$dbname' ".$conn->error."<br>");
}

$mysql_table = 'OPERATIONS';
$sqltext = "DELETE FROM $mysql_table";

echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	echo( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
echo "<br>";

$mysql_table = 'PROGRAMS';
$sqltext = "DELETE FROM $mysql_table";

echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	echo( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
echo "<br>";

$mysql_table = 'BUDGETS';
$sqltext = "DELETE FROM $mysql_table";

echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	echo( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
echo "<br>";

$conn->close();
?>