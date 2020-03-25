<?php
include ('MySQL.php');
session_start();
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}
?>
<?php
if (isSet($_POST['Export'])) {
    $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

//    $sqlSelect = "SELECT * FROM RiskAssessment WHERE ph_id='$id' ORDER BY RA_ID DESC";
    $sqlSelect = "SELECT Patient.*, RiskAssessment.* FROM Patient INNER JOIN RiskAssessment ON (Patient.ph_id = RiskAssessment.ph_id)";
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
    header('Content-Disposition: attachment; filename=RiskAssessment.csv');
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
        <link rel="stylesheet" href="./style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <!--dropwdown li-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!--        tabs-->
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <!-- Datatables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
        <script src="https://nightly.datatables.net/js/dataTables.bootstrap.js"></script>


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
                width: 98%;
                border:2pt;
                border: 1px solid #ddd;

            }

            th, td {
                text-align: left;
                padding: 10px;
                border: 1px solid #ddd;
                font-size:12px;


            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {

                background-color: #737373;
                color: white;
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
                            <li><a href="Logout.php">Log Out</a></li>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">


                    <div id="content" class="p-4 p-md-5 pt-5">
                        <h2 class="mb-4">Patient's Profile</h2>
                        <p>	     
                        <div class="mb-5">
                            <br>

                            <div class="form">
                                <img src="patient.png" style="width:20%;float: left;padding:10px; margin: 10px;display:block;">
                                <br><br>

                                <?php
                                include ('MySQL.php');

                                $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

                                $sql = "SELECT * FROM Patient WHERE ph_id='$id'";

                                $result = mysqli_query($mysqlconn, $sql);
                                ?>
                                <table>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?> 
                                        <b>Patient ID:</b> <?php echo $row['ph_id']; ?><br>
                                        <b>First Name:</b> <?php echo $row['patient_fname']; ?><br>
                                        <b>Middle Name:</b> <?php echo $row['patient_mname']; ?><br>
                                        <b>Last Name:</b> <?php echo $row['patient_lname']; ?><br>
                                        <b>Birthdate:</b> <?php echo $row['birthdate']; ?><br>
                                        <b>Sex:</b> <?php echo $row['sex']; ?><br>
                                        <b>Address:</b> <?php echo $row['address']; ?><br>
                                        <b>Contact No.:</b> <?php echo $row['contactno']; ?><br>
                                        <br>
                                        <?php
                                        echo '<button onclick=location.href="RiskAssessment.php?id=' . $row["ph_id"] . '">Start Risk Assessment</button>';
                                    }
                                    ?>



                                </table>
                                <br><br>
                            </div></div></div>

                    <div class="container">

                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a  href="#1" data-toggle="tab">Patient's Chart</a>
                            </li>
                            <li>
                                <a href="#2" data-toggle="tab">Risk Assessments</a>
                            </li>
                            <li>
                                <a href="#3" data-toggle="tab">Scheduled Check-Ups</a>
                            </li>
                        </ul>

                        <div class="tab-content ">
                            <div class="tab-pane active" id="1">
                                <?php
                                include ('MySQL.php');

                                $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

                                $sql = "SELECT * FROM Patient WHERE ph_id='$id'";

                                $result = mysqli_query($mysqlconn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<br> <a href="PatientInfoForm.php?id=' . $row['ph_id'] . '">Add New Record</a><br>';
                                }
                                ?>
                                <table id="example" class="table table-striped table-hover table-bordered" width="100%">


                                    <?php
                                    $sqlinfo = "SELECT * FROM PatientInfo WHERE ph_id='$id'ORDER BY date DESC";

                                    $resultinfo = mysqli_query($mysqlconn, $sqlinfo);

                                    if (mysqli_num_rows($resultinfo) > 0) {
                                        echo" <center> <table>
                                    <tr>
                                    
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
                                        <th width='8%'>Date</th>
                                    </tr></center>";

                                        while ($row = mysqli_fetch_array($resultinfo)) {

                                            echo "<tr>";
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
                                    } else {
                                        echo "<br>No records found";
                                    }
                                    ?>

                                </table>
                            </div>
                            <div class="tab-pane" id="2">
                                <br>

                                <table>
                                    <?php
                                    $sqlrisk = "SELECT * FROM RiskAssessment WHERE ph_id='$id' ORDER BY RA_ID DESC";

                                    $resultrisk = mysqli_query($mysqlconn, $sqlrisk);
                                    if (mysqli_num_rows($resultrisk) > 0) {
                                        ?>
                                        <form action="" method="Post">
                                            <button type="submit" class="btn btn-default"  name="Export" value="Export" >
                                                <span class="glyphicon glyphicon-export"></span> Export
                                            </button>
                                        </form>
                                        <?php
                                        echo" <center><br><table>
                                                        <tr>
                                                            <th>Assessment Date</th>
                                                            <th>Risk Factors associated with Clinical Setting (Step One)</th>
                                                            <th>Risk Factors associated with Patient(Step Two</th>
                                                            <th>Total Risk Factor</th>
                                                            <th>Contraindication to anticoagulants?</th>
                                                            <th>Modalities</th>
                                                            <th>Physcian</th>
                                                        </tr></center>";

                                        while ($row = mysqli_fetch_array($resultrisk)) {
                                            echo "<td>" . $row['exam_date'] . "</td>";
                                            echo "<td>" . $row['step_one'] . "</td>";
                                            echo "<td>" . $row['step_two'] . "</td>";
                                            echo "<td>" . $row['trf'] . "</td>";
                                            echo "<td>" . $row['anticoagulants'] . "</td>";
                                            echo "<td>" . $row['modalities'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<br>No records found";
                                    }
                                    ?>

                                </table>


                            </div>
                            <div class="tab-pane" id="3">
                                <?php
                                include ('MySQL.php');

                                $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

                                $sql = "SELECT * FROM Patient WHERE ph_id='$id'";

                                $result = mysqli_query($mysqlconn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<br> <a href="schedule.php?id=' . $row['ph_id'] . '">Schedule a Check-Up</a><br>';
                                }
                                ?>
                                <table id="example" class="table table-striped table-hover table-bordered" width="100%">

                                    <?php
                                    $sqlsched = "SELECT * FROM schedule WHERE ph_id='$id' ORDER BY date  DESC";
                                    $resultsched = mysqli_query($mysqlconn, $sqlsched);

                                    if (mysqli_num_rows($resultsched) > 0) {
                                        echo" <table>
                                            <tr>
                                            <th>Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Physician</th>
                                                <th>Note</th>
                                                <th>Status</th>

                                            </tr>";
                                        while ($row = mysqli_fetch_array($resultsched)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['date'] . "</td>";
                                            echo "<td>" . $row['start_time'] . "</td>";
                                            echo "<td>" . $row['end_time'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['note'] . "</td>";
                                            echo "<td>" . $row['status'] . "</td>";
                                            echo "</tr>";
                                        }

                                        echo "</table>";
                                    } else {
                                        echo "<br>No schedule found";
                                    }
                                    ?>



                                </table>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <br>
<br>
    <br>
    </body>

</html>
