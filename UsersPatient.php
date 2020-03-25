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

    $sqlSelect = "SELECT Patient.*, PatientInfo.diagnosis_one,PatientInfo.diagnosis_two,PatientInfo.oxygen_lvl,PatientInfo.special_endorsement, PatientInfo.username, PatientInfo.status, PatientInfo.ward, PatientInfo.bed_no, PatientInfo.admission_no, PatientInfo.hosp_no, PatientInfo.admission_date, PatientInfo.disposition, PatientInfo.date "
            . "FROM Patient INNER JOIN PatientInfo ON (Patient.ph_id = PatientInfo.ph_id) WHERE username='$username'";
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
        <link rel="icon" href="usthlogo.png">


        <style>
            .select:hover {background-color:#f5f5f5;}
            .dashed {
                border-style: dashed;
                padding: 10px;

            }
            .button2 {
                background-color: white; 
                color: black; 
                border: 2px solid #008CBA;
            }

            .button2:hover {
                background-color: #008CBA;
                color: white;
            }
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
                        <a href="UserAbout.php">
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
                                    while (($column = fgetcsv($handle, 10000, ",")) !== FALSE) {
                                        $sqlcmd = "INSERT into PatientInfo (ph_id,diagnosis_one,diagnosis_two,oxygen_lvl,special_endorsement,username,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,date)
                   values ('" . $column[0] . "','" . $column[8] . "','" . $column[9] . "','" . $column[10] . "','" . $column[11] . "','" . $column[12] . "','" . $column[13] . "','" . $column[14] . "','" . $column[15] . "','" . $column[16] . "','" . $column[17] . "','" . $column[18] . "','" . $column[19] . "','" . $column[20] . "')";

                                        $result = mysqli_query($mysqlconn, $sqlcmd);

                                        if (!empty($result)) {
                                            $type = "success";
                                            $message = ' <div class="alert alert-success"><strong>Success!</strong> CSV Data Imported into the Database</div>';
                                        } else {
                                            $type = "error";
                                            $message = '<div class="alert alert-danger"><strong>Error!</strong> Problem in Importing CSV Data</div>';
                                        }
                                    }

                                    fclose($handle);
// header("location: UpdateTable.php?updation=1");
                                } else {
                                    $message = '<div class="alert alert-danger"><strong>Error!</strong> Please select CSV File only</label></div>';
                                }
                            } else {
                                $message = '<div class="alert alert-danger"><strong>Error!</strong> Please Select File</div>';
                            }
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


                        $conn = "SELECT Patient.*, PatientInfo.diagnosis_one,PatientInfo.diagnosis_two,PatientInfo.oxygen_lvl,PatientInfo.special_endorsement, PatientInfo.username, PatientInfo.status, PatientInfo.ward, PatientInfo.bed_no, PatientInfo.admission_no, PatientInfo.hosp_no, PatientInfo.admission_date, PatientInfo.disposition, PatientInfo.date "
                                . "FROM Patient INNER JOIN PatientInfo ON (Patient.ph_id = PatientInfo.ph_id) WHERE username='$username'";


                        $filter_Result = mysqli_query($mysqlconn, $conn);
                        ?>
                        <?php echo $message;
                        ?>
                        <form class="form-horizontal" action="" method="post"   enctype="multipart/form-data">    

                            <button type="submit" class="btn btn-default"  name="Export" value="Export"style="margin-right: 0;margin-left:auto;display:block;" >
                                <span class="glyphicon glyphicon-export"></span> Export
                            </button>

                            <div class="dashed">

                                <label>Import CSV file of Patients' Chart</label>
                                <input type="file" name="PatientList"/> <br>

                                <button type="submit" class="btn btn-default" name="upload"  value="Upload" >
                                    <span class="glyphicon glyphicon-import"></span> Import
                                </button>

                        </form>
                    </div>
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
                                                <th>Diagnosis 1</th>
                                                <th>Diagnosis 2</th>
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
                                echo "</table>";
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

