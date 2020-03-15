<?php
include ('MySQL.php');
session_start();

if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}
?>
<?php
$username = mysqli_real_escape_string($mysqlconn, $_SESSION['username']);

if (isSet($_POST['Export'])) {

    $sqlSelect = "SELECT Patient.*, PatientInfo.*
                                     FROM Patient
                                     INNER JOIN PatientInfo
                                     ON (Patient.ph_id = PatientInfo.ph_id)";
    $result = mysqli_query($mysqlconn, $sqlSelect);

    $num_column = mysqli_num_fields($result);

    $csv_header = '';
    for ($i = 0; $i < $num_column; $i++) {
        $csv_header .= '"' . mysqli_fetch_field_direct($result, $i)->name . '",';
    }
    $csv_header .= "\n";

    $csv_row = '';
    while ($row = mysqli_fetch_row($result)) {
        for ($i = 0; $i < $num_column; $i++) {
            $csv_row .= '"' . $row[$i] . '",';
        }
        $csv_row .= "\n";
    }

    /* Download as CSV File */
    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename=patientinfo.csv');
    echo $csv_header . $csv_row;
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>TRAST</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
        <link rel="stylesheet" href="./style3.css">

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="./table.css">

        <style>
            .select:hover {background-color:#f5f5f5;}
        </style>
    </head>
    <body>
        <!-- partial:index.partial.html -->
        <div id="viewport">
            <!-- Sidebar -->
            <div id="sidebar">
                <br>
                <br>
                <header>
                    <a id="header" > 
                        <br> 
                        <img src="usthlogo.png" style="width:70%;">
                        <br>

                        TRAST
                    </a>

                </header>
                <ul class="nav">
                    <br>
                    <li>
                        <a href="UserHomepage.php">
                            <i class="zmdi zmdi-search"></i> Search Patient
                        </a>
                    </li>
                    <li>
                        <a href="NewPatient.php">
                            <i class="zmdi zmdi-accounts-add"></i> New Patient
                        </a>
                    </li>
                    <li>
                        <a href="HelpPage.php">
                            <i class="zmdi zmdi-help-outline"></i> Help
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="zmdi zmdi-calendar"></i> About
                        </a>
                    </li>

                    <li>


                        <!-- <a href="#">
                          <i class="zmdi zmdi-info-outline"></i> Log Out
                        </a>
                      </li> -->
                        <!-- <li>
                          <a href="#">
                            <i class="zmdi zmdi-settings"></i> Services
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <i class="zmdi zmdi-comment-more"></i> Contact
                          </a>
                        </li> -->
                </ul>
            </div>
            <!-- Content -->
            <div id="content">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav navbar-left">

                            <li> <h3 class="mb-4">TRAST: Thrombosis Risk Assessment System</h3></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li> 

                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['username']; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="UsersTickets.php">Tickets</a></li>
                                    <li><a href="UsersPatient.php">Patients</a></li>
                                    <li><a href="UsersSchedule.php">Schedules</a></li>
                                    <li><a href="UsersChangePW.php">Change Password</a></li>
                                </ul>
                            </li>

                            <li><a href="Logout.php">Log Out</a></li></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">


                    <div id="content" class="p-4 p-md-5 pt-5">
                        <!--                        <h2 class="mb-4">TRAST: Thrombosis Risk Assessment System</h2>-->
                        <p>	     
                        <div class="mb-5">
                            <br>

                            <h3 class="h6 mb-3"></h3>
                            <h2>Patients List</h2>
                            <?php
                            include('MySQL.php');
                            $message = '';
//problem: uploads even when eid column are empty 
                            if (isset($_POST["upload"])) {
                                if ($_FILES['PatientList']['name']) {
                                    $filename = explode(".", $_FILES['PatientList']['name']);
                                    if (end($filename) == "csv") {
                                        $handle = fopen($_FILES['PatientList']['tmp_name'], "r");
                                        fgetcsv($handle, 10000, ",");
                                        if (($column = fgetcsv($handle, 10000, ",")) !== FALSE) {
                                            $sqlcmd = "INSERT into PatientInfo (ph_id,pulmonary_diagnosis,other_diagnosis,oxygen_lvl,special_endorsement,username,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,date)
                   values ('" . $column[0] . "','" . $column[10] . "','" . $column[11] . "','" . $column[12] . "','" . $column[13] . "','" . $column[14] . "','" . $column[15] . "','" . $column[16] . "','" . $column[17] . "','" . $column[18] . "','" . $column[19] . "','" . $column[20] . "','" . $column[21] . "','" . $column[22] . "')";

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
                            <?php
                            $username = mysqli_real_escape_string($mysqlconn, $_SESSION['username']);


                            if (isSet($_POST['submit'])) {
                                $ph_id = $mysqlconn->real_escape_string($_POST['ph_id']);
                                $pulmonary_diagnosis = $mysqlconn->real_escape_string($_POST['pulmonary_diagnosis']);
                                $other_diagnosis = $mysqlconn->real_escape_string($_POST['other_diagnosis']);
                                $oxygen_lvl = $mysqlconn->real_escape_string($_POST['oxygen_lvl']);
                                $special_endorsement = $mysqlconn->real_escape_string($_POST['special_endorsement']);
                                $username = $mysqlconn->real_escape_string($_POST['username']);
                                $status = $mysqlconn->real_escape_string($_POST['status']);
                                $ward = $mysqlconn->real_escape_string($_POST['ward']);
                                $bed_no = $mysqlconn->real_escape_string($_POST['bed_no']);
                                $admission_no = $mysqlconn->real_escape_string($_POST['admission_no']);
                                $hosp_no = $mysqlconn->real_escape_string($_POST['hosp_no']);
                                $admission_date = $mysqlconn->real_escape_string($_POST['admission_date']);
                                $disposition = $mysqlconn->real_escape_string($_POST['disposition']);
                                $date = $mysqlconn->real_escape_string($_POST['date']);


                                switch ($_POST['SelectActions']) {
                                    case "ACTION_CREATE":
                                        $sqlcmd = "INSERT INTO PatientInfo(ph_id,pulmonary_diagnosis,other_diagnosis,oxygen_lvl,special_endorsement,username,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,date)"
                                                . "values('$ph_id','$pulmonary_diagnosis','$other_diagnosis','$oxygen_lvl','$special_endorsement','$username','$status','$ward','$bed_no','$admission_no','$hosp_no','$admission_date','$disposition','$date')";
                                        break;
                                    case "ACTION_UPDATE":
                                        $patientlist = $mysqlconn->real_escape_string($_POST['patientlist']);
                                        $sqlcmd = "UPDATE PatientInfo SET ph_id = '$ph_id',pulmonary_diagnosis='$pulmonary_diagnosis',other_diagnosis = '$other_diagnosis',oxygen_lvl='$oxygen_lvl',special_endorsement='$special_endorsement',username='$username',status='$status',ward='$ward', bed_no='$bed_no', admission_no='$admission_no', hosp_no='$hosp_no', admission_date='$admission_date', disposition='$disposition', date='$date'"
                                                . "where info_id = '$patientlist'";

                                        break;
                                    case "ACTION_DELETE":
                                        $patientlist = $mysqlconn->real_escape_string($_POST['patientlist']);
                                        $sqlcmd = "DELETE from PatientInfo WHERE info_id = '$patientlist'";
                                        break;
                                }


                                if ($mysqlconn->query($sqlcmd) === true) {
                                    echo 'Patient Information table successfully updated<br>';
                                    $_POST['submit'] = '';
                                } else {
                                    echo "ERROR: Could not able to execute $sqlcmd. " . $mysqlconn->error;
                                }
                            }
                            $conn = "SELECT Patient.*, PatientInfo.*
                                     FROM Patient
                                     INNER JOIN PatientInfo
                                     ON (Patient.ph_id = PatientInfo.ph_id) WHERE username='$username'";

                            $filter_Result = mysqli_query($mysqlconn, $conn);
                            ?>
                            <form class="form-horizontal" action="" method="post"
                                  enctype="multipart/form-data">    
                                <label>Please Select File (CSV Format Only)</label>
                                <input type="file" name="PatientList" /><br>
                                <input type="submit" name="upload"  value="Upload" />
                            </form>
                            <?php echo $message; ?><br>
                            <div style="overflow-x:auto;">

                                <table id = "example" class = "table table-striped table-hover table-bordered" width = "100%">

                                    <?php
                                    if (mysqli_num_rows($filter_Result) > 0) {
                                        echo" <center> <table>
                                            <tr>
                                                <th>Patient No.</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Pulmonary Diagnosis</th>
                                                <th>Other Diagnosis</th>
                                                <th>Oxygen Level</th>
                                                <th>Special Endorsement</th>
                                                <th>Physician</th>
                                                <th>Status</th>
                                                <th>Ward</th>
                                                <th>Bed No.</th>
                                                <th>Admission No.</th>
                                                <th>Hospital No.</th>
                                                <th>Admission Date</th>
                                                <th>Disposition</th>
                                                <th>Date</th>
                                                </tr></center>";

                                        while ($row = mysqli_fetch_array($filter_Result)) {
                                            echo "<td>" . $row['ph_id'] . "</td>";
                                            echo "<td>" . $row['patient_fname'] . "</td>";
                                            echo "<td>" . $row['patient_mname'] . "</td>";
                                            echo "<td>" . $row['patient_lname'] . "</td>";
                                            echo "<td>" . $row['pulmonary_diagnosis'] . "</td>";
                                            echo "<td>" . $row['other_diagnosis'] . "</td>";
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
                                        echo "</table>";
                                        ?><br>
                                        <input type="submit" name="Export" value="Export">

                                        <?php
                                    } else {
                                        echo "No records found";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </body>
</html>

