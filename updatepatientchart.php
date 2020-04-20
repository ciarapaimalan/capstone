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
                            <h2 class="mb-4">Update Patients's Record</h2>
                            <?php
                            $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

                            $sql = "SELECT Patient.*, PatientInfo.info_id,PatientInfo.diagnosis_one,PatientInfo.diagnosis_two,PatientInfo.oxygen_lvl,PatientInfo.special_endorsement, PatientInfo.username, PatientInfo.status, PatientInfo.ward, PatientInfo.bed_no, PatientInfo.admission_no, PatientInfo.hosp_no, PatientInfo.admission_date, PatientInfo.disposition, PatientInfo.date "
                                    . "FROM Patient INNER JOIN PatientInfo ON (Patient.ph_id = PatientInfo.ph_id) WHERE info_id = '$id'";
                            $result = mysqli_query($mysqlconn, $sql);
                            ?>

                            <?php
                            if ($mysqlconn === false) {
                                die("ERROR: Could not connect. " . $mysqlconn->connect_error);
                            }

                            if (isSet($_POST['submit'])) {
                                $diagnosis_one = $mysqlconn->real_escape_string($_POST['diagnosis_one']);
                                $diagnosis_two = $mysqlconn->real_escape_string($_POST['diagnosis_two']);
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
                                $date = $mysqlconn->real_escape_string($_POST['date']);
                                $sqlcmd = "UPDATE PatientInfo SET diagnosis_one = '$diagnosis_one', diagnosis_two = '$diagnosis_two', oxygen_lvl = '$oxygen_lvl', special_endorsement = '$special_endorsement', username = '$username', status = '$status', ward = '$ward', bed_no = '$bed_no', admission_no = '$admission_no', hosp_no = '$hosp_no', admission_date = '$admission_date', disposition = '$disposition', date = '$date'"
                                        . "where info_id = '$id'";
                                if ($mysqlconn->query($sqlcmd) === true) {
                                    ?>
                                    <div class="alert alert-success">
                                        <strong>Success!</strong> Patient Chart Record has been updated.
                                    </div>
                                    <?php
                                    echo "<script type='text/javascript'>window.top.location='ManagePatientInfo.php';</script>";
                                } else {
                                    ?>
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> Please check your inputs.
                                    </div>
                                    <?php
                                }
                            }
                            if (isSet($_POST['Delete'])) {
                                $sqlcmd = "DELETE from PatientInfo WHERE info_id = '$id'";
                                if ($mysqlconn->query($sqlcmd) === true) {
                                    ?>
                                    <div class="alert alert-warning">
                                        <strong>Warning!</strong> Patient Chart Record has been Deleted.
                                    </div>
                                    <?php
                                    echo "<script type = 'text/javascript'>window.top.location = 'ManagePatientInfo.php';</script>";
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

                            <div class="container-fluid">
                                <br>
                                <div class="signup-form">
                                    <div class="container-fluid">
                                        <div class="container-fluid">
                                            <form action="" method="POST" >

                                                <button type="submit" name="Delete"class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete </button><br><br>
                                            </form>

                                            <form action = "" method = "POST" action = "" >
                                                <?php
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo'<h3><i>Patient Name: ' . $row["patient_fname"] . '   ' . $row["patient_mname"] . ' ' . $row["patient_lname"] . ' </i></h3><br>';
                                                    ?> 

                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <div class="form-input">
                                                                <label for="diagnosis_one" class="required">Diagnosis 1</label>
                                                                <input type="text" name="diagnosis_one" class="form-control"value="<?php echo $row['diagnosis_one']; ?>"required/>
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="diagnosis_two" class="required" >Diagnosis 2</label>
                                                                <input type="text" name="diagnosis_two" class="form-control" value="<?php echo $row['diagnosis_two']; ?>" required/>                              
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="oxygen_lvl"  class="required">Oxygen Level</label>
                                                                <input type="text" name="oxygen_lvl" class="form-control" value="<?php echo $row['oxygen_lvl']; ?>" required/>                                
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="special_endorsement" class="required">Special Endorsement</label>
                                                                <input type="text" name="special_endorsement"  class="form-control" value="<?php echo $row['special_endorsement']; ?>" required/>                                      
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="username"class="required" >Physician</label>
                                                                <input type="text" name="username"  class="form-control" value="<?php echo $row['username']; ?>" readonly required>
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="status" class="required">Status</label>
                                                                <input type="text" name="status" class="form-control" value="<?php echo $row['status']; ?>"required />                              
                                                            </div>

                                                            <div class="form-input">
                                                                <label for="ward" class="required" >Ward</label>
                                                                <input type="text" name="ward" class="form-control" value="<?php echo $row['ward']; ?>" required/>                               
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="bed_no" class="required">Bed No.</label>
                                                                <input type="text" name="bed_no"class="form-control" value="<?php echo $row['bed_no']; ?>" required/>        
                                                            </div>
                                                            <div class="form-input">
                                                                <label for="admission_no" class="required">Admission No.</label>
                                                                <input type="text" name="admission_no" class="form-control" value="<?php echo $row['admission_no']; ?>" required/>   
                                                            </div> 
                                                            <div class="form-input">
                                                                <label for="hosp_no"class="required" >Hospital No.</label>
                                                                <input type="text" name="hosp_no" class="form-control"value="<?php echo $row['hosp_no']; ?>" required/>
                                                            </div>

                                                            <div class="form-input">
                                                                <label for="admission_date" class="required" >Admission Date</label>
                                                                <input type="date" name="admission_date" class="form-control" value="<?php echo $row['admission_date']; ?>" required/>   
                                                            </div>
                                                            <?php
                                                            if ($row['disposition'] == 'Deceased') {
                                                                ?>
                                                                <div class="form-input">
                                                                    <label for="disposition" class="required">Disposition</label>
                                                                    <select id="disposition" name="disposition"class="form-control" required>
                                                                        <option value="In-Patient">In-Patient</option>
                                                                        <option value="Discharged">Discharged</option>
                                                                        <option value="Deceased" selected>Deceased</option>
                                                                    </select>   
                                                                </div>
                                                            <?php } else if ($row['disposition'] == 'Discharged') { ?>

                                                                <div class="form-input">
                                                                    <label for="disposition" class="required">Disposition</label>
                                                                    <select id="disposition" name="disposition"class="form-control" required>
                                                                        <option value="In-Patient">In-Patient</option>
                                                                        <option value="Discharged" selected>Discharged</option>
                                                                        <option value="Deceased">Deceased</option>
                                                                    </select>   
                                                                </div>
                                                            <?php } else { ?>

                                                                <div class="form-input">
                                                                    <label for="disposition" class="required">Disposition</label>
                                                                    <select id="disposition" name="disposition"class="form-control" required>
                                                                        <option value="In-Patient" selected>In-Patient</option>
                                                                        <option value="Discharged">Discharged</option>
                                                                        <option value="Deceased">Deceased</option>
                                                                    </select>   
                                                                </div>

                                                            <?php } ?>

                                                            <div class="form-input">
                                                                <label for="date"class="required" >Date</label>
                                                                <input type="date" name="date" class="form-control" value="<?php echo $row['date']; ?>" readonly required/>            
                                                            </div>

                                                            <div class="form-submit">
                                                                <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
                                                                <input type="button" value="Back" class="submit" id="back" name="back" onClick="window.location = 'ManagePatientInfo.php'">
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
