<?php
session_start();
include ('MySQL.php');

$id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

$sql = "SELECT * FROM PatientInfo WHERE ph_id='$id'";
$result = mysqli_query($mysqlconn, $sql);
?>
<?php
$info_id = $_GET['info_id'];
$pulmonary_diagnosis = $mysqlconn->real_escape_string($_POST['pulmonary_diagnosis']);
$other_diagnosis = $mysqlconn->real_escape_string($_POST['other_diagnosis']);
$oxygen_lvl = $mysqlconn->real_escape_string($_POST['oxygen_lvl']);
$special_endorsement = $mysqlconn->real_escape_string($_POST['special_endorsement']);
$username = $mysqlconn->real_escape_string($_POST['username']);
$status = $mysqlconn->real_escape_string($_POST['status']);
$ward = $mysqlconn->real_escape_string($_POST['ward']);
$bed_no = $mysqlconn->real_escape_string($_POST['bed_no']);
$admission_no = $mysqlconn->real_escape_string($_POST['admission_no']);
$hosp_no = $mysqlconn->real_escape_string($_POST['hosp_no']);
$admission_date = $mysqlconn->real_escape_string($_POST['admission_date']);
$disposition = $mysqlconn->real_escape_string($_POST['disposition']);
$discharge_date = $mysqlconn->real_escape_string($_POST['discharge_date']);

$sqlcmd = "update PatientInfo set pulmonary_diagnosis = '$pulmonary_diagnosis', other_diagnosis = '$other_diagnosis', "
        . "oxygen_lvl = '$oxygen_lvl', special_endorsement='$special_endorsement', username='$username'"
        . "status = '$status', ward='$ward', bed_no='$bed_no'"
        . "admission_no = '$admission_no', hosp_no='$hosp_no', admission_date='$admission_date'"
        . "discharge_date = '$discharge_date' where info_id='$info_id'";
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
                                    <?php
                                    $sqlinfo = "SELECT * FROM PatientInfo WHERE ph_id='$id'";

                                    $resultinfo = mysqli_query($mysqlconn, $sqlinfo);
                                    ?>


                                    <form action=""method="post">

                                        <input type="hidden" name ="ph_id" id="ph_id" value="" >
                                        Pulmonary DIagnosis:<input type="text" name="pulmonary_diagnosis" value="<?php echo $pulmonary_diagnosis; ?>"><br>
                                        Other Diagnosis: <input type="text" name="other_diagnosis" value="<?php echo $other_diagnosis; ?>"><br>
                                        Oxygen Level:<input type="text" name="oxygen_lvl" value="<?php echo $oxygen_lvl; ?>"><br>
                                        Special Endorsement: <input type="text" name="special_endorsement" value="<?php echo $oxygen_lvl; ?>"><br>
                                        <input type="hidden" name="physician" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">


                                        Status: <input type="text" name="status" value="<?php echo $status; ?>"/><br>
                                        Ward <input type="text" name="ward" value="<?php echo $ward; ?>"><br>
                                        Bed No.: <input type="text" name="bed_no" value="<?php echo $bed_no; ?>" ><br>


                                        Admission No.: <input type="text" name="admission_no" value="<?php echo $admission_no; ?>"><br>
                                        Hospital No.: <input type="text" name="hosp_no" value="<?php echo $hosp_no; ?>"><br>
                                        Admission Date: <input type="date" name="admission_date" value="<?php echo $admission_date; ?>"><br>
                                        Disposition: <input type="text" name="disposition"value="<?php echo $disposition; ?>"><br>
                                        Discharge Date: <input type="date" name="discharge_date"value="<?php echo $discharge_date; ?>"><br>


                                    </form>

                            </div>
                    </div>
                </div>
                <!-- partial -->



            </div></div>



    </body>


</html>