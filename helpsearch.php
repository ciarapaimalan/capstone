<?php

//$connect = mysqli_connect("localhost", "root", "", "TRAST");
include ('MySQL.php');

$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($mysqlconn, $_POST["query"]);
    $query = "SELECT * FROM FAQs 
  WHERE role='Physician' AND question LIKE '%" . $search . "%'
 ";
} else {
    $query = "SELECT * FROM FAQs WHERE role='Physician' ORDER BY q_id ";
}
$result = mysqli_query($mysqlconn, $query);
if (mysqli_num_rows($result) > 0) 
    {
    $output .= '
        <div class="table-responsive">
         <table class="table table bordered">
          <tr>
           <th>Question</th>

          </tr>
 ';
    while ($row = mysqli_fetch_array($result)) {
//        echo "<a href='searchp.php?fname=" . $row['patient_fname'] . "&lname=" . $row['patient_lname'] . "'>";
        $output .= '
                  <tr class= "select" onclick=location.href="questioninfo.php?id=' . $row["q_id"] . '">
                    <td>' . $row["question"] . '</td>
     

                   </tr>
                    ';
    }

    echo $output;
} else {
    echo 'Question Not Found';
}
?>
