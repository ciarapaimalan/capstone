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
                            <h2 class="mb-4">New Ticket</h2>
                            <br>
                            <?php
                            if ($mysqlconn === false) {
                                die("ERROR: Could not connect. " . $mysqlconn->connect_error);
                            }

                            if (isSet($_POST['submit'])) {
                                $question = $mysqlconn->real_escape_string($_POST['question']);
                                $message = $mysqlconn->real_escape_string($_POST['message']);
                                $severity = $mysqlconn->real_escape_string($_POST['severity']);
                                $username = $mysqlconn->real_escape_string($_POST['username']);
                                $date = $mysqlconn->real_escape_string($_POST['date']);

                                $sql = "Insert into ticket(question,message,severity,username,date) values('$question','$message','$severity','$username','$date' )";
                                if ($mysqlconn->query($sql) === true) {
                                    ?>
                                    <div class="alert alert-success">
                                        <strong>Success!</strong> This incident has been recorded. The administrator will notify you regarding this.
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
                            ?>

                            <div class="container-fluid">
                                <br>
                                <div class="signup-form">
                                    <div class="container-fluid">

                                        <form action="" method="POST" >
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <div class="form-input">
                                                        <label for="severity" class="required">Subject</label>
                                                        <select id="disposition" name="severity" class="form-control" required>
                                                            <option value="5">Account</option>
                                                            <option value="5">Patient</option>
                                                            <option value="5">Risk Assessment</option>
                                                            <option value="4">Patient's Chart</option>
                                                            <option value="4">Schedule Check-up</option>

                                                        </select>   
                                                    </div>
                                                    <div class="form-input">
                                                        <label for="recipient-name" class="required">Question/Incident</label>
                                                        <input type="text" class="form-control" id="recipient-name" name="question" required>
                                                    </div>
                                                    <div class="form-input">
                                                        <label for="message-text" class="required">Message</label>
                                                        <textarea class="form-control" id="message-text" name="message" required></textarea>
                                                    </div>
                                                    <input type="hidden" name="username" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">
                                                    <?php
                                                    date_default_timezone_set('Asia/Manila');
                                                    ?>
                                                    <input type="hidden" name="date" value="<?= date('Y-m-d'); ?>"> 
                                                    <div class="form-submit">
                                                        <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
                                                        <input type="button" value="Back" class="submit" id="back" name="back" onclick="goBack()">
                                                    </div>
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