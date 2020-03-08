<?php

include('MySQL.php');
$id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

//$query = "SELECT * FROM toy";
//$result = mysqli_query($conn, $query);
$sqlSelect = "SELECT * FROM PatientInfo WHERE ph_id='$id'";
$result = mysqli_query($mysqlconn, $sqlSelect);

$num_column = mysqli_num_fields($result);

$csv_header = '';
for ($i = 0; $i < $num_column; $i++) {
    $csv_header .= '"' . mysqli_fetch_field_direct($result, $i)->name . '",';
}
$csv_header .= "\n";

$csv_row = '';
while ($row = mysqli_fetch_row($result)) {
    for ($i = 0; $i < $num_column; $i++) {
        $csv_row .= '"' . $row[$i] . '",';
    }
    $csv_row .= "\n";
}

/* Download as CSV File */
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=patientinfo.csv');
echo $csv_header . $csv_row;
exit;
