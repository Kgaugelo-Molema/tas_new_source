<?php
//$servername = "gaea.sadomain.com";
$servername = "localhost";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";
$mysql_table = "ORGANISATIONALPROGRESS";


$conn = new mysqli($servername, $username, $password, '');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<br>");
} 
if (!$conn->select_db($dbname)) {
	die( "Error: Failed to select database '$dbname' ".$conn->error."<br>");
}

$sql = "SELECT `Programme/ Dept`, `YEAR`, `KPI`, `TARGET`, `ACTUAL`, `VARIANCE (%)` FROM ".$mysql_table;

?>
<html>
	<head>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
                <link rel="stylesheet" href="../styles/style.css">
	</head>
	<body>

<?php
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
        $row = $result->fetch_assoc();
        echo "<h5>Organisational Progress Report - CEO</h5>";
        
        $summtable = '<table class="summarydata">
                        <tbody>
                            <tr>
                              <th>Programme/ Dept</th><th>YEAR</th><th>KPI</th><th>TARGET</th><th>ACTUAL</th><th>VARIANCE (%)</th>
                            </tr>';
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $summtable .= "<tr>
                              <td>".$row["Programme/ Dept"]."</td><td>".$row["YEAR"]."</td><td>".$row["KPI"]."</td><td>".$row["TARGET"]."</td><td>".$row["ACTUAL"]."</td><td>".$row["VARIANCE (%)"]."</td>
                            </tr>";
        }
        $summtable .= " </tbody>
                      </table>";
        echo $summtable;
}
?>
            
    </body>
</html>