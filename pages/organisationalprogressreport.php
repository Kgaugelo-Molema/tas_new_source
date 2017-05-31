<?php
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

?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/reportstyle.css">
    </head>
    <body>
        <form name="OrgReportFilter" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1">
        
<?php
        echo "<h3>Organisational Progress Report</h3>";
        echo "<br><br>";

        $filtersql = "SELECT DISTINCT YEAR FROM ORGANISATIONALPROGRESS";
        $filterresult = $conn->query($filtersql);
        if (!$conn->query($filtersql)) {
            die( "Error: Failed to return data from table ORGANISATIONALPROGRESS ".$conn->error."<br>");
        }
            echo "FILTER : "; 
            echo '<select name="year">';
            echo '  <option value="none">--Select Year--</option>';
            if ($filterresult->num_rows > 0) {
                $rowsremaining = $filterresult->num_rows;
                $row = $filterresult->fetch_assoc();

                $filterresult = $conn->query($filtersql);
                while($row = $filterresult->fetch_assoc()) {
                    echo '<option value="'.$row["YEAR"].'"> '.$row["YEAR"].'</option>';
                }
            }
            echo "</select>";
        
        $filtersql = "SELECT PROV_CODE, DESCRIPTION FROM PROVINCES";
        $filterresult = $conn->query($filtersql);
        if (!$conn->query($filtersql)) {
            die( "Error: Failed to return data from table PROVINCES ".$conn->error."<br>");
        }
            echo '<select name="prov_cd">';
            echo '  <option value="none">--Select Province--</option>';
            if ($filterresult->num_rows > 0) {
                $rowsremaining = $filterresult->num_rows;
                $row = $filterresult->fetch_assoc();

                $filterresult = $conn->query($filtersql);
                while($row = $filterresult->fetch_assoc()) {
                    echo '<option value="'.$row["PROV_CODE"].'"> '.$row["DESCRIPTION"].'</option>';
                }
            }
            echo "</select>";

            
?>
            <select name="quarter">
                <option value="none">--Select Quarter--</option>
                <option value="1">Quarter 1</option>
                <option value="2">Quarter 2</option>
                <option value="3">Quarter 3</option>
                <option value="4">Quarter 4</option>
            </select>
            <input type="reset" id="ResetBtn" name="" value="Reset">&nbsp;
            <input type="submit" id="SubmitBtn" name="" value="Submit" onclick="">
        </form>
        <br>    
<?php            
    $sql = "SELECT `Programme/ Dept`, `YEAR`, `KPI`, `TARGET`, `ACTUAL`, `VARIANCE (%)`, `OBJECTIVE MET?` FROM ".$mysql_table;
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $mysql_table = "ORGPROGRESSFILTERERD";
        $filtervalues = "";
        if ($_POST["year"] != "none") {
            $filtervalues = " (YEAR = ".$_POST["year"].") ";
        }
        if ($_POST["quarter"] != "none") {
            if ($filtervalues != "") {
                $filtervalues .= " AND  (PROG_QUARTER = ".$_POST["quarter"].") AND (OPS_QUARTER = ".$_POST["quarter"].") ";
            }
            else {
                $filtervalues = " (PROG_QUARTER = ".$_POST["quarter"].") AND  (OPS_QUARTER = ".$_POST["quarter"].") ";
            }
        }
        if ($_POST["prov_cd"] != "none") {
            if ($filtervalues != "") {
                $filtervalues .= " AND  (PROG_PROV = '".$_POST["prov_cd"]."') AND  (OPS_PROV = '".$_POST["prov_cd"]."')";
            }
            else {
                $filtervalues = " (PROG_PROV = '".$_POST["prov_cd"]."') AND  (OPS_PROV = '".$_POST["prov_cd"]."')";
            }
        }
        if ($filtervalues != "") {
            $sql = "SELECT `Programme/ Dept`, `YEAR`, `KPI`, `TARGET`, `ACTUAL`, `VARIANCE (%)`, `OBJECTIVE MET?` FROM ".$mysql_table;
            $sql .= " WHERE " . $filtervalues;
            echo $sql;
        }
    }
    $result = $conn->query($sql);
    if (!$conn->query($sql)) {
        echo $sql;
        die( "Error: Failed to return data from table ".$mysql_table. " " .$conn->error."<br>");
    }

    if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
        $row = $result->fetch_assoc();
        $filtercaption = "<h4>[All provinces] [All quarters]</h4>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $filtercaption = "";
            if ($_POST["year"] != "none") {
                $filtercaption .= "[Year: ".$_POST["year"]."] ";
            }
            if ($_POST["prov_cd"] != "none") {
                $filtercaption .= "[Province: ".$_POST["prov_cd"]."] ";
            }
            if ($_POST["quarter"] != "none") {
                $filtercaption .= "[Quarter: ".$_POST["quarter"]."] ";
            }
        }
        $summtable = '<table>
                        <caption>'.$filtercaption.'</caption>
                        <tbody>
                            <tr>
                              <th>Programme/ Dept</th><th>YEAR</th><th>KPI</th><th>OBJECTIVE MET?</th><th>TARGET</th><th>ACTUAL</th><th>VARIANCE (%)</th>
                            </tr>';
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $summtable .= "<tr>
                              <td>".$row["Programme/ Dept"]."</td><td>".$row["YEAR"]."</td><td>".$row["KPI"]."</td><td>".$row["OBJECTIVE MET?"]."</td><td>".$row["TARGET"]."</td><td>".$row["ACTUAL"]."</td><td>".$row["VARIANCE (%)"]."</td>
                            </tr>";
        }
        $summtable .= " </tbody>
                      </table>";
        echo $summtable;
}
?>
            <br><br>
            <h5><a href="../pages/organisationalprogressreport.php" target="_blank" title="Open Report">Open report in new window</a></h5>
    </body>
</html>