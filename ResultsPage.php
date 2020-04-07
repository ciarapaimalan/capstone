<?php
session_start();
include 'MySQL.php';
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}

//
//if (isSet($_POST['Submit'])) {
//    header('location:ResultsPage.php');
//} else {
//    header('location:UserHomepage.php');
//}
//
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
    <link rel="stylesheet" href="./style3.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" href="usthlogo.png">
    <style>
        .boxed {
            border: 1px solid red;
            width:20%;
        }
    </style>
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
                        <form>
                            <p>	     
                            <div class="mb-5">
                                <div class="container-fluid">
                                    <div id="content" class="p-4 p-md-5 pt-5">
                                        <br>
                                        <table class="table table-sm">
                                            <?php
                                            date_default_timezone_set('Asia/Manila');

//$RA_ID = $mysqlconn->real_escape_string($_POST['RA_ID']);
                                            if (isSet($_POST['Submit'])) {

                                                $ph_id = $mysqlconn->real_escape_string($_POST['ph_id']);
//                                            if (isSet($_POST['submit'])) {
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
                                                $exam_date = $mysqlconn->real_escape_string($_POST['exam_date']);
//$date_updated = $mysqlconn->real_escape_string($_POST['date_updated']);

                                                $sql = "Insert into RiskAssessment(ph_id,step_one,step_two,trf,regimen,anticoagulants,anticoagulants_elab,modalities,other_modalities,username,exam_date
) values('$ph_id','$step_one','$step_two','$trf','$regimen','$anticoagulants','$anticoagulants_elab','$modalities','$other_modalities','$username','$exam_date')";


                                                if ($mysqlconn->query($sql) === true) {
                                                    ?>
                                                    <div class="alert alert-success">
                                                        <strong>Success!</strong> New Risk Assessment Record has been added.
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="alert alert-danger">
                                                        <strong>Error!</strong> Please check your inputs.
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div id="printableArea">
                                                    <b>Patient ID:</b> <?php echo $_POST['ph_id']; ?><br>

                                                    <?php
                                                    $sqlpatient = mysqli_query($mysqlconn, "SELECT patient_fname,patient_mname,patient_lname,contactno FROM Patient WHERE ph_id='$ph_id'");
                                                    while ($row = mysqli_fetch_array($sqlpatient)) {
                                                        echo'<b>Patient Name: </b>' . $row["patient_fname"] . '  ' . $row["patient_mname"] . ' ' . $row["patient_lname"] . ' <br>';
                                                    }
                                                    ?>
                                                    <br>

                                                    <b> Recurring Condition/s:</b><br>
                                                    <?php
                                                    $queryStepOne = "SELECT step_one, COUNT(*) As total FROM RiskAssessment WHERE ph_id='$ph_id' GROUP By step_one HAVING COUNT(*)>1";
                                                    $resultStepOne = mysqli_query($mysqlconn, $queryStepOne);
                                                    if (mysqli_num_rows($resultStepOne) > 0) {
                                                        ?>
                                                        <?php while ($row = mysqli_fetch_assoc($resultStepOne)) { ?>

                                                            &nbsp;&nbsp;<i>Step One:</i> <?php echo $row['step_one']; ?><br>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<i>No. of Recurrence:</i> <?php echo $row['total']; ?><br>

                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        &nbsp;&nbsp;<i>No repeating values for Risk Factors associated with Patient (Step One) </i><br>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $queryStepTwo = "SELECT step_two, COUNT(*) As total FROM RiskAssessment WHERE ph_id='$ph_id' GROUP By step_two HAVING COUNT(*)>1";
                                                    $resultStepTwo = mysqli_query($mysqlconn, $queryStepTwo);
                                                    if (mysqli_num_rows($resultStepTwo) > 0) {
                                                        ?>
                                                        <?php while ($row = mysqli_fetch_assoc($resultStepTwo)) { ?>

                                                            &nbsp;&nbsp;<i>Step Two:</i> <?php echo $row['step_two']; ?><br>
                                                            &nbsp;&nbsp;&nbsp; &nbsp;<i>No. of Recurrence:</i> <?php echo $row['total']; ?><br>

                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        &nbsp;&nbsp;<i>No repeating values for Risk Factors associated with Patient (Step Two)  </i><br>
                                                        <?php
                                                    }
                                                    ?>    
                                                    <br>


                                                    <b>Step One:</b> <?php echo $_POST['step_one']; ?><br>
                                                    <b>Step Two:</b> <?php echo implode(", ", $_POST['step_two']); ?><br>
                                                    <b>TRF:</b> <?php echo $_POST['trf']; ?><br>
                                                    <b>Risk Level:</b> <?php echo $_POST['regimen']; ?><br>
                                                    <b>Contraindication to anticoagulants?:</b> <?php echo $_POST['anticoagulants']; ?><br>
                                                    <b>Elaboration:</b> <?php echo $_POST['anticoagulants_elab']; ?><br>

                                                    <b>Modalities:</b> <?php echo implode(", ", $_POST['modalities']); ?><br>
                                                    <b>Other Modalities:</b> <?php echo $_POST['other_modalities']; ?><br>
                                                    <b>Physician's username:</b> <?php echo $_POST['username']; ?><br>

                                                    <b>Assessment Date:</b> <?php echo $_POST['exam_date']; ?><br>

                                                <?php } else {
                                                    ?>
                                                    <div class="alert alert-danger">
                                                        <strong>Error!</strong> No values entered.
                                                    </div>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                            <br>
                                            <br>
                                            <input type="button" onclick="printDiv('printableArea')" value="Print Result" class="btn btn-primary" />

<!--                                            <input type="button" onclick="printDiv('printableArea')" value="Print Result" class="submit" id="submit" style="background-color: #008CBA;"/>-->

                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>

    </body>
</html>
