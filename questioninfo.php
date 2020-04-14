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
        <link rel="stylesheet" href="./style3.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <!--dropwdown li-->
        <link rel="icon" href="usthlogo.png">

        <style>
            .select:hover {background-color:#f5f5f5;}
            textarea {
                width: 50%;
                height: 100px;
                padding: 12px 20px;
                box-sizing: border-box;
                border: 2px solid #ebebeb;
                border-radius: 4px;
                resize: none;
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

                            <li><a href="Logout.php">Log Out</a></li>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">

                    <div class="container-fluid">
                        <br><br>

                        <p>	     
                        <div class="mb-5">
                            <?php
                            if ($mysqlconn === false) {
                                die("ERROR: Could not connect. " . $mysqlconn->connect_error);
                            }

                            if (isSet($_POST['submit'])) {
                                $id = $mysqlconn->real_escape_string($_POST['q_id']);
                                $question = $mysqlconn->real_escape_string($_POST['question']);
                                $message = $mysqlconn->real_escape_string($_POST['message']);
                                $severity = $mysqlconn->real_escape_string($_POST['severity']);
                                $username = $mysqlconn->real_escape_string($_POST['username']);
                                $date = $mysqlconn->real_escape_string($_POST['date']);

                                $sql = "Insert into ticket(q_id,question,message,severity,username,date) values('$id','$question','$message','$severity','$username','$date' )";
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
                            <?php
                            $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

                            $sql = "SELECT * FROM FAQs WHERE q_id='$id'";
                            $result = mysqli_query($mysqlconn, $sql);
                            ?>
                            <table>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    ?> 
                                    <h1><?php echo $row['question']; ?></h1><br><br>
                                    <?php echo $row['answer']; ?><br>


                                    <?php
                                }
                                ?>
                            </table>    
                            <br>
                            <br>
                            Need more assistance?<br>

                            <form action=""method="post">

                                <?php
                                $sql = mysqli_query($mysqlconn, "SELECT question FROM FAQs WHERE q_id='$id'");
                                while ($row = mysqli_fetch_array($sql)) {
                                    echo'<tr><td><input  type="hidden" value="' . $row["question"] . '"  id ="question" name="question" ></td></tr>';
                                }
                                ?>
                                <br>
                                <?php
                                $sql = mysqli_query($mysqlconn, "SELECT severity FROM FAQs WHERE q_id='$id'");
                                while ($row = mysqli_fetch_array($sql)) {
                                    echo'<tr><td><input  type="hidden" value="' . $row["severity"] . '"  id ="severity" name="severity" ></td></tr>';
                                }
                                ?>

                                <br>

                                <input type="hidden" name="username" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">
                                <?php
                                date_default_timezone_set('Asia/Manila');
                                ?>
                                <input type="hidden" name="date" value="<?= date('Y-m-d'); ?>"> 
                                <input type="checkbox" name ="q_id" id="q_id" value="" onclick="ShowHideDiv()"> Let us know about this incident<br><br>
                                <div id="dvtext" style="display: none">

                                    Tell us more about this concern:<br>

                                    <textarea name="message" id="message" rows="10" cols="30"  class="form__input" required> </textarea>
                                    <br>

                                    <input type="submit" name="submit" class="btn btn-success">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <script>
        var val = "<?php echo $id ?>";

        document.getElementById("q_id").setAttribute("value", val);
        //call date
        function ShowHideDiv() {
            var q_id = document.getElementById("q_id");
            var dvtext = document.getElementById("dvtext");
            dvtext.style.display = q_id.checked ? "block" : "none";
        }
    </script>
</html>
