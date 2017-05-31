<?php
$servername = "localhost";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";
$mysql_table = "OPERATIONS";

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
    $sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `STAT_TYPE`, `YEAR`, `QUARTER`, `PROVINCE`, `QTY`)
                       VALUES ('".date("Y-m-d")."',
                       '".date("G:i:s")."',
                       '".$_SERVER['REMOTE_ADDR']."',
                       '".$_SERVER['HTTP_USER_AGENT']."'";
    $inputvalues = "'".$_POST["kpi_cd"]."',".$_POST["year"].",'".$_POST["quater"]."','".$_POST["prov_cd"]."',".$_POST["qty"];
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
            <link rel="stylesheet" href="../styles/style.css">
            <script src="../js/scripts.js"></script>
	</head>
	<body>
            <h5>Project Details</h5>
            <form name="PrjDetailsForm" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1">
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
    echo '<br><br>';

$sql = "SELECT STAT_TYPE, DESCRIPTION FROM STAT_TYPES";
$result = $conn->query($sql);
if (!$conn->query($sql)) {
    die( "Error: Failed to return data from table STAT_TYPES ".$conn->error."<br>");
}

    echo '<select name="kpi_cd">';
    echo '  <option value="none">--Select KPI--</option>';
    if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
        $row = $result->fetch_assoc();
        
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.$row["STAT_TYPE"].'"> '.$row["DESCRIPTION"].'</option>';
        }
    }
    echo '</select>';
    echo '<br><br>';

?>
                <select name="quater">
                    <option value="none">--Select Quarter--</option>
                    <option value="1">Quarter 1</option>
                    <option value="2">Quarter 2</option>
                    <option value="3">Quarter 3</option>
                    <option value="4">Quarter 4</option>
                </select>
                <br><br>
                <input type="number" id="year" name="year" value="" placeholder="Year"><br><br>
                <input type="number" id="qty" name="qty" value="" placeholder="Quantity"><br><br>
                <input type="reset" id="ResetBtn" name="" value="Reset"><br><br>
                <input type="submit" id="SubmitBtn" name="" value="Submit" onclick="return checktasform(this.form)">
            </form>
        </body>
</html>
