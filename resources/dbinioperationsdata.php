<?php
//require_once('/dbinitialisation.php');
//$servername = "gaea.sadomain.com";
$servername = "localhost";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";
$mysql_table = "operations";

$conn = new mysqli($servername, $username, $password, '');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<br>");
} 
if (!$conn->select_db($dbname)) {
	die( "Error: Failed to select database '$dbname' ".$conn->error."<br>");
}

$sqltext = "DELETE FROM $mysql_table ";

echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to delete data from table '$mysql_table' ".$conn->error."<br>");
}

$dataCols = "`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `STAT_TYPE`, `YEAR`, `QUARTER`, `PROVINCE`, `QTY`";


$sqltext = "INSERT INTO $mysql_table (".$dataCols.")
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','NoProj', 2017, 1, 'GP', 1)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}


$sqltext = "INSERT INTO $mysql_table (".$dataCols.")
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','NoJobs', 2017, 1, 'GP', 51)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}


$sql = "SELECT ".$dataCols." FROM $mysql_table";
$result = $conn->query($sql);
if (!$conn->query($sql)) {
	die( "Error: Failed to return data from table '$mysql_table' ".$conn->error."<br>");
}

if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["STAT_TYPE"]. " | " . $row["YEAR"]. " | " . $row["QUARTER"]. " | " . $row["QTY"]. "<br>";
		//`STAT_TYPE`, `YEAR`, `QUARTER`, `PROVINCE`, `QTY`
		$rowsremaining--;
		echo "Num_rows: ".$rowsremaining."<br>";
    }
} else {
    echo "0 results";
}
echo "<br><br>";


$result->free();
$conn->close();
?>