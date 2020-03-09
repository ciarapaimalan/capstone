<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TRAST";

// Create connection
$mysqlconn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($mysqlconn->connect_error) {
    die("Connection failed: " . $mysqlconn->connect_error);
} 
?>