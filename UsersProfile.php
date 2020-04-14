<?php
include ('MySQL.php');
session_start();
$username = mysqli_real_escape_string($mysqlconn, $_SESSION['username']);
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
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
        <link rel="stylesheet" href="./table.css">



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
                            <li>  <a href="UsersProfile.php"><?php echo $_SESSION['username']; ?>
                                    <li><a href="Logout.php">Log Out</a></li></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">

                    <div id="content" class="p-4 p-md-5 pt-5">
                        <br>
                        <h1>Hi, <i> <?php echo $_SESSION['username']; ?>!</i></h1>
                        <br>
                        <br>
                        <div class="container">

                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a  href="#1" data-toggle="tab">Tickets</a>
                                </li>
                                <li>
                                    <a href="#2" data-toggle="tab">Patients</a>
                                </li>
                                <li>
                                    <a href="#3" data-toggle="tab">Scheduled Check-Ups</a>
                                </li>
                                <li>
                                    <a href="#4" data-toggle="tab">Change Password</a>
                                </li>
                            </ul>

                            <div class="tab-content ">
                                <!----------TAB 1-------->

                                <div class="tab-pane active" id="1">

                                    <?php
                                    if (isset($_POST['SelectRow'])) {

                                        switch ($_POST['SelectActions']) {
                                            case "ACTION_CANCEL":
                                                $sql = 'update ticket set status = "Cancelled" where ';
                                                updateList($sql);
                                                break;
                                            case "ACTION_PROCESSING":
                                                $sql = 'update ticket set status = "Processing" where ';
                                                updateList($sql);
                                                break;
                                            case "ACTION_RESOLVED":
                                                $sql = 'update ticket set status = "Resolved" where ';
                                                updateList($sql);
                                                break;
                                        }
                                    }

                                    function updateList($sql) {
                                        include 'MySQL.php';

                                        $criteria = "";
                                        foreach ($_POST['SelectRow'] as $value) {
                                            $criteria = $criteria . "id=" . $value . " or ";
                                        }


                                        $criteria = rtrim($criteria, " or ");

                                        $criteria;

                                        $sql = $sql . $criteria;

                                        if ($mysqlconn->query($sql) == true) {
                                            echo "<br><b>Ticket Updated</b>";
                                        }

                                        $mysqlconn->close();
                                    }
                                    ?>                                   
                                    <?php
                                    $sql = "SELECT * FROM ticket where username='$username' ORDER BY severity DESC";

                                    $profileActions = '<option value="ACTION_PROCESSING">Process</option>'
                                            . '<option value="ACTION_CANCEL">Cancel</option>';

                                    $result = mysqli_query($mysqlconn, $sql);
                                    ?>
                                    <table id="example" class="table table-striped table-hover table-bordered" width="100%">

                                        <form method="POST" action="UsersProfile.php">
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                echo" <table>
                                            <tr>
                                                <th> </th>
                                                <th>Date</th>
                                                <th>Incident</th>
                                                <th>Message</th>
                                                <th>Severity</th>
                                                <th>Status</th>

                                            </tr>";
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<tr>";
                                                    echo "<td> <input type='checkbox' name='SelectRow[]' value=" . $row['id'] . ">";
                                                    echo "<td>" . $row['date'] . "</td>";
                                                    echo "<td>" . $row['question'] . "</td>";
                                                    echo "<td>" . $row['message'] . "</td>";
                                                    echo "<td>" . $row['severity'] . "</td>";
                                                    echo "<td>" . $row['status'] . "</td>";
                                                    echo "</tr>";
                                                }

                                                echo "</table>";
                                            } else {
                                                echo "No records found";
                                            }
                                            ?>

                                            <br><br>
                                            Select Action to Perform: <select name="SelectActions">
                                                <?php echo $profileActions ?>
                                            </select><br><br>

                                            <input type="submit" name="Submit" value="Submit" class="button">
                                        </form>
                                    </table>


                                    </table>
                                </div>

                                <!----------TAB 2-------->
                                <div class="tab-pane" id="2">
                                    <div style="overflow-x:auto;">

                                        <table id="example" class="table table-striped table-hover table-bordered" width="100%">
                                            <?php
                                            $sqlinfo = "SELECT Patient.*, PatientInfo.*
                                     FROM Patient
                                     INNER JOIN PatientInfo
                                     ON (Patient.ph_id = PatientInfo.ph_id) WHERE username='$username'";

                                            $resultinfo = mysqli_query($mysqlconn, $sqlinfo);

                                            if (mysqli_num_rows($resultinfo) > 0) {
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

                                                while ($row = mysqli_fetch_array($resultinfo)) {
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

                                <div class="tab-pane" id="3">

                                    <table id="example" class="table table-striped table-hover table-bordered" width="100%">
                                        <?php
                                        if (isset($_POST['SelectRow'])) {

                                            switch ($_POST['SelectActions']) {
                                                case "ACTION_CANCEL":
                                                    $sql = 'update schedule set status = "Cancelled" where ';
                                                    updateSched($sql);
                                                    break;
                                                case "ACTION_DONE":
                                                    $sql = 'update schedule set status = "Processing" where ';
                                                    updateSched($sql);
                                                    break;
                                            }
                                        }

                                        function updateSched($sql) {
                                            include 'MySQL.php';

                                            $criteria = "";
                                            foreach ($_POST['SelectRow'] as $value) {
                                                $criteria = $criteria . "sched_id=" . $value . " or ";
                                            }


                                            $criteria = rtrim($criteria, " or ");

                                            $criteria;

                                            $sql = $sql . $criteria;

                                            if ($mysqlconn->query($sql) == true) {
                                                echo "<br><b>Ticket Updated</b>";
                                            }

                                            $mysqlconn->close();
                                        }
                                        ?> 
                                        <?php
                                        $sql = "SELECT * FROM schedule WHERE  username='$username'";

                                        $profileActions = '<option value="ACTION_CANCEL">Cancel</option>'
                                                . '<option value="ACTION_DONE">Done</option>';
                                        $resultsched = mysqli_query($mysqlconn, $sql);
                                        ?>
                                        <form method="POST" action="UsersProfile.php">

                                            <?php
                                            if (mysqli_num_rows($resultsched) > 0) {
                                                echo" <table>
                                            <tr>
                                            <th></th>
                                            <th>Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Physician</th>
                                                <th>Note</th>
                                                <th>Status</th>

                                            </tr>";
                                                while ($row = mysqli_fetch_array($resultsched)) {
                                                    echo "<tr>";
                                                    echo "<td> <input type='checkbox' name='SelectRow[]' value=" . $row['sched_id'] . ">";
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
                                                echo "No schedule found";
                                            }
                                            ?>

                                            <br><br>
                                            Select Action to Perform: <select name="SelectActions">
                                                <?php echo $profileActions ?>
                                            </select><br><br>

                                            <input type="submit" name="Submit" value="Submit" class="button">
                                        </form>
                                    </table>
                                </div>



                                <div class="tab-pane" id="4">
                                    <br>
                                    <?php
                                    if (count($_POST) > 0) {
                                        $result = mysqli_query($mysqlconn, "SELECT *from UserAccnt WHERE username='" . $_SESSION["username"] . "'");
                                        $row = mysqli_fetch_array($result);
                                        if ($_POST["currentPassword"] == $row["password"]) {
                                            mysqli_query($mysqlconn, "UPDATE UserAccnt set password='" . $_POST["newPassword"] . "' WHERE username='" . $_SESSION["username"] . "'");
                                            $message = "Password Changed";
                                        } else
                                            $message = "Current Password is not correct";
                                    }
                                    ?>
                                    <script>
                                        function validatePassword() {
                                            var currentPassword, newPassword, confirmPassword, output = true;

                                            currentPassword = document.frmChange.currentPassword;
                                            newPassword = document.frmChange.newPassword;
                                            confirmPassword = document.frmChange.confirmPassword;

                                            if (!currentPassword.value) {
                                                currentPassword.focus();
                                                document.getElementById("currentPassword").innerHTML = "required";
                                                output = false;
                                            } else if (!newPassword.value) {
                                                newPassword.focus();
                                                document.getElementById("newPassword").innerHTML = "required";
                                                output = false;
                                            } else if (!confirmPassword.value) {
                                                confirmPassword.focus();
                                                document.getElementById("confirmPassword").innerHTML = "required";
                                                output = false;
                                            }
                                            if (newPassword.value != confirmPassword.value) {
                                                newPassword.value = "";
                                                confirmPassword.value = "";
                                                newPassword.focus();
                                                document.getElementById("confirmPassword").innerHTML = "not same";
                                                output = false;
                                            }
                                            return output;
                                        }
                                    </script>
                                    </head>
                                    <body>
                                        <form name="frmChange" method="post" action=""
                                              onSubmit="return validatePassword()">
                                            <div style="width: 500px;">
                                                <div class="message"><?php
                                                    if (isset($message)) {
                                                        echo $message;
                                                    }
                                                    ?></div>
                                                <table border="0" cellpadding="10" cellspacing="0"
                                                       width="500" align="center" class="tblSaveForm">
                                                    <tr class="tableheader">
                                                        <td colspan="2">Change Password</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%"><label>Current Password</label></td>
                                                        <td width="60%"><input type="text"
                                                                               name="currentPassword" class="txtField" /><span
                                                                               id="currentPassword" class="required"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>New Password</label></td>
                                                        <td><input type="text" name="newPassword"
                                                                   class="txtField" /><span id="newPassword"
                                                                   class="required"></span></td>
                                                    </tr>
                                                    <td><label>Confirm Password</label></td>
                                                    <td><input type="text" name="confirmPassword"
                                                               class="txtField" /><span id="confirmPassword"
                                                               class="required"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><input type="submit" name="submit"
                                                                               value="Submit" class="btnSubmit"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </form>
                                    </body>
                                    </html>

                                </div>




                            </div>
                        </div>



                    </div>
                </div>
            </div>

    </body>


</html>