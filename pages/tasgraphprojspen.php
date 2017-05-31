<?php
$servername = "gaea.sadomain.com";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";
$mysql_table = "ORGANISATIONALPROGRESS";
$StatType = "ProjSpen";

$conn = new mysqli($servername, $username, $password, '');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<br>");
} 
if (!$conn->select_db($dbname)) {
	die( "Error: Failed to select database '$dbname' ".$conn->error."<br>");
}

$sql = "SELECT `KPI`, ACTUAL, BALANCE, TARGET FROM " .$mysql_table. " WHERE STAT_TYPE = '".$StatType."'";

?>
<html>
	<head>
		<script src="../js/Chart.min.js"></script>
                <link rel="stylesheet" href="../styles/style.css">
	</head>
	<body>

<?php
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
        $row = $result->fetch_assoc();
        echo "<h5>".$row["KPI"]."</h5>";
        
        $summtable = '<table class="summarydata">
                        <tbody>
                            <tr>
                              <td></td><th>ACTUAL</th><th>BALANCE</th><th>TARGET</th>
                            </tr>';
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $summtable .= "<tr>
                              <td>".$row["KPI"]."</td><td>".$row["ACTUAL"]."</td><td>".$row["BALANCE"]."</td><td>".$row["TARGET"]."</td>
                            </tr>";
        }
        $summtable .= " </tbody>
                      </table>";
        echo $summtable;
}
?>
            
            <br><br>
                <canvas id="myChart" width="200px" height="100px"></canvas>
		<script>
			var ctx = document.getElementById("myChart").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'doughnut',
				data: {

<?php
$labels = "labels: [";
$sql = "SELECT 'ACTUAL' AS 'DESC', ACTUAL 'VALUE', KPI 'STAT' FROM " .$mysql_table. " WHERE STAT_TYPE = '".$StatType."' ";
$sql .= "UNION "; 
$sql .= "SELECT 'BALANCE' AS 'DESC', BALANCE 'VALUE', KPI 'STAT' FROM " .$mysql_table. " WHERE STAT_TYPE = '".$StatType."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo $row["PROVINCE"]. " | " . $row["REGISTERED"]. " | " . $row["OPEN"]. " | " . $row["CLOSED"]. " | " . "<br>";
		$labels .= "'".$row["DESC"]."'";
		$rowsremaining--;
		if ($rowsremaining > 0) {
			$labels .= ",";
		}
		//echo "Num_rows: ".$rowsremaining."<br>";
    }
	$labels .= "],";
} else {
    echo "0 results";
}
//echo "<br><br>";


echo $labels;
?>
					datasets: [{
						label: 'No. of Projects',
						
<?php

						//data: [8,21,7,12,4,27],
$data = "data: [";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo $row["PROVINCE"]. " | " . $row["REGISTERED"]. " | " . $row["OPEN"]. " | " . $row["CLOSED"]. " | " . "<br>";
		$data .= $row["VALUE"];
		$rowsremaining--;
		if ($rowsremaining > 0) {
			$data .= ",";
		}
		//echo "Num_rows: ".$rowsremaining."<br>";
    }
	$data .= "],";
} else {
    echo "0 results";
}
echo $data;

?>						
						
						backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(255, 159, 64, 0.2)'
						],
						borderColor: [
							'rgba(255,99,132,1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero:true
							}
						}]
					}
				}
			});
		</script>
	</body>
</html>