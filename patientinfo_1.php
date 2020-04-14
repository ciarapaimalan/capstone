<html>
    <head></head>
    <style>

    </style>
    <body>
        <div class="form">

            <?php
            include ('MySQL.php');

            $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

            $sql = "SELECT * FROM PatientInfo WHERE ph_id='$id'";
            
            $result = mysqli_query($mysqlconn, $sql);
            ?>
            <table>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    ?> 
                    <span>First Name:</span> <?php echo $row['patient_fname']; ?><br>
                    <span>Middle Name:</span> <?php echo $row['patient_mname']; ?><br>
                    <span>Last Name:</span> <?php echo $row['patient_lname']; ?><br>
                    <span>Age:</span> <?php echo $row['age']; ?><br>
                    <span>Birthdate:</span> <?php echo $row['birthdate']; ?><br>
                    <span>Sex:</span> <?php echo $row['sex']; ?><br>
                    <span>Address:</span> <?php echo $row['address']; ?><br>
                    <span>Pulmonary Diagnosis:</span> <?php echo $row['pulmonary_diagnosis']; ?><br>
                    <span>Other Diagnosis:</span> <?php echo $row['other_diagnosis']; ?><br>
                    <span>Oxygen Level:</span> <?php echo $row['oxygen_lvl']; ?><br>
                    <span>Special Endorsement:</span> <?php echo $row['special_endorsement']; ?><br>
                    <span>Physician:</span> <?php echo $row['username']; ?><br>
                    <span>Status:</span> <?php echo $row['status']; ?><br>
                    <span>Ward:</span> <?php echo $row['ward']; ?><br>
                    <span>Bed No.:</span> <?php echo $row['bed_no']; ?><br>
                    <span>Admission No.:</span> <?php echo $row['admission_no']; ?><br>
                    <span>Hospital No.:</span> <?php echo $row['hosp_no']; ?>
                    <span>Admission Date:</span> <?php echo $row['admission_date']; ?><br>
                    <span>Disposition:</span> <?php echo $row['disposition']; ?><br>
                    <span>Discharge Date:</span> <?php echo $row['discharge_date']; ?><br>

                    <?php
                    echo '<button onclick=location.href="Assessment.php?id=' . $row["ph_id"] . '">StartAssessment</button>';
                }
                ?>
                     <br><br> RISK ASSESSMENTS:<br><br>
                <?php
                $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

                $sqlrisk = "SELECT * FROM RiskAssessment WHERE ph_id='$id'";

                $result = mysqli_query($mysqlconn, $sqlrisk);
                ?>
                <table>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        ?> 
                        <span>Assessment Date:</span> <?php echo $row['exam_date']; ?><br>
                        <span>Risk Factors associated with Clinical Setting (Step One):</span> <?php echo $row['step_one']; ?><br>
                        <span>RIsk Factors associated with Patient(Step Two):</span> <?php echo $row['step_two']; ?><br>
                        <span>Total Risk Factor:</span> <?php echo $row['trf']; ?><br>
                        <span>Contraindication to anticoagulants?:</span> <?php echo $row['anticoagulants']; ?><br>
                        <span>Modalities:</span> <?php echo $row['modalities']; ?><br>
                        <span>Physcian:</span> <?php echo $row['username']; ?><br>


                        <?php
                    }
                    ?>

            </table>    




        </div>

    </body>

</html>