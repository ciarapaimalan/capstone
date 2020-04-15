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
    $query = "SELECT * FROM FAQs ORDER BY severity ASC ";
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
                    <td class="google-visualization-table-td" style="color:white;">' . $row["severity"] . '</td>  
                    <td>' . $row["role"] . '</td>  

                   </tr>
                    ';
    }

    echo $output;
} else {
    echo 'Question Not Found';
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
