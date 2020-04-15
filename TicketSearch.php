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
    $query = "SELECT * FROM ticket WHERE status='Processing' ORDER BY severity ASC LIMIT 20 ";
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
                    <td class="google-visualization-table-td" style="color:white;">' . $row["severity"] . '</td>
                    <td>' . $row["status"] . '</td>  
                   </tr>
                    ';
    }

    echo $output;
} else {
    echo 'Ticket Not Found';
}
?>
<script>
    var elements = document.getElementsByClassName('google-visualization-table-td');

    for (var i = 0; i < elements.length; i++) {
        var value = elements[i].innerText || elements[i].textContent;

        if (value === '1') {
            elements[i].style.backgroundColor = '#d9534f';
        } else if (value === '2') {
            elements[i].style.backgroundColor = '#f0ad4e';
        } else if (value === '3') {
            elements[i].style.backgroundColor = '#5bc0de';
        } else if (value === '4') {
            elements[i].style.backgroundColor = '#5cb85c';
        }

    }
    
</script>
