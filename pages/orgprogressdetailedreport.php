<?php
//$servername = "gaea.sadomain.com";
$servername = "localhost";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";
$mysql_table = "ORGPROGRESSDETAILED";


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
<?php            
    $sql = "SELECT `Programme/ Dept`, `YEAR`, QUARTER, PROVINCE, `DESCRIPTION`, `TARGET`, `ACTUAL`, `VARIANCE (%)`, `OBJECTIVE MET?` FROM ".$mysql_table;
    $filtervalues = "(STAT_TYPE = '".$_GET["kpi"]."')";
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $mysql_table = "ORGPROGRESSFILTERERD";
        if ($_POST["year"] != "none") {
            $filtervalues .= " AND (YEAR = ".$_POST["year"].") ";
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
                $filtervalues .= " AND (PROG_PROV = '".$_POST["prov_cd"]."') AND  (OPS_PROV = '".$_POST["prov_cd"]."')";
            }
        }
    }
    if ($filtervalues != "") {
        $sql .= " WHERE " . $filtervalues;
    }
    $result = $conn->query($sql);
    if (!$conn->query($sql)) {
        echo $sql;
        die( "Error: Failed to return data from table ".$mysql_table. " " .$conn->error."<br>");
    }

    if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
        $row = $result->fetch_assoc();
        $captionsql = "SELECT DESCRIPTION FROM STAT_TYPES WHERE STAT_TYPE = '".$_GET["kpi"]."'";
        $result = $conn->query($captionsql);
        $captionrow = $result->fetch_assoc();
        $filtercaption = "<h4>[".$captionrow["DESCRIPTION"]."]</h4>";
        $datatable = '<table>
                        <caption>'.$filtercaption.'</caption>
                        <tbody>
                            <tr>
                              <th>Programme/ Dept</th><th>YEAR</th><th>Province</th><th>OBJECTIVE MET?</th><th>QUARTER</th><th>TARGET</th><th>ACTUAL</th><th>VARIANCE (%)</th>
                            </tr>';
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $datatable .= "<tr>
                              <td>".$row["Programme/ Dept"]."</td><td>".$row["YEAR"]."</td><td>".$row["PROVINCE"]."</td><td>".$row["OBJECTIVE MET?"]."</td><td>".$row["QUARTER"]."</td><td>".$row["TARGET"]."</td><td>".$row["ACTUAL"]."</td><td>".$row["VARIANCE (%)"]."</td>
                            </tr>";
        }
        $datatable .= " </tbody>
                      </table>";
        echo $datatable;
    }
    else {
        $sql = "SELECT DESCRIPTION FROM STAT_TYPES WHERE STAT_TYPE = '".$_GET["kpi"]."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo "<h5>No data captured for KPI '".$row["DESCRIPTION"]."'</h5>";
    }
?>
            <br><br>
            <h5><a href="../pages/organisationalprogressreport.php" target="_blank" title="Open Report">Open report in new window</a></h5>
    </body>
</html>