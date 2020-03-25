<?php
include('MySQL.php');
$message = '';
//problem: uploads even when eid column are empty 
if (isset($_POST["upload"])) {
    if ($_FILES['PatientInfo']['name']) {
        $filename = explode(".", $_FILES['PatientInfo']['name']);
        if (end($filename) == "csv") {
            $handle = fopen($_FILES['PatientInfo']['tmp_name'], "r");
            fgetcsv($handle, 10000, ",");
            if (($column = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $sqlcmd = "INSERT into PatientInfo (ph_id,diagnosis_one,diagnosis_two,oxygen_lvl,special_endorsement,username,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,date)
                   values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "','" . $column[7] . "','" . $column[8] . "','" . $column[9] . "','" . $column[10] . "','" . $column[11] . "','" . $column[12] . "','" . $column[13] . "')";

                $result = mysqli_query($mysqlconn, $sqlcmd);

                if (!empty($result)) {
                    $type = "success";
                    $message = "CSV Data Imported into the Database";
                } else {
                    $type = "error";
                    $message = "Problem in Importing CSV Data";
                }
            }
        }
        fclose($handle);
// header("location: UpdateTable.php?updation=1");
    } else {
        $message = '<label class="text-danger">Please Select CSV File only</label>';
    }
} else {
    $message = '<label class="text-danger">Please Select File</label>';
}


$sqlcmd = "SELECT * FROM PatientInfo";
$result = mysqli_query($mysqlconn, $sqlcmd);
?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    </head>
    <body>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#frmCSVImport").on("submit", function () {

                    $("#response").attr("class", "");
                    $("#response").html("");
                    var fileType = ".csv";
                    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
                    if (!regex.test($("#file").val().toLowerCase())) {
                        $("#response").addClass("error");
                        $("#response").addClass("display-block");
                        $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
                        return false;
                    }
                    return true;
                });
            });
        </script>

        <div class="container">
            <br />

            <form class="form-horizontal" action="" method="post"
                  enctype="multipart/form-data">    
                <h3><label>Please Select File (CSV Format Only)</label></h3>
                <input type="file" name="PatientInfo" /></p>
                <br />
                <input type="submit" name="upload"  value="Upload" />
            </form>
            <?php echo $message; ?>
            <br />
            <div class="table">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID#</th>
                        <th>Diagnosis 1</th>
                        <th>Diagnosis 2</th>
                        <th>oxygen_lvl</th>
                        <th>special_endorsement</th>
                        <th>physician</th>
                        <th>status</th>
                        <th>ward</th>
                        <th>bed_no</th>
                        <th>admission_no</th>
                        <th>hosp_no</th>
                        <th>admission_date</th>
                        <th>disposition</th>
                        <th>date</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['ph_id'] . "</td>";
                        echo "<td>" . $row['diagnosis_one'] . "</td>";
                        echo "<td>" . $row['diagnosis_two'] . "</td>";
                        echo "<td>" . $row['oxygen_lvl'] . "</td>";
                        echo "<td>" . $row['special_endorsement'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['ward'] . "</td>";
                        echo "<td>" . $row['bed_no'] . "</td>";
                        echo "<td>" . $row['admission_no'] . "</td>";
                        echo "<td>" . $row['hosp_no'] . "</td>";
                        echo "<td>" . $row['admission_date'] . "</td>";
                        echo "<td>" . $row['disposition'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <br>
            <input type="button" class="btn-submit" value="Export" onclick="window.location.href = 'Export.php'" />

        </div>

    </body>
</html>


