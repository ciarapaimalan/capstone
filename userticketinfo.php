<?php
include ('MySQL.php');
session_start();
$username = mysqli_real_escape_string($mysqlconn, $_SESSION['username']);


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
                width: 100%;
                border:2pt;
                /*                border: 1px solid #ddd;*/

            }

            th, td {
                text-align: left;
                padding: 10px;
                border: 1px solid #ddd;
                font-size:12px;
            }

            /*            tr:nth-child(even){background-color: #f2f2f2}*/

            th {

                background-color: #737373;
                color: white;
                font-size:12px;
            }
            /*            span{
                            font-weight:bold;
                            font-size: 12pt;
                            padding:5px;
            
                        }*/
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
            .dashed {
                border-style: dashed;
                padding: 10px;

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

                            <li><a href="Logout.php">Log Out</a></li></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">


                    <!-- partial -->
                    <div>

                        <h2 class="mb-4">Ticket</h2>
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
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            ?> 

                            <div class="container-fluid">
                                <br>
                                <div class="signup-form">
                                    <div class="container-fluid">

                                        <form action="" method="POST" >
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <div class="form-input">
                                                        <div class="form-input">
                                                            <label for="date">Date</label>
                                                            <input type="text" class="form-control" name="date" value="<?php echo $row['date']; ?> "readonly>
                                                        </div>
                                                        <div class="form-input">
                                                            <label for="question" >Question</label>
                                                            <input type="text" class="form-control"  name="question" value="<?php echo $row['question']; ?>"readonly>
                                                        </div>
                                                        <div class="form-input">
                                                            <label for="message">Message</label>
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
                                                                <option value="Processing">Process</option>
                                                                <option value="Cancelled">Cancel</option>
                                                            </select>  <?php
                                                        }
                                                        ?>

                                                    </div>

                                                    <div class="form-input">
                                                        <label for="adminmessage" class="required" >Message from Admin</label>
                                                        <textarea class="form-control" id="message-text" name="adminmessage" rows="8" readonly><?php echo $row['adminmessage']; ?></textarea>
                                                    </div>
                                                    <input type="hidden" name="id" class="id" required readonly value="<?php echo $row['id']; ?>">

                                                    <input type="hidden" name="adminusername" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">
                                                    <?php
                                                    date_default_timezone_set('Asia/Manila');
                                                    ?>

                                                    <input type="hidden" name="dateupdated" value="<?= date('Y-m-d'); ?>"> 
                                                <?php } ?>
                                                <?php
                                                if ($row['status'] == 'Processing') {
                                                    ?>
                                                    <div class="form-submit">
                                                        <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
                                                        <input type="button" value="Back" class="submit" id="back" name="back" onclick="goBack()">

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