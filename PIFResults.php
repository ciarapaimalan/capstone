<?php

session_start();
include 'MySQL.php';

// Check connection
if ($mysqlconn === false) {
    die("ERROR: Could not connect. " . $mysqlconn->connect_error);
}


$pulmonary_diagnosis = $mysqlconn->real_escape_string($_POST['pulmonary_diagnosis']);
$other_diagnosis = $mysqlconn->real_escape_string($_POST['other_diagnosis']);
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
$discharge_date = $mysqlconn->real_escape_string($_POST['discharge_date']);


$sql = "INSERT INTO PatientInfo(pulmonary_diagnosis,oxygen_lvl,special_endorsement,physician,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,discharge_date)"
        . "values($address,$pulmonary_diagnosis,$other_diagnosis,$oxygen_lvl,$special_endorsement,$physician,$status,$ward,$bed_no,$admission_no,$hosp_no,$admission_date,$disposition,$discharge_date)";

if ($mysqlconn->query($sql) === true) {
    $msg = "New Patient Record has been added";
} else {
    $msg = "Could not able to execute $sql. " . $mysqlconn->error;
}

echo $msg;
mysqli_close($mysqlconn);
?>