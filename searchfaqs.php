<?php

//$connect = mysqli_connect("localhost", "root", "", "TRAST");
include ('MySQL.php');
session_start();

$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($mysqlconn, $_POST["query"]);
    $query = "SELECT * FROM FAQs WHERE  question LIKE '%" . $search . "%'
  OR answer LIKE '%" . $search . "%' 
  OR severity LIKE '%" . $search . "%' 
  OR role LIKE '%" . $search . "%' 
  
  ";
} else {
    $query = "SELECT * FROM FAQs ORDER BY severity DESC ";
}
$result = mysqli_query($mysqlconn, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
        <div class="table-responsive">
         <table class="table table bordered">
          <tr>
                                                <th>Question</th>
                                                <th>Answer</th>
                                                <th>Severity</th>
                                                <th>Role</th>

          </tr>
 ';
    while ($row = mysqli_fetch_array($result)) {
//        echo "<a href='searchp.php?fname=" . $row['patient_fname'] . "&lname=" . $row['patient_lname'] . "'>";
        $output .= '
                  <tr class= "select" onclick=location.href="updatefaqs.php?id=' . $row["q_id"] . '">
                    <td>' . $row["question"] . '</td>
                    <td>' . $row["answer"] . '</td>
                    <td>' . $row["severity"] . '</td>  
                    <td>' . $row["role"] . '</td>  

                   </tr>
                    ';
    }

    echo $output;
} else {
    echo 'Question Not Found';
}
?>