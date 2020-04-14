<?php
session_start();
include('MySQL.php');
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}

$id = mysqli_real_escape_string($mysqlconn, $_GET['id']);
?>
<?php
include('MySQL.php');
$message = '';
//problem: uploads even when eid column are empty 
if (isset($_POST["upload"])) {
    if ($_FILES['PatientInfo']['name']) {
        $filename = explode(".", $_FILES['PatientInfo']['name']);
        if (end($filename) == "csv") {
            $handle = fopen($_FILES['PatientInfo']['tmp_name'], "r");
            fgetcsv($handle, 10000, ",");
            if (($column = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $sqlcmd = "INSERT into PatientInfo (ph_id,diagnosis_one,diagnosis_two,oxygen_lvl,special_endorsement,username,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,date)
                   values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "','" . $column[7] . "','" . $column[8] . "','" . $column[9] . "','" . $column[10] . "','" . $column[11] . "','" . $column[12] . "','" . $column[13] . "')";

                $result = mysqli_query($mysqlconn, $sqlcmd);

                if (!empty($result)) {
                    $type = "success";
                    $message = "CSV Data Imported into the Database";
                } else {
                    $type = "error";
                    $message = "Problem in Importing CSV Data";
                }
            }
        }
        fclose($handle);
// header("location: UpdateTable.php?updation=1");
    } else {
        $message = '<label class="text-danger">Please Select CSV File only</label>';
    }
} else {
    $message = '<label class="text-danger">Please Select File</label>';
}


$sqlcmd = "SELECT * FROM PatientInfo";
$result = mysqli_query($mysqlconn, $sqlcmd);
?>
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


                    <div>
                        <h2>New Patient's Chart Form</h2>                    
                        <?php
                        if ($mysqlconn === false) {
                            die("ERROR: Could not connect. " . $mysqlconn->connect_error);
                        }
                        if (isset($_POST['submit'])) {
                            $ph_id = $mysqlconn->real_escape_string($_POST['ph_id']);
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


                            $sql = "INSERT INTO PatientInfo(ph_id,diagnosis_one,diagnosis_two,oxygen_lvl,special_endorsement,username,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,date)"
                                    . "values('$ph_id','$diagnosis_one','$diagnosis_two','$oxygen_lvl','$special_endorsement','$username','$status','$ward','$bed_no','$admission_no','$hosp_no','$admission_date','$disposition','$date')";


                            if ($mysqlconn->query($sql) === true) {
                                ?>
                                <div class="alert alert-success">
                                    <strong>Success!</strong> New Patient Information Record has been added.
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
                            <div class="signup-form">
                                <div class="container-fluid">
                                    <?php
                                    $sqlpatient = mysqli_query($mysqlconn, "SELECT patient_fname,patient_mname,patient_lname,contactno FROM Patient WHERE ph_id='$id'");
                                    while ($row = mysqli_fetch_array($sqlpatient)) {
                                        echo'<h3><i>Patient Name: ' . $row["patient_fname"] . '   ' . $row["patient_mname"] . ' ' . $row["patient_lname"] . ' </i></h3><br>';
                                    }
                                    ?>
                                    <form action = "" method = "POST" action = "" >
                                        <div class="form-row">
                                            <div class="form-group">

                                                <input type="hidden" name ="ph_id" id="ph_id" value="" >
                                                <div class="form-input">
                                                    <label for="diagnosis_one" class="required">Diagnosis 1</label>
                                                    <input type="text" name="diagnosis_one" required/>
                                                </div>
                                                <div class="form-input">
                                                    <label for="diagnosis_two" class="required">Diagnosis 2</label>
                                                    <input type="text" name="diagnosis_two"required/>                              
                                                </div>
                                                <div class="form-input">
                                                    <label for="oxygen_lvl" class="required">Oxygen Level</label>
                                                    <input type="text" name="oxygen_lvl"required/>                                
                                                </div>
                                                <div class="form-input">
                                                    <label for="special_endorsement" class="required">Special Endorsement</label>
                                                    <input type="text" name="special_endorsement"required/>                                      
                                                </div>

                                                <input type="hidden" name="username" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">

                                                <div class="form-input">
                                                    <label for="status" class="required">Status</label>
                                                    <input type="text" name="status"required/>                              
                                                </div>

                                                <div class="form-input">
                                                    <label for="ward" class="required">Ward</label>
                                                    <input type="text" name="ward"required/>                               
                                                </div>
                                                <div class="form-input">
                                                    <label for="bed_no" class="required">Bed No.</label>
                                                    <input type="text" name="bed_no"required/>        
                                                </div>
                                                <div class="form-input">
                                                    <label for="admission_no" class="required">Admission No.</label>
                                                    <input type="text" name="admission_no"required/>   
                                                </div> 
                                                <div class="form-input">
                                                    <label for="hosp_no" class="required">Hospital No.</label>
                                                    <input type="text" name="hosp_no"required/>
                                                </div>

                                                <div class="form-input">
                                                    <label for="admission_date" class="required">Admission Date</label>
                                                    <input type="date" name="admission_date"required/>   
                                                </div>
                                                <div class="form-input">
                                                    <label for="disposition" class="required">Disposition</label>
                                                    <select id="disposition" name="disposition"class="form-control" required>
                                                        <option value="In-Patient">In-Patient</option>
                                                        <option value="Discharged">Discharged</option>
                                                        <option value="Deceased">Deceased</option>
                                                    </select>   
                                                </div>
                                                <div class="form-input">
                                                    <label for="date" class="required">Date</label>
                                                    <input type="date" name="date"required/>            
                                                </div>

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

    </body>
    <script>
        var val = "<?php echo $id ?>";
        //          alert(val);

        document.getElementById("ph_id").setAttribute("value", val);

        function goBack() {
            window.history.back();
        }
    </script>
</html>  


