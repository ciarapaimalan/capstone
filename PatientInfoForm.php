<?php
session_start();
include('MySQL.php');
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}

$id = mysqli_real_escape_string($mysqlconn, $_GET['id']);
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
                            <li>  <a href="UsersProfile.php"><?php echo $_SESSION['username']; ?>
                                    <li><a href="Logout.php">Log Out</a></li></li>
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


                            $sql = "INSERT INTO PatientInfo(ph_id,other_diagnosis,pulmonary_diagnosis,oxygen_lvl,special_endorsement,username,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,discharge_date)"
                                    . "values('$ph_id','$pulmonary_diagnosis','$other_diagnosis','$oxygen_lvl','$special_endorsement','$username','$status','$ward','$bed_no','$admission_no','$hosp_no','$admission_date','$disposition','$discharge_date')";

                            if ($mysqlconn->query($sql) === true) {
                                $msg = "New Patient Record has been added";
                            } else {
                                $msg = "Could not able to execute $sql. " . $mysqlconn->error;
                            }

                            echo $msg;
                        }
                        ?>

                        <div class = "signup-form">

                            <form action = "" method = "POST" action = "" class = "register-form" id = "register-form">
                                <div class = "form-group"

                                     <?php
                                     $sqlpatient = mysqli_query($mysqlconn, "SELECT patient_fname,patient_lname,contactno FROM Patient WHERE ph_id='$id'");
                                     while ($row = mysqli_fetch_array($sqlpatient)) {
                                         echo'<h3>Patient Name: ' . $row["patient_fname"] . '   ' . $row["patient_lname"] . ' </h3><br>';
                                     }
                                     ?>
                                     <input type="hidden" name ="ph_id" id="ph_id" value="" >
                                    <div class="form-input">
                                        <label for="pulmonary_diagnosis" class="required">Pulmonary Diagnosis</label>
                                        <input type="text" name="pulmonary_diagnosis"/>
                                    </div>
                                    <div class="form-input">
                                        <label for="other_diagnosis" class="required"> Other Diagnosis</label>
                                        <input type="text" name="other_diagnosis"/>                                        </div>
                                    <div class="form-input">
                                        <label for="oxygen_lvl" class="required">Oxygen Level</label>
                                        <input type="text" name="oxygen_lvl"/>                                
                                    </div>
                                    <div class="form-input">
                                        <label for="special_endorsement" class="required">Special Endorsement</label>
                                        <input type="text" name="special_endorsement"/>                                        </div>

                                    <input type="hidden" name="username" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">

                                    <div class="form-input">
                                        <label for="status" class="required">Status</label>
                                        <input type="text" name="status"/>                              
                                    </div>

                                    <div class="form-input">
                                        <label for="ward" class="required">Ward</label>
                                        <input type="text" name="ward"/>                               
                                    </div>
                                    <div class="form-input">
                                        <label for="bed_no" class="required">Bed No.</label>
                                        <input type="text" name="bed_no"/>        
                                    </div>
                                    <div class="form-input">
                                        <label for="admission_no" class="required">Admission No.</label>
                                        <input type="text" name="admission_no"/>   
                                    </div> 
                                    <div class="form-input">
                                        <label for="hosp_no" class="required">Hospital No.</label>
                                        <input type="text" name="hosp_no"/>
                                    </div>

                                    <div class="form-input">
                                        <label for="admission_date" class="required">Admission Date</label>
                                        <input type="date" name="admission_date"/>   
                                    </div>
                                    <div class="form-input">
                                        <label for="disposition" class="required">Disposition</label>
                                        <select id="disposition" name="disposition" style=" box-sizing: border-box;
                                                border: 1px solid #ebebeb;
                                                padding: 14px 20px;
                                                border-radius: 5px;
                                                -moz-border-radius: 5px;
                                                -webkit-border-radius: 5px;
                                                -o-border-radius: 5px;
                                                -ms-border-radius: 5px;
                                                font-size: 14px;
                                                font-family: 'Poppins';" >
                                            <option value="In-Patient">In-Patient</option>
                                            <option value="Discharged">Discharged</option>
                                            <option value="Deceased">Deceased</option>
                                        </select>   
                                    </div>
                                    <div class="form-input">
                                        <label for="discharge_date" class="required">Hospital No.</label>
                                        <input type="date" name="discharge_date"/>                                        </div>


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
//          alert(val);

    document.getElementById("ph_id").setAttribute("value", val);

</script>
</html>  


