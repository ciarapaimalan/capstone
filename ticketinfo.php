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
                            <h2 class="mb-4">Update Ticket</h2>
                            <br>
                            <?php
                            $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

                            $sql = "SELECT * FROM ticket WHERE id='$id'";
                            $result = mysqli_query($mysqlconn, $sql);
                            ?>
                            <?php
                            if ($mysqlconn === false) {
                                die("ERROR: Could not connect. " . $mysqlconn->connect_error);
                            }

                            if (isSet($_POST['submit'])) {
                                $id = $mysqlconn->real_escape_string($_POST['id']);

                                $question = $mysqlconn->real_escape_string($_POST['question']);
                                $message = $mysqlconn->real_escape_string($_POST['message']);
                                $severity = $mysqlconn->real_escape_string($_POST['severity']);
                                $username = $mysqlconn->real_escape_string($_POST['username']);
                                $status = $mysqlconn->real_escape_string($_POST['status']);

                                $date = $mysqlconn->real_escape_string($_POST['date']);
                                $adminmessage = $mysqlconn->real_escape_string($_POST['adminmessage']);
                                $adminusername = $mysqlconn->real_escape_string($_POST['adminusername']);
                                $dateupdated = $mysqlconn->real_escape_string($_POST['dateupdated']);

                                $sqlcmd = "update ticket set question  = '$question', message = '$message', severity='$severity', status='$status', username='$username', date='$date',adminmessage='$adminmessage',adminusername='$adminusername',dateupdated='$dateupdated'WHERE id='$id'";
                                if ($mysqlconn->query($sqlcmd) === true) {
                                    ?>
                                    <div class="alert alert-success">
                                        <strong>Success!</strong> Incident has been Updated.
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
                                $sqlcmd = "delete from ticket where id = '$id'";
                                if ($mysqlconn->query($sqlcmd) === true) {
                                    echo "<script type='text/javascript'>window.top.location='ManageTicketsTrial.php';</script>";
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

                                            <form action="" method="POST" >
                                                <button type="submit" name="Delete"class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button><br><br>

                                                <div class="form-row">
                                                    <div class="form-group">
                                                        <div class="form-input">
                                                            <div class="form-input">
                                                                <label for="date">Date</label>
                                                                <input type="text" class="form-control" name="date" value="<?php echo $row['date']; ?> "readonly>
                                                            </div>
                                                            <?php
                                                            if ($row['severity'] == '1') {
                                                                $message = "Severity 1 (Urgent)";
                                                            } else if ($row['severity'] == '2') {
                                                                $message = "Severity 2 (High)";
                                                            } else if ($row['severity'] == '3') {
                                                                $message = "Severity 3 (Normal)";
                                                            } else if ($row['severity'] == '4') {
                                                                $message = "Severity 4 (Minor)";
                                                            }
                                                            ?>
                                                            <div class="form-input">
                                                                <label for="severity">Severity</label>
                                                                <input type="text" class="form-control" id="severity" name="severity" value="<?php echo $message ?> "readonly>
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="username" >Username</label>
                                                                <input type="text" class="form-control"  name="username" value="<?php echo $row['username']; ?> "readonly>
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="question" >Question</label>
                                                                <input type="text" class="form-control"  name="question" value="<?php echo $row['question']; ?>"readonly>
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="message">Message From User</label>
                                                                <textarea class="form-control" id="message-text" name="message" rows="5" readonly><?php echo $row['message']; ?></textarea>
                                                            </div>
                                                            <?php
                                                            if ($row['status'] == 'Resolved') {
                                                                ?>
                                                                <div class="form-input">
                                                                    <label for="date">Date Updated</label>
                                                                    <input type="text" class="form-control" name="date" value="<?php echo $row['dateupdated']; ?> "readonly>
                                                                </div>

                                                                <label for="status">Status</label>
                                                                <select id="disposition" name="status" class="form-control" readonly>   
                                                                    <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>

                                                                </select> <?php
                                                            } else {
                                                                ?><label for="status">Status</label>
                                                                <select id="disposition" name="status" class="form-control" >   
                                                                    <option value="Processing">Processing</option>
                                                                    <option value="Resolved">Resolved</option>
                                                                </select>  <?php
                                                            }
                                                            ?>
                                                            </select>   
                                                        </div>
                                                        <?php if ($row['status'] == 'Resolved') { ?>
                                                            <div class = "form-input">
                                                                <label for = "adminmessage" class = "required" >Message to User</label>
                                                                <textarea class = "form-control" id = "message-text" name = "adminmessage" rows = "8" readonly><?php echo $row['adminmessage'];
                                                            ?></textarea>
                                                            </div>
                                                        <?php } else {
                                                            ?>
                                                            <div class = "form-input">
                                                                <label for = "adminmessage" class = "required" >Message to User</label>
                                                                <textarea class = "form-control" id = "message-text" name = "adminmessage" rows = "8" required><?php echo $row['adminmessage'];
                                                            ?></textarea>
                                                            </div>
                                                        <?php } ?>
                                                        <input type="hidden" name="id" class="id" required readonly value="<?php echo $row['id']; ?>">

                                                        <input type="hidden" name="adminusername" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">

                                                        <?php
                                                        date_default_timezone_set('Asia/Manila');
                                                        ?>

                                                        <input type="hidden" name="dateupdated" value="<?= date('Y-m-d'); ?>"> 

                                                        <?php
                                                        if ($row['status'] == 'Processing') {
                                                            ?>
                                                            <div class="form-submit">
                                                                <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
                                                                <input type="button" value="Back" class="submit" id="back" name="back" onclick="goBack()">

                                                            </div>
                                                        <?php } ?>

                                                    </div>
                                                <?php } ?>
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
