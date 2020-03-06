<?php
$servername = "m7wltxurw8d2n21q.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "ha7xbwdngl5av8or";
$password = "a8aw0lfub5f6mi1a";
$dbname = "bc0990wooq1l4kf1	";

// Create connection
$mysqlconn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($mysqlconn->connect_error) {
    die("Connection failed: " . $mysqlconn->connect_error);
} 
?>
