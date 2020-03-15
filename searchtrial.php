<?php
include ('MySQL.php');
session_start();
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>TRAST</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
        <link rel="stylesheet" href="./style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            .select:hover {background-color:#f5f5f5;}
        </style>
    </head>
    <body>
        <!-- partial:index.partial.html -->
        <div id="viewport">
            <!-- Sidebar -->
            <div id="sidebar">
                <br>
                <br>
                <header>
                    <a id="header" > 
                        <br> 
                        <img src="usthlogo.png" style="width:70%;">
                        <br>

                        TRAST
                    </a>

                </header>
                <ul class="nav">
                    <br>
                    <li>
                        <a href="UserHomepage.php">
                            <i class="zmdi zmdi-search"></i> Search Patient
                        </a>
                    </li>
                    <li>
                        <a href="NewPatient.php">
                            <i class="zmdi zmdi-accounts-add"></i> New Patient
                        </a>
                    </li>
                    <li>
                        <a href="HelpPage.php">
                            <i class="zmdi zmdi-help-outline"></i> Help
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="zmdi zmdi-calendar"></i> About
                        </a>
                    </li>
                    <li>
                        <!-- <a href="#">
                          <i class="zmdi zmdi-info-outline"></i> Log Out
                        </a>
                      </li> -->
                        <!-- <li>
                          <a href="#">
                            <i class="zmdi zmdi-settings"></i> Services
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <i class="zmdi zmdi-comment-more"></i> Contact
                          </a>
                        </li> -->
                </ul>
            </div>
            <!-- Content -->
            <div id="content">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav navbar-left">

                            <li> <h3 class="mb-4">TRAST: Thrombosis Risk Assessment System</h3></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>  <a href="UsersProfile.php"><?php echo $_SESSION['username']; ?>
                                    <li><a href="Logout.php">Log Out</a></li></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">


                    <div id="content" class="p-4 p-md-5 pt-5">
                        <!--                        <h2 class="mb-4">TRAST: Thrombosis Risk Assessment System</h2>-->
                        <p>	     
                        <div class="mb-5">
                            <br>
                            <!--                                <button class="button">Import</button>-->
                            <?php echo '<button onclick=location.href="NewPatient.php">Start Risk Assessment</button>'; ?>

                            <br>
                            <br>
                            <h3 class="h6 mb-3"></h3>
                            <div class="form-group d-flex">
                                <div class="icon"><span class="icon-paper-plane"></span></div>
                                <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search Patient">
                            </div>
                            <div id="result"></div>

                            </p>
                        </div>
                    </div>
                </div>
                <?php
//$connect = mysqli_connect("localhost", "root", "", "TRAST");
                include ('MySQL.php');

                $output = '';
                if (isset($_POST["query"])) {
                    $search = mysqli_real_escape_string($mysqlconn, $_POST["query"]);
                    $query = "SELECT * FROM Patient 
  WHERE patient_fname LIKE '%" . $search . "%'
  OR patient_mname LIKE '%" . $search . "%' 
  OR patient_lname LIKE '%" . $search . "%' 
  OR birthdate LIKE '%" . $search . "%' 
  OR sex LIKE '%" . $search . "%'
  OR address LIKE '%" . $search . "%'
  OR contactno LIKE '%" . $search . "%'
 
 ";
                } else {
                    $query = "SELECT * FROM Patient ORDER BY ph_id";
                }
                $result = mysqli_query($mysqlconn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Patient ID</th>
     <th>First Name</th>
     <th>Middle Name</th>
     <th>Last Name</th>
     <th>Birthdate</th>
     <th>Sex</th>
     <th>Address</th>
     <th>Contact No.</th>


    </tr>
 ';
                    while ($row = mysqli_fetch_array($result)) {
//        echo "<a href='searchp.php?fname=" . $row['patient_fname'] . "&lname=" . $row['patient_lname'] . "'>";
                        $output .= '
                  <tr class= "select" onclick=location.href="patientinfo.php?id=' . $row["ph_id"] . '">
                    <td>' . $row["ph_id"] . '</td>
                    <td>' . $row["patient_fname"] . '</td>
                    <td>' . $row["patient_mname"] . '</td>
                    <td>' . $row["patient_lname"] . '</td>
                    <td>' . $row["birthdate"] . '</td>
                    <td>' . $row["sex"] . '</td>
                    <td>' . $row["address"] . '</td>
                    <td>' . $row["contactno"] . '</td>

                   </tr>
                    ';
                    }

                    echo $output;
                } else {
                    echo 'Patient Not Found';
                }
                ?>
                </body>

                <script>
                    $(document).ready(function () {

                        load_data();

                        function load_data(query)
                        {
                            $.ajax({
                                url: "searchtrial.php",
                                method: "POST",
                                data: {query: query},
                                success: function (data)
                                {
                                    $('#result').html(data);
                                }
                            });
                        }
                        $('#search_text').keyup(function () {
                            var search = $(this).val();
                            if (search != '')
                            {
                                load_data(search);
                            } else
                            {
                                load_data();
                            }
                        });
                    });
                </script>
                </html>

