<?php

//$connect = mysqli_connect("localhost", "root", "", "TRAST");
include ('MySQL.php');

$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($mysqlconn, $_POST["query"]);
    $query = "SELECT * FROM UserAccnt 
 WHERE  user_id LIKE '%" . $search . "%' 
  OR username LIKE '%" . $search . "%'
  OR password LIKE '%" . $search . "%' 
  OR fullname LIKE '%" . $search . "%' 
  OR role LIKE '%" . $search . "%' 
 
  ";
} else {
    $query = "SELECT * FROM UserAccnt ORDER BY username ASC LIMIT 20";
}
$result = mysqli_query($mysqlconn, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
        <div class="table-responsive">
         <table class="table table bordered">
          <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Fullname</th>
            <th>Role</th>

          </tr>
 ';
    while ($row = mysqli_fetch_array($result)) {
//        echo "<a href='searchp.php?fname=" . $row['patient_fname'] . "&lname=" . $row['patient_lname'] . "'>";
        $output .= '
                  <tr class= "select" onclick=location.href="userinfo.php?user_id=' . $row["user_id"] . '">
                    <td>' . $row["username"] . '</td>
                    <td>' . $row["password"] . '</td>
                    <td>' . $row["fullname"] . '</td>
                    <td>' . $row["role"] . '</td>
                   </tr>
                    ';
    }

    echo $output;
} else {
    echo 'User Not Found';
}
?>