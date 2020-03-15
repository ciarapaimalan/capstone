<?php
session_start();
include('MySQL.php');
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}

$id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

$sql = "SELECT * FROM Patient WHERE ph_id='$id'";

$result = mysqli_query($mysqlconn, $sql);
?>

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
        <!--dropwdown li-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
        <style>
            .select:hover {background-color:#f5f5f5;}

            .split {
                height: 100%;
                width: 50%;
                z-index: 1;
                top: 0;
                overflow-x: hidden;
                padding-top: 20px;
            }

            .left {
                left: 0;
            }

            .right {
                right: 0;
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
                            <li> 
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" ><?php echo $_SESSION['username']; ?><span class="caret"></span></a>
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


                    <div>
                        <h2>Schedule a Check-Up</h2>                    
                        <?php
                        if ($mysqlconn === false) {
                            die("ERROR: Could not connect. " . $mysqlconn->connect_error);
                        }
                        if (isset($_POST['submit'])) {

                            $ph_id = $mysqlconn->real_escape_string($_POST['ph_id']);
                            $contactno = $mysqlconn->real_escape_string($_POST['contactno']);
                            $date = $mysqlconn->real_escape_string($_POST['date']);
                            $start_time = $mysqlconn->real_escape_string($_POST['start_time']);
                            $end_time = $mysqlconn->real_escape_string($_POST['end_time']);
                            $username = $mysqlconn->real_escape_string($_POST['username']);
                            $note = $mysqlconn->real_escape_string($_POST['note']);


                            $sql = "INSERT INTO schedule(ph_id,contactno,date,start_time,end_time,username,note)"
                                    . "values('$ph_id','$contactno','$date','$start_time','$end_time','$username','$note')";

                            if ($mysqlconn->query($sql) === true) {
                                $msg = "New schedule Record has been added";
                            } else {
                                $msg = "Could not able to execute $sql. " . $mysqlconn->error;
                            }

                            echo $msg;
                        }
                        ?>
                        <div class="signup-form">
                            <form action="" method="POST" action="" class="register-form" id="register-form">
                                <div class="form-group">                      

                                    <?php
                                    $sqlpatient = mysqli_query($mysqlconn, "SELECT patient_fname,patient_lname,contactno FROM Patient WHERE ph_id='$id'");
                                    while ($row = mysqli_fetch_array($sqlpatient)) {
                                        echo'<h3>Patient Name: ' . $row["patient_fname"] . '   ' . $row["patient_lname"] . ' </h3><br>';
                                        echo'<input  type="hidden" value="' . $row["contactno"] . '"  id ="contactno" name="contactno" >';
                                    }
                                    ?>
                                    <input type="hidden" name ="ph_id" id="ph_id" value="" >
                                    <div class="form-input">
                                        <label for="date" class="required">Date</label>
                                        <input type="date" name="date" class="date" required ><br>
                                    </div>

                                    <div class="form-input">
                                        <label for="start_time" class="required">Start Time</label>
                                        <input type="time" name="start_time" class="start_time" required ><br>
                                    </div>
                                    <div class="form-input">
                                        <label for="end_time" class="required">End Time</label>
                                        <input type="time" name="end_time" class="end_time" required ><br>
                                    </div>
                                    <div class="form-input">
                                        <label for="note" class="required">Note</label>
                                        <br><textarea name="note" id="note" rows="10" cols="116"> </textarea>
                                    </div>
                                    <input type="hidden" name="username" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">



                                    <input type="submit" name="submit" value="submit" class="submit"/>
                                    <input type="button" onclick="goBack()" class="back" value="Back">
                                    <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                    </script> 
                                </div>
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
    //        alert(val);

    document.getElementById("ph_id").setAttribute("value", val);

</script>
</html>  

