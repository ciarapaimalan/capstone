<?php
session_start();
include ('MySQL.php');

$id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

$sql = "SELECT * FROM PatientInfo WHERE ph_id='$id'";
$result = mysqli_query($mysqlconn, $sql);
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
                            <li>
                                                             <!-- <a href="#"><i class="zmdi zmdi-notifications text-danger"></i>
                                                             </a> -->
                            </li>
                            <li> <button> <?php echo $_SESSION['username']; ?></button> </li>
                            <li>  <a href="UsersProfile.php"><?php echo $_SESSION['username']; ?></li>

                        </ul>
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
                                <h3> Patient Infomation Form </h3>

                                <form action="PIFResults.php"method="post">

                                    <input type="hidden" name ="ph_id" id="ph_id" value="" >

                                    Pulmonary DIagnosis:<input type="text" name="pulmonary_diagnosis"/><br>
                                    Other Diagnosis: <input type="text" name="other_diagnosis"/><br>
                                    Oxygen Level:<input type="text" name="oxygen_lvl"/><br>
                                    Special Endorsement: <input type="text" name="special_endorsement"/><br>
                                    <input type="hidden" name="physician" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">


                                    Status: <input type="text" name="status"/><br>
                                    Ward <input type="text" name="ward"/><br>
                                    Bed No.: <input type="text" name="bed_no"/><br>


                                    Admimission No.: <input type="text" name="admission_no"/><br>
                                    Hospital No.: <input type="text" name="hosp_no"/><br>
                                    Admission Date: <input type="date" name="admission_date"/><br>
                                    Disposition: <input type="text" name="disposition"/><br>
                                    Discharge Date: <input type="date" name="discharge_date"/><br>


                                    <input type="submit" name="Submit" value="Submit">  


                                </form>

                            </div>
                    </div>
                </div>
                <!-- partial -->



            </div></div>



    </body>


</html>