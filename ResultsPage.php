<?php
session_start();
include 'MySQL.php';

// Check connection
if ($mysqlconn === false) {
    die("ERROR: Could not connect. " . $mysqlconn->connect_error);
}

//$RA_ID = $mysqlconn->real_escape_string($_POST['RA_ID']);
$ph_id = $mysqlconn->real_escape_string($_POST['ph_id']);
$step_one = $mysqlconn->real_escape_string($_POST['step_one']);
//$step_two= $mysqlconn->real_escape_string($_POST['step_two']);
$step_two = implode(", ", $_POST['step_two']);
$trf = $mysqlconn->real_escape_string($_POST['trf']);
$regimen = $mysqlconn->real_escape_string($_POST['regimen']);
$anticoagulants = $mysqlconn->real_escape_string($_POST['anticoagulants']);
$anticoagulants_elab = $mysqlconn->real_escape_string($_POST['anticoagulants_elab']);
//$modalities = $mysqlconn->real_escape_string($_POST['modalities']);
$modalities = implode(", ", $_POST['modalities']);
$other_modalities = $mysqlconn->real_escape_string($_POST['other_modalities']);
$username = $mysqlconn->real_escape_string($_POST['username']);
//$exam_date = $mysqlconn->real_escape_string($_POST['exam_date']);
//$date_updated = $mysqlconn->real_escape_string($_POST['date_updated']);


$sql = "Insert into RiskAssessment(ph_id,step_one,step_two,trf,regimen,anticoagulants,anticoagulants_elab,modalities,other_modalities,username,exam_date
) values('$ph_id','$step_one','$step_two','$trf','$regimen','$anticoagulants','$anticoagulants_elab','$modalities','$other_modalities','$username',NOW()
)";

if ($mysqlconn->query($sql) === true) {
    $msg = "This Assessment has been recorded";
} else {
    $msg = "Could not able to execute $sql. " . $mysqlconn->error;
}

echo $msg;
?>
<br>
<?php
$queryStepOne = "SELECT step_one, COUNT(*) As total FROM RiskAssessment WHERE ph_id='$ph_id' GROUP By step_one HAVING COUNT(*)>1";
$resultStepOne = mysqli_query($mysqlconn, $queryStepOne);
if (mysqli_num_rows($resultStepOne) > 0) {
    ?>
    <br>
    <?php while ($row = mysqli_fetch_assoc($resultStepOne)) { ?>

        <span>Step One:</span> <?php echo $row['step_one']; ?><br>
        <span>Total:</span> <?php echo $row['total']; ?><br>

           <?php
    }
} else {
    ?>
    <span>No repeating values for Risk Factors associated with Patient(Step Two) </span><br>
    <?php
}
?>

<br>
<?php
$queryStepTwo = "SELECT step_two, COUNT(*) As total FROM RiskAssessment WHERE ph_id='$ph_id' GROUP By step_two HAVING COUNT(*)>1";
$resultStepTwo = mysqli_query($mysqlconn, $queryStepTwo);
if (mysqli_num_rows($resultStepTwo) > 0) {
    ?>
    <br>
    <?php while ($row = mysqli_fetch_assoc($resultStepTwo)) { ?>

        <span>Step One:</span> <?php echo $row['step_two']; ?><br>
        <span>Total:</span> <?php echo $row['total']; ?><br>

        <?php
    }
} else {
    ?>
    <span>No repeating values for Risk Factors associated with Patient(Step Two)  </span><br>
    <?php
}
?>


<br>
<span>Patient ID:</span> <?php echo $_POST['ph_id']; ?><br>
<span>Step One:</span> <?php echo $_POST['step_one']; ?><br>
<span>Step Two:</span> <?php echo implode(", ", $_POST['step_two']); ?><br>
<span>TRF:</span> <?php echo $_POST['trf']; ?><br>
<span>Risk Level:</span> <?php echo $_POST['regimen']; ?><br>
<span>Anticoagulants:</span> <?php echo $_POST['anticoagulants']; ?><br>
<span>Modalities:</span> <?php echo implode(", ", $_POST['modalities']); ?><br>
<span>Physician:</span> <?php echo $_POST['username']; ?><br>




<?php
mysqli_close($mysqlconn);
?>
