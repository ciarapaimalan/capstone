<?php
session_start();
include 'MySQL.php';

// Check connection
if ($mysqlconn === false) {
    die("ERROR: Could not connect. " . $mysqlconn->connect_error);
}


$diagnosis_one = $mysqlconn->real_escape_string($_POST['diagnosis_one']);
$diagnosis_two = $mysqlconn->real_escape_string($_POST['diagnosis_two']);
$oxygen_lvl = $mysqlconn->real_escape_string($_POST['oxygen_lvl']);
$special_endorsement = $mysqlconn->real_escape_string($_POST['special_endorsement']);
$physician = $mysqlconn->real_escape_string($_POST['physician']);
$status = $mysqlconn->real_escape_string($_POST['status']);
$ward = $mysqlconn->real_escape_string($_POST['ward']);
$bed_no = $mysqlconn->real_escape_string($_POST['bed_no']);
$admission_no = $mysqlconn->real_escape_string($_POST['admission_no']);
$hosp_no = $mysqlconn->real_escape_string($_POST['hosp_no']);
$admission_date = $mysqlconn->real_escape_string($_POST['admission_date']);
$disposition = $mysqlconn->real_escape_string($_POST['disposition']);
$date = $mysqlconn->real_escape_string($_POST['date']);


$sql = "INSERT INTO PatientInfo(diagnosis_one,diagnosis_two,oxygen_lvl,special_endorsement,physician,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,date)"
        . "values($diagnosis_one,$diagnosis_two,$oxygen_lvl,$special_endorsement,$physician,$status,$ward,$bed_no,$admission_no,$hosp_no,$admission_date,$disposition,$date)";
if ($mysqlconn->query($sql) === true) {
    ?>
    <div class="alert alert-success">
        <strong>Success!</strong>New Patient Record has been added.
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-danger">
        <strong>Error!</strong> Please check your inputs.
    </div>
    <?php
}
mysqli_close($mysqlconn);
?>
?>