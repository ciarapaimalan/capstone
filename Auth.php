<?php
// creates a session
session_start();
// calls MySQL.php to connect to MYSQL
include('MySQL.php');

$username = $_POST['username'];
$password = $_POST['password'];
$fullname = $_POST['fullname'];


$query = mysqli_query($mysqlconn, "select * from UserAccnt where username='$username' && password='$password'");
$numrows = mysqli_num_rows($query);

if ($numrows == 0) {
    $_SESSION['message'] = "User not found!";
    header('location:index.php');
} else {    $row = mysqli_fetch_array($query);
    $_SESSION['username'] = $row['username'];
    $_SESSION['fullname'] = $row['FullName'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['current_profile'] = $row['role'];
    $_SESSION['prev_page'] = 'index.php';
    header('location:RedirectRole.php');
}
mysqli_close($mysqlconn);

?>

