<?php
session_start();
include('MySQL.php');
//$id = mysqli_real_escape_string($mysqlconn, $_GET['id']);


if (isSet($_POST['submit'])) {
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

    switch ($_POST['SelectActions']) {
        case "ACTION_CREATE":
            $sqlcmd = "INSERT INTO PatientInfo(ph_id,pulmonary_diagnosis,other_diagnosis,oxygen_lvl,special_endorsement,username,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,discharge_date)"
                    . "values('$ph_id','$pulmonary_diagnosis','$other_diagnosis','$oxygen_lvl','$special_endorsement','$username','$status','$ward','$bed_no','$admission_no','$hosp_no','$admission_date','$disposition','$discharge_date')";
            break;
        case "ACTION_UPDATE":
            $PatientInfoList = $mysqlconn->real_escape_string($_POST['PatientInfoList']);
//            $sqlcmd = "update users set FullName = '$fullname', Profile = '$profile', password = '$password', eid='$eid' where eid = '$eidlist'";
            $sqlcmd = "UPDATE PatientInfo set pulmonary_diagnosis = '$pulmonary_diagnosis', other_diagnosis = '$other_diagnosis', "
                    . "oxygen_lvl = '$oxygen_lvl', special_endorsement='$special_endorsement', username='$username'"
                    . "status = '$status', ward='$ward', bed_no='$bed_no'"
                    . "admission_no = '$admission_no', hosp_no='$hosp_no', admission_date='$admission_date'"
                    . "discharge_date = '$discharge_date' where info_id = '$PatientInfoList'";
            break;
        case "ACTION_DELETE":
            $PatientInfoList = $mysqlconn->real_escape_string($_POST['PatientInfoList']);
            $sqlcmd = "DELETE from PatientInfo where info_id = '$PatientInfoList'";
            break;
    }

    if ($mysqlconn->query($sqlcmd) === true) {
        echo 'User table successfully updated';
        $_POST['submit'] = '';
    } else {
        echo "ERROR: Could not able to execute $sqlcmd. " . $mysqlconn->error;
    }
}
if (isset($_POST['search'])) {
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $conn = "SELECT * FROM PatientInfo WHERE CONCAT(pulmonary_diagnosis,other_diagnosis,oxygen_lvl,special_endorsement,username,status,ward,bed_no,admission_no,hosp_no,admission_date,disposition,discharge_date) LIKE '%" . $valueToSearch . "%'";
    $search_result = filterTable($conn);
} else {
    $conn = "SELECT * FROM PatientInfo";
    $search_result = filterTable($conn);
}

// function to connect and execute the query
function filterTable($conn) {
    include('MySQL.php');
    $filter_Result = mysqli_query($mysqlconn, $conn);
    return $filter_Result;
}
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>

        <form action="" method="post" name="frmUser" >
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>

            <table>
                <tr>
                    <th></th>
                    <th>No.</th>

                    <th>Pulmonary Diagnosis</th>
                    <th>Other Diagnosis</th>
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
                    <th>Discharge Date</th>
                </tr>
                <?php $i = 0; ?>
                <!-- populate table from mysql database -->
                <?php while ($row = mysqli_fetch_array($search_result)): ?>
                    <tr>
                    <tr class="<?php if (isset($classname)) echo $classname; ?>">
                        <td><input type="radio" name="PatientInfoList" value="<?php echo $row['info_id']; ?>"></td>
                        <td><?php echo $row['ph_id']; ?></td>
                        <td><?php echo $row['pulmonary_diagnosis']; ?></td>
                        <td><?php echo $row['other_diagnosis']; ?></td>
                        <td><?php echo $row['oxygen_lvl']; ?></td>
                        <td><?php echo $row['special_endorsement']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['ward']; ?></td>
                        <td><?php echo $row['bed_no']; ?></td>
                        <td><?php echo $row['admission_no']; ?></td>
                        <td><?php echo $row['hosp_no']; ?></td>
                        <td><?php echo $row['admission_date']; ?></td>
                        <td><?php echo $row['disposition']; ?></td>
                        <td><?php echo $row['discharge_date']; ?></td>

                    </tr>

                <?php endwhile; ?>

                <tr>
                    <td> Add Record:</td>
                    <td> <input type="number" name="ph_id" class="ph_id"></td>

                    <td><input type="text" name="pulmonary_diagnosis" class="pulmonary_diagnosis"></td>
                    <td><input type="text" name="other_diagnosis" class="other_diagnosis"></td>
                    <td><input type="text" name="oxygen_lvl" class="oxygen_lvl"></td>
                    <td><input type="text" name="special_endorsement" class="special_endorsement"></td>
                    <td><input type="text" name="username" class="username"  required readonly value="<?php echo $_SESSION['username']; ?>"></td>


                    <td> <input type="text" name="status" class="status"></td>
                    <td> <input type="text" name="ward" class="ward"></td>
                    <td>  <input type="text" name="bed_no" class="bed_no"></td>


                    <td> <input type="text" name="admission_no"class="admission_no"></td>
                    <td><input type="text" name="hosp_no" class="hosp_no"></td>
                    <td><input type="date" name="admission_date" class="admission_date"></td>
                    <td> <input type="text" name="disposition" class="disposition"></td>
                    <td> <input type="date" name="discharge_date" class="discharge_date"></td>


                </tr> 
                <tr class="listheader">
                <tr class="listheader">
                    <td colspan="6">
                        Mode: <select name="SelectActions">
                            <option value="ACTION_CREATE">Create</option>
                            <option value="ACTION_UPDATE">Update</option>
                            <option value="ACTION_DELETE">Delete</option>

                        </select>
                        <input type="submit" name="submit" value="Submit">


                    </td>
                </tr>
            </table>
        </form>
        <br>
        <button onclick="goBack()">Go Back</button>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </body>
</html>