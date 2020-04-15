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
                            <h2 class="mb-4">Update FAQs</h2>
                            <br>
                            <?php
                            $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

                            $sql = "SELECT * FROM FAQs WHERE q_id='$id'";
                            $result = mysqli_query($mysqlconn, $sql);
                            ?>
                            <?php
                            if ($mysqlconn === false) {
                                die("ERROR: Could not connect. " . $mysqlconn->connect_error);
                            }

                            if (isSet($_POST['submit'])) {
                                $question = $mysqlconn->real_escape_string($_POST['question']);
                                $answer = $mysqlconn->real_escape_string($_POST['answer']);
                                $severity = $mysqlconn->real_escape_string($_POST['severity']);
                                $role = $mysqlconn->real_escape_string($_POST['role']);
                                $sqlcmd = "update FAQs set question = '$question', answer='$answer', severity='$severity', role='$role' where q_id = '$id'";
                                if ($mysqlconn->query($sqlcmd) === true) {
                                    ?>
                                    <div class="alert alert-success">
                                        <strong>Success!</strong> FAQs record has been Updated.
                                    </div>
                                    <?php
                                } else {
                                    echo "ERROR: Could not able to execute $sqlcmd. " . $mysqlconn->error;
                                }
                            }
                            if (isSet($_POST['Delete'])) {
                                $sqlcmd = "delete from ticket where id = '$id'";
                                if ($mysqlconn->query($sqlcmd) === true) {
                                    echo "<script type='text/javascript'>window.top.location='ManageTicketsTrial.php';</script>";
                                } else {
                                    echo "ERROR: Could not able to execute $sqlcmd. " . $mysqlconn->error;
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

                                            <form action="" method="POST" >
                                                <button type="submit" name="Delete"class="btn btn-danger">Delete</button><br><br>

                                                <div class="form-row">
                                                    <div class="form-group">
                                                        <div class="form-input">
                                                            <div class="form-input">
                                                                <label for="question" class="required">Question</label>
                                                                <input type="text" class="form-control" name="question" value="<?php echo $row['question']; ?> "required>
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="answer"class="required">Answer</label>
                                                                <textarea class = "form-control" id = "message-text" name = "answer" rows = "8" required><?php echo $row['answer'];?></textarea>
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="severity" class="required">Severity</label>
                                                                <input type="text" class="form-control"  name="severity" min="1" max="5" value="<?php echo $row['severity']; ?> "required>
                                                            </div>
                                                            <?php if ($row['role'] == 'Physician') { ?>

                                                                <label for="role" class="required">Role</label>
                                                                <select id="role" name="role" class="form-control"  value="<?php echo $row['role']; ?>"required>
                                                                    <option value="Physician" selected>Physician</option>
                                                                    <option value="Admin">Admin</option>
                                                                </select>   
                                                                <br><br>

                                                            <?php } else { ?>
                                                                <label for="role"class="required" >Role</label>
                                                                <select id="role" name="role" class="form-control"  value="<?php echo $row['role']; ?>"required>
                                                                    <option value="Physician" >Physician</option>
                                                                    <option value="Admin" selected>Admin</option>
                                                                </select>   
                                                                <br><br>
                                                            <?php } ?>


                                                            <div class="form-submit">
                                                                <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
                                                                <input type="button" value="Back" class="submit" id="back" name="back" onclick="goBack()">

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
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
