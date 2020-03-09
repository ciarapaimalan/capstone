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
        <link rel="stylesheet" href="./style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
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
                                <li>  <a href="UsersProfile.php"><?php echo $_SESSION['username']; ?>
                                        <li><a href="Logout.php">Log Out</a></li></li>
                            </ul>
                    </div>
                </nav>
                <div class="container-fluid">

                        <!-- partial -->
                        <div>
                            <h1>New Patient Sign Up form</h1>
                            <p> Input patient details below</p>
                            <?php
                        
                            if ($mysqlconn === false) {
                                die("ERROR: Could not connect. " . $mysqlconn->connect_error);
                            }
                            if (isset($_POST['submit'])) {

                                $patient_fname = $mysqlconn->real_escape_string($_POST['patient_fname']);
                                $patient_mname = $mysqlconn->real_escape_string($_POST['patient_mname']);
                                $patient_lname = $mysqlconn->real_escape_string($_POST['patient_lname']);
                                $birthdate = $mysqlconn->real_escape_string($_POST['birthdate']);
                                $sex = $mysqlconn->real_escape_string($_POST['sex']);
                                $address = $mysqlconn->real_escape_string($_POST['address']);
                                $contactno = $mysqlconn->real_escape_string($_POST['contactno']);



                                $sql = "INSERT INTO Patient(patient_fname,patient_mname,patient_lname,birthdate,sex,address,contactno)"
                                        . "values('$patient_fname','$patient_mname','$patient_lname','$birthdate','$sex','$address','$contactno')";

                                if ($mysqlconn->query($sql) === true) {
                                    $msg = "New Patient Record has been added";
                                } else {
                                    $msg = "Could not able to execute $sql. " . $mysqlconn->error;
                                }

                                echo $msg;
                                mysqli_close($mysqlconn);
                            }
                            ?>

                            <div class="signup-form">
                                <form action="" method="POST" class="register-form" id="register-form">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <div class="form-input">
                                                <label for="patient_fname" class="required">First name</label>
                                                <input type="text" name="patient_fname" id="first_name" />
                                            </div>
                                            <div class="form-input">
                                                <label for="patient_mname" class="required">Middle name</label>
                                                <input type="text" name="patient_mname" id="middle_name" />
                                            </div>
                                            <div class="form-input">
                                                <label for="patient_lname" class="required">Last name</label>
                                                <input type="text" name="patient_lname" id="last_name" />
                                            </div>

                                            <div class="form-input">
                                                <label for="birthdate" class="required">Birthday</label>
                                                <input type="date" name="birthdate" id="bday" />
                                            </div>

                                            <div class="form-radio-group">
                                                <label for="sex">Sex</label>
                                                <div class="form-radio-item">
                                                    <input type="radio" name="sex" id="male" value="male">
                                                    <label for="male">Male</label>
                                                    <span class="check"></span>
                                                </div>
                                                <div class="form-radio-item">
                                                    <input type="radio" name="sex" id="female" value="female">
                                                    <label for="female">Female</label>
                                                    <span class="check"></span>
                                                </div>
                                                <br>
                                                <div class="form-input">
                                                    <label for="address">Address</label>
                                                    <input type="text" name="address" id="address" />
                                                </div>
                                                <div class="form-input">
                                                    <label for="contactno" class="required">Contact Number</label>
                                                    <input type="text" name="contactno" id="phone_number" />
                                                </div>
                                                <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
                                            </div>
                                        </div>
                                </form>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- JS  -->

            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/nouislider/nouislider.min.js"></script>
            <script src="vendor/wnumb/wNumb.js"></script>
            <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
            <script src="vendor/jquery-validation/dist/additional-methods.min.js"></script>
            <script src="js/main.js"></script>
    </body>

</html>