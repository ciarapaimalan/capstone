<?php
include ('MySQL.php');
session_start();
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>TRAST</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
        <link rel="stylesheet" href="style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="icon" href="usthlogo.png">

        <style>
            .select:hover {background-color:#f5f5f5;}


            #back {
                background-color: white;
                color: #737070	;
                border: 2px solid #A9A9A9;
            }
            #back:hover {
                background-color: #A9A9A9;
                color: white;
                border: 2px solid #A9A9A9;
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
                        <a href="AdminHelpPage.php">
                            <i class="zmdi zmdi-help-outline"></i> Help
                        </a>
                    </li>
                    <li>
                        <a href="AdminAbout.php">
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

                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" >Manage<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="ManageUsers.php">User</a></li>
                                    <li><a href="ManagePatient.php">Patients</a></li>
                                    <li><a href="ManagePatientInfo.php">Patients' Chart</a></li>
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
                    <div class="container-fluid">

                        <!-- partial -->
                        <div>
                            <h2 class="mb-4">Update Patients's Record</h2>
                            <br>
                            <?php
                            $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

                            $sql = "SELECT * FROM Patient WHERE ph_id='$id'";
                            $result = mysqli_query($mysqlconn, $sql);
                            ?>

                            <?php
                            if ($mysqlconn === false) {
                                die("ERROR: Could not connect. " . $mysqlconn->connect_error);
                            }

                            if (isSet($_POST['submit'])) {
                                $patient_fname = $mysqlconn->real_escape_string($_POST['patient_fname']);
                                $patient_mname = $mysqlconn->real_escape_string($_POST['patient_mname']);
                                $patient_lname = $mysqlconn->real_escape_string($_POST['patient_lname']);
                                $birthdate = $mysqlconn->real_escape_string($_POST['birthdate']);
                                $sex = $mysqlconn->real_escape_string($_POST['sex']);
                                $address = $mysqlconn->real_escape_string($_POST['address']);
                                $contactno = $mysqlconn->real_escape_string($_POST['contactno']);
                                $sqlcmd = "update Patient set patient_fname = '$patient_fname', patient_mname = '$patient_mname', patient_lname='$patient_lname', birthdate='$birthdate', sex='$sex', address='$address', contactno='$contactno'where ph_id = '$id'";

                                if ($mysqlconn->query($sqlcmd) === true) {
                                    ?>
                                    <div class="alert alert-success">
                                        <strong>Success!</strong>  Patient's record has been updated.
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
                            if (isSet($_POST['Delete'])) {
                                $sqlcmd = "DELETE from Patient WHERE ph_id = '$id'";
                                if ($mysqlconn->query($sqlcmd) === true) {
                                    echo "<script type='text/javascript'>window.top.location='ManagePatient.php';</script>";
                                } else {
                                    ?>
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> Record cannot be deleted.
                                    </div>
                                    <?php
                                }
                                exit;
                            }
                            ?>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                ?> 
                                <div class="container-fluid">
                                    <br>
                                    <div class="signup-form">
                                        <div class="container-fluid">
                                            <div class="container-fluid">
                                                <form action="" method="POST" >

                                                    <button type="submit" name="Delete"class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete </button><br><br>
                                                </form>

                                                <form action="" method="POST" action="" >
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <div class="form-input">
                                                                <label for="patient_fname" class="required" >First name</label>
                                                                <input type="text" name="patient_fname" id="first_name"  value="<?php echo $row['patient_fname']; ?>"required/>
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="patient_mname" class="required">Middle name</label>
                                                                <input type="text" name="patient_mname" id="middle_name"  value="<?php echo $row['patient_mname']; ?>"required/>
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="patient_lname" class="required">Last name</label>
                                                                <input type="text" name="patient_lname" id="last_name" value="<?php echo $row['patient_lname']; ?>"required />
                                                            </div>

                                                            <div class="form-input">
                                                                <label for="birthdate" class="required"required>Birthday</label>
                                                                <input type="date" name="birthdate" max="2000-12-31" id="bday" value="<?php echo $row['birthdate']; ?>"required />
                                                            </div>

                                                            <?php
                                                            if ($row['sex'] == 'Male') {
                                                                ?>                                   
                                                                <div class="form-radio-group">
                                                                    <label for="sex" class="required">Sex</label>
                                                                    <div class="form-radio-item">
                                                                        <input type="radio" name="sex" id="male" value="Male"checked>
                                                                        <label for="male">Male</label>
                                                                        <span class="check"></span>
                                                                    </div>
                                                                    <div class="form-radio-item">
                                                                        <input type="radio" name="sex" id="female" value="Female">
                                                                        <label for="female">Female</label>
                                                                        <span class="check"></span>
                                                                    </div>
                                                                </div>
                                                            <?php } else {
                                                                ?>
                                                                <div class = "form-radio-group">
                                                                    <label for = "sex" class = "required">Sex</label>
                                                                    <div class = "form-radio-item">
                                                                        <input type = "radio" name = "sex" id = "male" value = "Male">
                                                                        <label for = "male">Male</label>
                                                                        <span class = "check"></span>
                                                                    </div>
                                                                    <div class = "form-radio-item">
                                                                        <input type = "radio" name = "sex" id = "female" value = "Female"checked>
                                                                        <label for = "female">Female</label>
                                                                        <span class = "check"></span>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                            <br>
                                                            <div class="form-input">
                                                                <label for="address"class="required">Address</label>
                                                                <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>"required />
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="contactno" class="required">Contact Number</label>
                                                                <input type="text" name="contactno" id="phone_number"  value="<?php echo $row['contactno']; ?>"required/>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        <div class="form-submit">
                                                            <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
                                                            <input type="button" value="Back" class="submit" id="back" name="back" onclick="goBack()">
                                                        </div>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function goBack() {
                    window.history.back();
                }
            </script>

    </body>

</html>