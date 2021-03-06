<?php
$servername = "localhost";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";
$mysql_table = "BUDGETS";

$conn = new mysqli($servername, $username, $password, '');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<br>");
} 
if (!$conn->select_db($dbname)) {
	die( "Error: Failed to select database '$dbname' ".$conn->error."<br>");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `YEAR`, `QUARTER`, `PROVINCE`, `BUDGET`, QTY)
                       VALUES ('".date("Y-m-d")."',
                       '".date("G:i:s")."',
                       '".$_SERVER['REMOTE_ADDR']."',
                       '".$_SERVER['HTTP_USER_AGENT']."'";
    $inputvalues = $_POST["year"].",'".$_POST["quater"]."','".$_POST["prov_cd"]."',".$_POST["budget"].",".$_POST["qty"];
    $sqltext = $sqltext.",".$inputvalues.")";

    if (!$conn->query($sqltext)) {
        echo "$sqltext<br>";
        die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
    }
}

?>
<html>
	<head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="icon" type="image/png" href="../images/prodsaemblemicon.png">
            <link rel="stylesheet" href="../styles/style.css">
            <script src="../js/scripts.js"></script>
	</head>
	<body>
            <h3>Budget Details</h3>
            <form name="BgtDetailsForm" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1">
<?php
$sql = "SELECT PROV_CODE, DESCRIPTION FROM PROVINCES";
$result = $conn->query($sql);
if (!$conn->query($sql)) {
    die( "Error: Failed to return data from table PROVINCES ".$conn->error."<br>");
}

    echo '<select name="prov_cd">';
    echo '  <option value="none">--Select Province--</option>';
    if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
        $row = $result->fetch_assoc();
        
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.$row["PROV_CODE"].'"> '.$row["DESCRIPTION"].'</option>';
        }
    }
    echo '</select>';
    echo '&nbsp;';

?>
                <select name="quater">
                    <option value="none">--Select Quarter--</option>
                    <option value="1">Quarter 1</option>
                    <option value="2">Quarter 2</option>
                    <option value="3">Quarter 3</option>
                    <option value="4">Quarter 4</option>
                </select>
                <br><br>
                <input type="number" id="year" name="year" value="" placeholder="Year">&nbsp;
                <input type="number" id="qty" name="qty" value="" placeholder="Quantity"><br><br>
                <input type="number" id="budget" name="budget" value="" placeholder="Budget"><br><br>
                <input type="reset" id="ResetBtn" name="" value="Reset">&nbsp;
                <input type="submit" id="SubmitBtn" name="" value="Submit" onclick="return checktasform(this.form)">
            </form>
<?php
    $sql = "SELECT YEAR, QUARTER, PROVINCE, QTY, QTY_PCT, FORMAT(BUDGET,2) 'BUDGET' FROM BUDGETS ";
    $result = $conn->query($sql);
    $datatable = "<h5>No budget data captured</h5>";
    if ($result->num_rows > 0) {
        $datatable = '<table class="summarydata">
                        <tbody>
                            <tr>
                              <th>Year</th><th>Quarter</th><th>Province</th><th>Quantity</th><th>Percentage</th><th>Budget</th>
                            </tr>';
        while($row = $result->fetch_assoc()) {
            $datatable .= "<tr>
                              <td>".$row["YEAR"]."</td><td>".$row["QUARTER"]."</td><td>".$row["PROVINCE"]."</td><td>".$row["QTY"]."</td><td>".$row["QTY_PCT"]."</td><td>".$row["BUDGET"]."</td>
                            </tr>";
        }
        $datatable .= " </tbody>
                      </table>";
    }
    echo $datatable;    
?>            
        </body>
</html>
