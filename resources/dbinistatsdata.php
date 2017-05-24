<?php
//require_once('/dbinitialisation.php');
$servername = "gaea.sadomain.com";
//$servername = "localhost";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";
$mysql_table = "STATS";

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
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}

$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `STAT_TYPE`, `DESCRIPTION`, `ACTUAL`, `BALANCE`, `TARGET`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','NoProj','Number of Projects',40,100,140)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}

$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `STAT_TYPE`, `DESCRIPTION`, `ACTUAL`, `BALANCE`, `TARGET`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','ProjSpen','Project Spend (R)', 23000000,39000000,60000000)";

echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
				   
$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `STAT_TYPE`, `DESCRIPTION`, `ACTUAL`, `BALANCE`, `TARGET`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','ProjProg','Project Progress(%)',33,67,100)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
				   
$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `STAT_TYPE`, `DESCRIPTION`, `ACTUAL`, `BALANCE`, `TARGET`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','NoJobs','Number of Jobs',1454,2869,3920)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
				   

$labels = "labels: [";

$sql = "SELECT `STAT_TYPE`, `DESCRIPTION`, `ACTUAL`, `BALANCE`, `BROWSER`, `TARGET` FROM $mysql_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["STAT_TYPE"]. " | " . $row["DESCRIPTION"]. " | " . $row["ACTUAL"]. " | " . $row["BALANCE"]. " | " . $row["TARGET"]. " | " . "<br>";
		$labels .= "'".$row["STAT_TYPE"]."'";
		$rowsremaining--;
		if ($rowsremaining > 0) {
			$labels .= ",";
		}
		echo "Num_rows: ".$rowsremaining."<br>";
    }
	$labels .= "]";
} else {
    echo "0 results";
}
echo "<br><br>";


echo $labels;

$result->free();
$conn->close();
?>