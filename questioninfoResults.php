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
        <link rel="icon" href="usthlogo.png">

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
                        <img src="USTransp.png" style="width:70%;"> 
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
                        <a href="helpsearch.php">
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
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                              <!-- <a href="#"><i class="zmdi zmdi-notifications text-danger"></i>
                              </a> -->
                            </li>
                            <li><a href="Logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">


                    <div id="content" class="p-4 p-md-5 pt-5">
                        <h2 class="mb-4">TRAST: Thrombosis Risk Assessment System</h2>
                        <form>
                            <p>	     
                            <div class="mb-5">
                                <br>
                                <br>
                                <br>
                                <?php
                               
//$RA_ID = $mysqlconn->real_escape_string($_POST['RA_ID']);
                                if (isSet($_POST['submit'])) {
                                    $id = $mysqlconn->real_escape_string($_POST['q_id']);
                                    $question = $mysqlconn->real_escape_string($_POST['question']);
                                    $message = $mysqlconn->real_escape_string($_POST['message']);
                                    $severity = $mysqlconn->real_escape_string($_POST['severity']);

                                    $sql = "Insert into ticket(q_id,question,message,severity,date) values('$id','$question','$message','$severity',NOW() )";

                                    if ($mysqlconn->query($sql) === true) {
                                        $msg = "This incident has been recorded. The administrator will notify you regarding this";
                                    } else {
                                        $msg = "Could not able to execute $sql. " . $mysqlconn->error;
                                    }

                                    echo $msg;
                                    mysqli_close($mysqlconn);
                                }
                                ?>
                                </p>
                            </div>
                    </div>
                </div>
                <!-- partial -->

                </body>
                </html>
