<?php

//$connect = mysqli_connect("localhost", "root", "", "TRAST");
include ('MySQL.php');

$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($mysqlconn, $_POST["query"]);
    $query = "SELECT * FROM Patient 
  WHERE patient_fname LIKE '%" . $search . "%'
  OR patient_mname LIKE '%" . $search . "%' 
  OR patient_lname LIKE '%" . $search . "%' 
  OR birthdate LIKE '%" . $search . "%' 
  OR sex LIKE '%" . $search . "%'
  OR address LIKE '%" . $search . "%'
  OR contactno LIKE '%" . $search . "%'
 
 ";
} else {
    $query = "SELECT * FROM Patient ORDER BY ph_id DESC";
}
$result = mysqli_query($mysqlconn, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Patient ID</th>
     <th>First Name</th>
     <th>Middle Name</th>
     <th>Last Name</th>
     <th>Birthdate</th>
     <th>Sex</th>
     <th width="30%">Address</th>
     <th>Contact No.</th>


    </tr>
 ';
    while ($row = mysqli_fetch_array($result)) {
//        echo "<a href='searchp.php?fname=" . $row['patient_fname'] . "&lname=" . $row['patient_lname'] . "'>";
        $output .= '
                  <tr class= "select" onclick=location.href="patientinfo.php?id=' . $row["ph_id"] . '">
                    <td>' . $row["ph_id"] . '</td>
                    <td>' . $row["patient_fname"] . '</td>
                    <td>' . $row["patient_mname"] . '</td>
                    <td>' . $row["patient_lname"] . '</td>
                    <td>' . $row["birthdate"] . '</td>
                    <td>' . $row["sex"] . '</td>
                    <td>' . $row["address"] . '</td>
                    <td>' . $row["contactno"] . '</td>

                   </tr>
                    ';
    }

    echo $output;
} else {
    echo 'Patient Not Found';
}
?>