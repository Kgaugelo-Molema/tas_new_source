<?php
$servername = "localhost";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";
$mysql_table = "PROGRAMS";

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
    //Get the captured province budget ID
    $sqlBudgetId = "SELECT BUDGET_ID, QTY FROM BUDGETS WHERE PROVINCE = '".$_POST["prov_cd"]."' AND 
            DATESTAMP = (SELECT MAX(DATESTAMP) FROM BUDGETS WHERE PROVINCE = '".$_POST["prov_cd"]."' ) AND 
            TIME = (SELECT MAX(TIME) FROM BUDGETS WHERE PROVINCE = '".$_POST["prov_cd"]."' )";
    $result = $conn->query($sqlBudgetId);
    if (!$conn->query($sqlBudgetId)) {
        die( "Error: Failed to get budget details from '$mysql_table' ".$conn->error."<br>");
    }

    $budget_id = 0;
    $budget_qty = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();        
        $budget_id = $row["BUDGET_ID"]; 
        $budget_qty = $row["QTY"];
    }
    
    $edit_pct = $_POST["pct"];
    if (empty($edit_pct)) {
        $edit_pct = $budget_qty;
    }
    
    $sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `STAT_TYPE`, `YEAR`, `QUARTER`, `PROVINCE`, `QTY`, `QTY_PCT`, `BUDGET_ID`)
                       VALUES ('".date("Y-m-d")."',
                       '".date("G:i:s")."',
                       '".$_SERVER['REMOTE_ADDR']."',
                       '".$_SERVER['HTTP_USER_AGENT']."'";
    $inputvalues = "'".$_POST["kpi_cd"]."',".$_POST["year"].",'".$_POST["quater"]."','".$_POST["prov_cd"]."',".$_POST["qty"].",".$edit_pct.",".$budget_id;
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
            <h3>Program Details</h3>
            <form name="PrgDetailsForm" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1">
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
            &nbsp;
            <input type="number" id="year" name="year" value="" placeholder="Year"><br><br>
            <input type="number" id="qty" name="qty" value="" placeholder="Quantity" onchange="calcPct(this.form)">&nbsp;
            <input type="number" id="pct" name="pct" value="" placeholder="Qty Percentage" onchange="calcPct(this.form)"><br><br>
            <input type="reset" id="ResetBtn" name="" value="Reset">&nbsp;
            <input type="submit" id="SubmitBtn" name="" value="Submit" onclick="return checktasform(this.form)">
<?php
    $sqlBudgetList = "SELECT BUDGET_ID, QTY, PROVINCE, BUDGET, QUARTER, YEAR FROM BUDGETS 
                        WHERE DATESTAMP IN (SELECT MAX(DATESTAMP) 
                                           FROM BUDGETS WHERE  
                                           TIME IN (SELECT MAX(TIME) 
                                                   FROM BUDGETS
                                                  GROUP BY PROVINCE)
                                            GROUP BY PROVINCE)";
    $result = $conn->query($sqlBudgetList);
    if (!$conn->query($sqlBudgetList)) {
        die( "Error: Failed to return budget data ".$conn->error."<br>");
    }

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<input type="hidden" name="budget'.$row["PROVINCE"].'Qty" value="'.$row["QTY"].'">';
        }
    }
?>
        </form>
<?php
    $sql = "SELECT s.DESCRIPTION, b.YEAR, b.QUARTER, b.PROVINCE, p.QTY, p.QTY_PCT, FORMAT(b.BUDGET,2) 'BUDGET' 
            FROM PROGRAMS p JOIN BUDGETS b ON b.BUDGET_ID = p.BUDGET_ID
            JOIN STAT_TYPES s ON s.STAT_TYPE = p.STAT_TYPE";
    
    $result = $conn->query($sql);
    $datatable = "<h5>No program data captured</h5>";
    if ($result->num_rows > 0) {
        $datatable = '<table class="summarydata">
                        <tbody>
                            <tr>
                              <th>Description</th><th>Year</th><th>Quarter</th><th>Province</th><th>Quantity</th><th>Percentage</th><th>Budget<th>
                            </tr>';
        while($row = $result->fetch_assoc()) {
            $datatable .= "<tr>
                              <td>".$row["DESCRIPTION"]."</td><td>".$row["YEAR"]."</td><td>".$row["QUARTER"]."</td><td>".$row["PROVINCE"]."</td><td>".$row["QTY"]."</td><td>".$row["QTY_PCT"]."</td><td>".$row["BUDGET"]."</td>
                            </tr>";
        }
        $datatable .= " </tbody>
                      </table>";
    }
    echo $datatable;    
?>            
    </body>
</html>
