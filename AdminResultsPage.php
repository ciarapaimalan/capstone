<?php
session_start();
include 'MySQL.php';

// Check connection
if ($mysqlconn === false) {
    die("ERROR: Could not connect. " . $mysqlconn->connect_error);
}

//$RA_ID = $mysqlconn->real_escape_string($_POST['RA_ID']);
$ph_id = $mysqlconn->real_escape_string($_POST['ph_id']);
$step_one = $mysqlconn->real_escape_string($_POST['step_one']);
//$step_two= $mysqlconn->real_escape_string($_POST['step_two']);
$step_two = implode(", ", $_POST['step_two']);
$trf = $mysqlconn->real_escape_string($_POST['trf']);
$regimen = $mysqlconn->real_escape_string($_POST['regimen']);
$anticoagulants = $mysqlconn->real_escape_string($_POST['anticoagulants']);
$anticoagulants_elab = $mysqlconn->real_escape_string($_POST['anticoagulants_elab']);
//$modalities = $mysqlconn->real_escape_string($_POST['modalities']);
$modalities = implode(", ", $_POST['modalities']);
$other_modalities = $mysqlconn->real_escape_string($_POST['other_modalities']);
$username = $mysqlconn->real_escape_string($_POST['username']);
//$exam_date = $mysqlconn->real_escape_string($_POST['exam_date']);
//$date_updated = $mysqlconn->real_escape_string($_POST['date_updated']);


$sql = "Insert into RiskAssessment(ph_id,step_one,step_two,trf,regimen,anticoagulants,anticoagulants_elab,modalities,other_modalities,username,exam_date
) values('$ph_id','$step_one','$step_two','$trf','$regimen','$anticoagulants','$anticoagulants_elab','$modalities','$other_modalities','$username',NOW()
)";

if ($mysqlconn->query($sql) === true) {
    $msg = "This Assessment has been recorded";
} else {
    $msg = "Could not able to execute $sql. " . $mysqlconn->error;
}
?>



<!DOCTYPE html>
<html lang="eng">

    <head>

    </head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TRAST</title>
       <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
        <link rel="stylesheet" href="./style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

    <body>

        <!-- partial:index.partial.html -->
        <div id="viewport">
            <!-- Sidebar -->
            <div id="sidebar">
                <br>
                <br>
                <header>
                    <a id="header">
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
                        <a href="AdminHelpPage.php">
                            <i class="zmdi zmdi-help-outline"></i> Help
                        </a>
                    </li>
                    <li>
                        <a href="#">
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
                                    <li><a href="UsersChangePW.php">Change Password</a></li>
                                </ul>
                            </li>

                            <li><a href="Logout.php">Log Out</a></li></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">


                    <div id="content" class="p-4 p-md-5 pt-5">
                        <form>
                            <p>	     
                            <div class="mb-5">
                                <div class="container-fluid">
                                    <div id="content" class="p-4 p-md-5 pt-5">
                                        <br>
                                        <table class="table table-sm">
                                            <?php
                                            echo $msg;

                                            $queryStepOne = "SELECT step_one, COUNT(*) As total FROM RiskAssessment WHERE ph_id='$ph_id' GROUP By step_one HAVING COUNT(*)>1";
                                            $resultStepOne = mysqli_query($mysqlconn, $queryStepOne);
                                            if (mysqli_num_rows($resultStepOne) > 0) {
                                                ?>
                                                <br>
                                                <?php while ($row = mysqli_fetch_assoc($resultStepOne)) { ?>

                                                    <span>Step One:</span> <?php echo $row['step_one']; ?><br>
                                                    <span>Total:</span> <?php echo $row['total']; ?><br>

                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <span>No repeating values for Risk Factors associated with Patient(Step Two) </span><br>
                                                <?php
                                            }
                                            ?>

                                            <br>
                                            <?php
                                            $queryStepTwo = "SELECT step_two, COUNT(*) As total FROM RiskAssessment WHERE ph_id='$ph_id' GROUP By step_two HAVING COUNT(*)>1";
                                            $resultStepTwo = mysqli_query($mysqlconn, $queryStepTwo);
                                            if (mysqli_num_rows($resultStepTwo) > 0) {
                                                ?>
                                                <br>
                                                <?php while ($row = mysqli_fetch_assoc($resultStepTwo)) { ?>

                                                    <span>Step One:</span> <?php echo $row['step_two']; ?><br>
                                                    <span>Total:</span> <?php echo $row['total']; ?><br>

                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <span>No repeating values for Risk Factors associated with Patient(Step Two)  </span><br>
                                                <?php
                                            }
                                            ?>


                                            <br>
                                            <span>Patient ID:</span> <?php echo $_POST['ph_id']; ?><br>
                                            <span>Step One:</span> <?php echo $_POST['step_one']; ?><br>
                                            <span>Step Two:</span> <?php echo implode(", ", $_POST['step_two']); ?><br>
                                            <span>TRF:</span> <?php echo $_POST['trf']; ?><br>
                                            <span>Risk Level:</span> <?php echo $_POST['regimen']; ?><br>
                                            <span>Anticoagulants:</span> <?php echo $_POST['anticoagulants']; ?><br>
                                            <span>Modalities:</span> <?php echo implode(", ", $_POST['modalities']); ?><br>
                                            <span>Physician:</span> <?php echo $_POST['username']; ?><br>

                                            </body>
                                            </html>