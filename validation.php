<?php
if (isset($_POST['submit'])) {

    $ph_id = $mysqlconn->real_escape_string($_POST['ph_id']);
    $contactno = $mysqlconn->real_escape_string($_POST['contactno']);
    $date = $mysqlconn->real_escape_string($_POST['date']);
    $start_time = $mysqlconn->real_escape_string($_POST['start_time']);
    $end_time = $mysqlconn->real_escape_string($_POST['end_time']);
    $username = $mysqlconn->real_escape_string($_POST['username']);
    $note = $mysqlconn->real_escape_string($_POST['note']);

    $allow = 0;
    $query = "select * from schedule where ph_id='$ph_id' && start_time='$start_time'&& date='$date'&& status='Upcoming'";
    $result = mysqli_query($mysqlconn, $query);

    if (mysqli_num_rows($result) == 0) {
        $allow = 1;
    } else {
        while ($row = mysqli_fetch_array($result)) {
            if (
                    $row['start_time'] < $row['end_time'] &&
                    $row['start_time'] <= $start_time &&
                    $start_time <= $row['end_time']
            ) {
                $allow = 0;
                //error msg
                break;
            } else if (
                    $row['start_time'] < $row['end_time'] &&
                    $row['start_time'] <= $end_time &&
                    $end_time <= $row['end_time']
            ) {
                $allow = 0;
                //error msg             
                break;
            } else if (
                    $row['start_time'] < $row['end_time'] &&
                    $start_time <= $row['start_time'] &&
                    $row['end_time'] <= $end_time
            ) {
                $allow = 0;
                //error msg                
                break;
            } else if (
                    $row['start_time'] < $row['end_time'] &&
                    $row['start_time'] <= $start_time &&
                    $start_time <= $row['end_time']
            ) {
                $allow = 0;
                //error msg
                break;
            }
        }
    }
    if ($allow == 1) {
// Attempt insert query execution
        $sql = "INSERT INTO schedule(ph_id,contactno,date,start_time,end_time,username,note)"
                . "values('$ph_id','$contactno','$date','$start_time','$end_time','$username','$note')";

        if ($mysqlconn->query($sql) === true) {
            ?>
            <div class="alert alert-success">
                <strong>Success!</strong> New Schedule Record has been added.
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <strong>Error!</strong> Please check your inputs.
            </div>
            <?php
        }
    } else if ($allow == 1) {
        ?>
        <div class="alert alert-danger">
            <strong>Error!</strong> Please check your inputs.
        </div>
        <?php
    } else {
        $compare = mysqli_query($mysqlconn, "select username from schedule where ph_id='$ph_id' && start_time='$start_time'&& date='$date'&& status='Upcoming'");
        while ($row = mysqli_fetch_array($compare)) {
            ?>
            <div class="alert alert-danger">
                <strong>Error!</strong> The check-up schedule to this patient has been taken by
                <?php
                echo'<b><i>' . $row["username"] . '.</i></b>';
            }
            ?>
            Please enter a different schedule.
        </div>
        <?php
    }
}
?>
