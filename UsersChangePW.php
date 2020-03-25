<?php
include ('MySQL.php');
session_start();
$username = mysqli_real_escape_string($mysqlconn, $_SESSION['username']);

if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
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
            document.getElementById("currentPassword").innerHTML = "Required";
            output = false;
        } else if (!newPassword.value) {
            newPassword.focus();
            document.getElementById("newPassword").innerHTML = "Required";
            output = false;
        } else if (!confirmPassword.value) {
            confirmPassword.focus();
            document.getElementById("confirmPassword").innerHTML = "Required";
            output = false;
        }
        if (newPassword.value != confirmPassword.value) {
            newPassword.value = "";
            confirmPassword.value = "";
            newPassword.focus();
            document.getElementById("confirmPassword").innerHTML = "Password did not match";
            output = false;
        }
        return output;
    }
</script>
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
                    <div class="container-fluid">


                        <div id="content" class="p-4 p-md-5 pt-5">
                            <!--                        <h2 class="mb-4">TRAST: Thrombosis Risk Assessment System</h2>-->
                            <p>	     
                            <div class="mb-5">
                                <br>
                                <?php
                                if (count($_POST) > 0) {
                                    $result = mysqli_query($mysqlconn, "SELECT *from UserAccnt WHERE username='" . $_SESSION["username"] . "'");
                                    $row = mysqli_fetch_array($result);
                                    if ($_POST["currentPassword"] == $row["password"]) {
                                        mysqli_query($mysqlconn, "UPDATE UserAccnt set password='" . $_POST["newPassword"] . "' WHERE username='" . $_SESSION["username"] . "'");
                                        ?>

                                        <div class="alert alert-success">
                                            <strong>Success!</strong> Password Changed.
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-danger">
                                            <strong>Error!</strong> Current Password is incorrect.
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <h3 class="h6 mb-3"></h3>
                                <h2>Change Password</h2>
                                <br>

                                <br>

                                <div class="container-fluid">
                                    <div class="signup-form">
                                        <div class="container-fluid">
                                            <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
                                                <div class="form-row">

                                                    <div class="form-group">

                                                        <!--                                                <div style="width: 500px;">-->
                                                        <div class="form-input">

                                                            <label>Current Password</label>
                                                            <input type="password" name="currentPassword" class="txtField" ><span
                                                                id="currentPassword" class="required"></span>
                                                        </div>
                                                        <div class="form-input">

                                                            <br> <label>New Password</label>
                                                            <input type="password" name="newPassword"class="txtField">
                                                            <span id="newPassword"class="required"></span>
                                                        </div>
                                                        <div class="form-input">

                                                            <br><label>Confirm Password</label>
                                                            <div>
                                                                <input type="password" name="confirmPassword"class="txtField" >
                                                                <span id="confirmPassword" class="required"></span>
                                                            </div>
                                                            <br>
                                                        </div>
                                                        <div class="form-submit">

                                                            <input type="submit" value="Submit" class="submit" id="submit" name="submit" />                                                        </div>
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
        </div>
    
    </body>
</html>

