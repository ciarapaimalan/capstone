<?php

//$connect = mysqli_connect("localhost", "root", "", "TRAST");
include ('MySQL.php');

$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($mysqlconn, $_POST["query"]);
    $query = "SELECT * FROM ticket 
 WHERE date LIKE '%" . $search . "%'
  OR username LIKE '%" . $search . "%' 
  OR question LIKE '%" . $search . "%' 
  OR severity LIKE '%" . $search . "%' 
  OR status LIKE '%" . $search . "%'
  OR adminmessage LIKE '%" . $search . "%'
  OR dateupdated LIKE '%" . $search . "%'
  OR adminusername LIKE '%" . $search . "%'

 
  ";
} else {
    $query = "SELECT * FROM ticket WHERE status='Processing' ORDER BY Severity DESC LIMIT 20 ";
}
$result = mysqli_query($mysqlconn, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
        <div class="table-responsive">
         <table class="table table bordered">
          <tr>
                                                <th>Date</th>
                                                <th>Username</th>
                                                <th>Incident</th>
                                                <th>Severity</th>
                                                <th>Status</th>

          </tr>
 ';
    while ($row = mysqli_fetch_array($result)) {
//        echo "<a href='searchp.php?fname=" . $row['patient_fname'] . "&lname=" . $row['patient_lname'] . "'>";
        $output .= '
                  <tr class= "select" onclick=location.href="ticketinfo.php?id=' . $row["id"] . '">
                    <td>' . $row["date"] . '</td>
                    <td>' . $row["username"] . '</td>
                    <td>' . $row["question"] . '</td>
                    <td>' . $row["severity"] . '</td>
                    <td>' . $row["status"] . '</td>  
                   </tr>
                    ';
    }

    echo $output;
} else {
    echo 'Ticket Not Found';
}
?>