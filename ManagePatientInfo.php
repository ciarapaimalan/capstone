<?php
include ('MySQL.php');
session_start();
$username = mysqli_real_escape_string($mysqlconn, $_SESSION['username']);
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}
?>
<?php
if (isSet($_POST['Export'])) {

    $sqlSelect = "SELECT Patient.*, PatientInfo.diagnosis_one,PatientInfo.diagnosis_two,PatientInfo.oxygen_lvl,PatientInfo.special_endorsement, PatientInfo.username, PatientInfo.status, PatientInfo.ward, PatientInfo.bed_no, PatientInfo.admission_no, PatientInfo.hosp_no, PatientInfo.admission_date, PatientInfo.disposition, PatientInfo.date "
            . "FROM Patient INNER JOIN PatientInfo ON (Patient.ph_id = PatientInfo.ph_id)";
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
        <link rel="icon" href="usthlogo.png">


        <!--        tabs-->
        <!--         Bootstrap 
                <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
                 Datatables 
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
                <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
                <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
                <script src="https://nightly.datatables.net/js/dataTables.bootstrap.js"></script>-->


        <style>
            .select:hover {background-color:#f5f5f5;}
            body {font-family: Arial;}

            /* Style the tab */
            .tab {
                overflow: hidden;
                border: 2px solid #ccc;
                background-color: #Black;
            }

            /* Style the buttons inside the tab */
            .tab button {
                background-color: inherit;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                padding: 14px 16px;
                transition: 0.3s;
                font-size: 20px;
            }

            /* Change background color of buttons on hover */
            .tab button:hover {
                background-color: #ddd;
            }

            /* Create an active/current tablink class */
            .tab button.active {
                background-color: #ccc;
            }

            /* Style the tab content */
            .tabcontent {
                display: none;
                padding: 6px 12px;
                border: 1px solid #ccc;
                border-top: none;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                border:2pt;
                border: 1px solid #ddd;


            }

            th, td {
                text-align: left;
                padding: 5px;
                border: 1px solid #ddd;
                font-size:12px;

            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {

                background-color: #737373;
                color: white;
                width:100%;
            }

            button{
                background-color: #737373; 
                border: none;
                color: white;
                padding: 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 2px 4px;
                cursor: pointer;

            }
            .dashed {
                border-style: dashed;
                padding: 10px;

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
                        <a href="AdminHomepage.php">
                            <i class="zmdi zmdi-search"></i> Search Patient
                        </a>
                    </li>
                    <li>
                        <a href="AdminNewPatient.php">
                            <i class="zmdi zmdi-accounts-add"></i> New Patient
                        </a>
                    </li>
                    <li>
                        <a href=“AdminHelpPage.php">
                            <i class="zmdi zmdi-help-outline"></i> Help
                        </a>
                    </li>
                    <li>
                        <a href="AdminAbout.php">
                            <i class="zmdi zmdi-calendar"></i> About
                        </a>
                    </li>

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

                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" >Manage<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="ManageUsers.php">User</a></li>
                                    <li><a href="ManagePatient.php">Patients</a></li>
                                    <li><a href="ManagePatientInfo.php">Patient's Charts</a></li>
                                    <li><a href="ManageSchedule.php">Schedule</a></li>
                                    <li><a href="ManageTickets.php">Tickets</a></li>
                                    <li><a href="ManageFAQs.php">FAQs</a></li>
                                </ul>
                            </li>

                            <li><a href="Logout.php">Log Out</a></li></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">

                    <div id="content" class="p-4 p-md-5 pt-5">
                        <h2>Manage Patients' Chart</h2>

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
                                $message = '<div class="alert alert-danger"><strong>Error!</strong> Please select a File</div>';
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
                        include ('MySQL.php');

                        if (isSet($_POST['submit'])) {
                            $ph_id = $mysqlconn->real_escape_string($_POST['ph_id']);
                            $diagnosis_one = $mysqlconn->real_escape_string($_POST['diagnosis_one']);
                            $diagnosis_two = $mysqlconn->real_escape_string($_POST['diagnosis_two']);
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
                                    $sqlcmd = "INSERT INTO PatientInfo(ph_id,diagnosis_one,diagnosis_two,oxygen_lvl,special_endorsement,username,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,date)"
                                            . "values('$ph_id','$diagnosis_one','$diagnosis_two','$oxygen_lvl','$special_endorsement','$username','$status','$ward','$bed_no','$admission_no','$hosp_no','$admission_date','$disposition','$date')";
                                    break;
                                case "ACTION_UPDATE":
                                    $patientlist = $mysqlconn->real_escape_string($_POST['patientlist']);
                                    $sqlcmd = "UPDATE PatientInfo SET ph_id = '$ph_id',diagnosis_one='$diagnosis_one',diagnosis_two = '$diagnosis_two',oxygen_lvl='$oxygen_lvl',special_endorsement='$special_endorsement',username='$username',status='$status',ward='$ward', bed_no='$bed_no', admission_no='$admission_no', hosp_no='$hosp_no', admission_date='$admission_date', disposition='$disposition', date='$date'"
                                            . "where info_id = '$patientlist'";

                                    break;
                                case "ACTION_DELETE":
                                    $patientlist = $mysqlconn->real_escape_string($_POST['patientlist']);
                                    $sqlcmd = "DELETE from PatientInfo WHERE info_id = '$patientlist'";
                                    break;
                            }


                            if ($mysqlconn->query($sqlcmd) === true) {
                                ?>
                                <div class="alert alert-success">
                                    <strong>Success!</strong> Patient Information table has been updated.
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Error!</strong> Please check your inputs.
                                </div>
                                <?php
                            }
                        }
//                        if (isset($_POST['search'])) {
//                            $valueToSearch = $_POST['valueToSearch'];
//                            // search in all table columns
//                            // using concat mysql function
//                            $conn = "SELECT Patient.* , PatientInfo.*
//                                     INNER JOIN PatientInfo
//                                     ON CONCAT (Patient.ph_id = PatientInfo.ph_id )LIKE ( '%" . $valueToSearch . "%')";
//                            $search_result = filterTable($conn);
//                        } else {
//                            $conn = "SELECT Patient.*, PatientInfo.*
//                                    FROM Patient
//                                     INNER JOIN PatientInfo
//                                     ON Patient.ph_id = PatientInfo.ph_id";
//                            $search_result = filterTable($conn);
//                        }
//
//                        function filterTable($conn) {
//                            include('MySQL.php');
//                            $filter_Result = mysqli_query($mysqlconn, $conn);
//                            return $filter_Result;
//                        }


                        $conn ="SELECT Patient.*, PatientInfo.diagnosis_one,PatientInfo.diagnosis_two,PatientInfo.oxygen_lvl,PatientInfo.special_endorsement, PatientInfo.username, PatientInfo.status, PatientInfo.ward, PatientInfo.bed_no, PatientInfo.admission_no, PatientInfo.hosp_no, PatientInfo.admission_date, PatientInfo.disposition, PatientInfo.date "
            . "FROM Patient INNER JOIN PatientInfo ON (Patient.ph_id = PatientInfo.ph_id) ORDER BY info_id DESC";
                        $filter_Result = mysqli_query($mysqlconn, $conn);
                        ?>     
                        <?php echo $message; ?>

                        <form class="form-horizontal" action="" method="post"   enctype="multipart/form-data">    

                            <button type="submit" class="btn btn-default"  name="Export" value="Export"style="margin-right: 0;margin-left:auto;display:block;" >
                                <span class="glyphicon glyphicon-export"></span> Export
                            </button>

                            <div class="dashed">

                                <label>Import CSV file of Patients' Chart Table</label>
                                <input type="file" name="PatientInfo"/> <br>

                                <button type="submit" class="btn btn-default" name="upload"  value="Upload" >
                                    <span class="glyphicon glyphicon-import"></span> Import
                                </button>


                        </form>
                    </div>
                    <br>
                    <form action="" method="post" name="frmUser" >

                        <div style="overflow-x:auto;">

                            <table>
                                <tr>
                                    <th></th>  
                                    <th>Patient No.</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Birthdate</th>
                                    <th>Sex</th>
<!--                                    <th>Address</th>
                                    <th>Contact No.</th>-->
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

                                </tr>
                                <?php $i = 0; ?>
                                <!-- populate table from mysql database -->
                                <?php while ($row = mysqli_fetch_array($filter_Result)): ?>
                                    <tr>
                                    <tr class="<?php if (isset($classname)) echo $classname; ?>">
                                        <td><input type="radio" name="patientlist" value="<?php echo $row['info_id']; ?>"></td>   
                                        <td><?php echo $row['ph_id']; ?></td>
                                        <td><?php echo $row['patient_fname']; ?></td>
                                        <td><?php echo $row['patient_mname']; ?></td>
                                        <td><?php echo $row['patient_lname']; ?></td>
                                        <td><?php echo $row['birthdate']; ?></td>
                                        <td><?php echo $row['sex']; ?></td>
    <!--                                        <td><?php echo $row['address']; ?></td> -->
    <!--                                        <td><?php echo $row['contactno']; ?></td>-->
                                        <td><?php echo $row['diagnosis_one']; ?></td>
                                        <td><?php echo $row['diagnosis_two']; ?></td>
                                        <td><?php echo $row['oxygen_lvl']; ?></td>
                                        <td><?php echo $row['special_endorsement']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td><?php echo $row['ward']; ?></td>
                                        <td><?php echo $row['bed_no']; ?></td>
                                        <td><?php echo $row['admission_no']; ?></td>
                                        <td><?php echo $row['hosp_no']; ?></td>
                                        <td><?php echo $row['admission_date']; ?></td>
                                        <td><?php echo $row['disposition']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                    </tr>

                                <?php endwhile;
                                ?>
                                <tr>
                                    <td> Add Patient Information:</td>  
                                    <td><input type="number"  name="ph_id" class="ph_id"  style="width:100%;"> </td>
                                    <td></td>
                                    <td></td>
                                    <td></td> 
                                    <td></td>
                                    <td></td>
<!--                                <td></td>
                                    <td></td>-->
                                    <td><input type="textbox" name="diagnosis_one" class="diagnosis_one"></td>
                                    <td><input type="textbox" name="diagnosis_two" name="diagnosis_two"></td>

                                    <td><input type="textbox"  name="oxygen_lvl" class="oxygen_lvl"> </td>
                                    <td><input type="textbox"  name="special_endorsement" class="special_endorsement"> </td>
                                    <td><input type="textbox"  name="username" class="username"> </td>
                                    <td><input type="textbox"  name="status" class="status"> </td>
                                    <td><input type="textbox"  name="ward" class="ward"> </td>
                                    <td><input type="textbox"  name="bed_no" class="bed_no"> </td>
                                    <td><input type="textbox"  name="admission_no" class="admission_no" > </td>
                                    <td><input type="textbox"  name="hosp_no" class="hosp_no"> </td>

                                    <td><input type="date"  name="admission_date" class="admission_date"> </td>
                                    <td> <select name="disposition"required >
                                            <option value="In-Patient">In-Patient</option>
                                            <option value="Discharged">Discharged</option>
                                            <!--<option value="Deceased">Deceased</option>-->
                                        </select> </td>                                    
                                    <td><input type="date"  name="date" class="date" > </td>




                                </tr> 

                                <tr class="listheader">
                                <tr class="listheader">
                                    <td colspan="23">
                                        <h5> Mode: <select name="SelectActions"></h5>
                                <option value="ACTION_CREATE">Create</option>
                                <option value="ACTION_UPDATE">Update</option>
                                <option value="ACTION_DELETE">Delete</option>

                                </select>
                                <input type="submit" name="submit" value="Submit" class="btn btn-success">


                                </td>
                                </tr>
                            </table>
                        </div>


                    </form>


                    </form>


                </div>

            </div>
        </div>



    </div>
</div>
</div>

</body>


</html>    
