<?php

//$connect = mysqli_connect("localhost", "root", "", "TRAST");
include ('MySQL.php');

$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($mysqlconn, $_POST["query"]);
    $query = "SELECT Patient.*, PatientInfo.info_id,PatientInfo.diagnosis_one,PatientInfo.diagnosis_two,PatientInfo.oxygen_lvl,PatientInfo.special_endorsement, PatientInfo.username, PatientInfo.status, PatientInfo.ward, PatientInfo.bed_no, PatientInfo.admission_no, PatientInfo.hosp_no, PatientInfo.admission_date, PatientInfo.disposition, PatientInfo.date "
            . "FROM Patient INNER JOIN PatientInfo ON (Patient.ph_id = PatientInfo.ph_id) WHERE
  Patient.patient_fname LIKE '%" . $search . "%'
  OR Patient.patient_mname LIKE '%" . $search . "%' 
  OR Patient.patient_lname LIKE '%" . $search . "%' 
  OR Patient.birthdate LIKE '%" . $search . "%' 
  OR Patient.sex LIKE '%" . $search . "%'
  OR diagnosis_one LIKE '%" . $search . "%'
  OR diagnosis_two LIKE '%" . $search . "%'
  OR oxygen_lvl LIKE '%" . $search . "%'   
  OR special_endorsement LIKE '%" . $search . "%'
  OR username LIKE '%" . $search . "%'
  OR status LIKE '%" . $search . "%'   
  OR ward LIKE '%" . $search . "%'
  OR bed_no LIKE '%" . $search . "%'
  OR admission_no LIKE '%" . $search . "%'   
  OR hosp_no LIKE '%" . $search . "%'
  OR admission_date LIKE '%" . $search . "% '
  OR disposition LIKE '%" . $search . "%'   
  OR date LIKE '%" . $search . "%'

";
} else {
    $query = "SELECT Patient.*, PatientInfo.info_id,PatientInfo.diagnosis_one,PatientInfo.diagnosis_two,PatientInfo.oxygen_lvl,PatientInfo.special_endorsement, PatientInfo.username, PatientInfo.status, PatientInfo.ward, PatientInfo.bed_no, PatientInfo.admission_no, PatientInfo.hosp_no, PatientInfo.admission_date, PatientInfo.disposition, PatientInfo.date "
            . "FROM Patient INNER JOIN PatientInfo ON (Patient.ph_id = PatientInfo.ph_id)";
}
$result = mysqli_query($mysqlconn, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
  <div class="table-responsive" >
   <table class="table table bordered" >
    <tr >
     <th>Patient ID</th>
     <th>First Name</th>
     <th>Middle Name</th>
     <th>Last Name</th>
     <th>Birthdate</th>
     <th>Sex</th>
    <th>Diagnosis 1</th>
    <th>Diagnosis 2</th>
    <th>Oxygen Level</th>
    <th>Special Endorsement</th>
    <th>Physician</th>
    <th>Status</th>
    <th>Ward</th>
    <th>Bed No.</th>
    <th>Admission No.</th>
    <th>Hospital No.</th>
    <th>Admission Date</th>
    <th>Disposition</th>
    <th>Date</th>


    </tr>
 ';
    while ($row = mysqli_fetch_array($result)) {
//        echo "<a href='searchp.php?fname=" . $row['patient_fname'] . "&lname=" . $row['patient_lname'] . "'>";
        $output .= '
                  <tr class= "select" onclick=location.href="updatepatientchart.php?id=' . $row["info_id"] . '">
                    <td>' . $row["ph_id"] . '</td>
                    <td>' . $row["patient_fname"] . '</td>
                    <td>' . $row["patient_mname"] . '</td>
                    <td>' . $row["patient_lname"] . '</td>
                    <td>' . $row["birthdate"] . '</td>
                    <td>' . $row["sex"] . '</td>
                    
                     <td>' . $row["diagnosis_one"] . '</td>
                    <td>' . $row["diagnosis_two"] . '</td>
                    <td>' . $row["oxygen_lvl"] . '</td>
                    <td>' . $row["special_endorsement"] . '</td>
                    <td>' . $row["username"] . '</td>
                    <td>' . $row["status"] . '</td>
                    
                    <td>' . $row["ward"] . '</td>
                    <td>' . $row["bed_no"] . '</td>
                    <td>' . $row["admission_no"] . '</td>
                    <td>' . $row["hosp_no"] . '</td>
                    <td>' . $row["admission_date"] . '</td>
                    <td>' . $row["disposition"] . '</td>
                    <td>' . $row["date"] . '</td>

                   </tr>
                    ';
    }

    echo $output;
} else {
    echo 'Patient Chart Not Found';
}
?>