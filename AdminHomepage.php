<?php
include ('MySQL.php');
session_start();
$username = mysqli_real_escape_string($mysqlconn, $_SESSION['username']);
?>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>TRAST</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
        <link rel="stylesheet" href="./style3.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />


        <!--        tabs-->
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <!-- Datatables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
        <script src="https://nightly.datatables.net/js/dataTables.bootstrap.js"></script>


        <style>
            .select:hover {background-color:#f5f5f5;}
            body {font-family: Arial;}

            /* Style the tab */
            .tab {
                overflow: hidden;
                border: 2px solid #ccc;
                background-color: #Black;
            }

            /* Style the buttons inside the tab */
            .tab button {
                background-color: inherit;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                padding: 14px 16px;
                transition: 0.3s;
                font-size: 20px;
            }

            /* Change background color of buttons on hover */
            .tab button:hover {
                background-color: #ddd;
            }

            /* Create an active/current tablink class */
            .tab button.active {
                background-color: #ccc;
            }

            /* Style the tab content */
            .tabcontent {
                display: none;
                padding: 6px 12px;
                border: 1px solid #ccc;
                border-top: none;
            }
            table {
                border-collapse: collapse;
                width: 95%;
                border:2pt;
                border: 1px solid #ddd;

            }

            th, td {
                text-align: left;
                padding: 10px;
                border: 1px solid #ddd;
                font-size:12px;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {

                background-color: #737373;
                color: white;
            }
            span{
                font-weight:bold;
                font-size: 12pt;
                padding:5px;

            }
            button{
                background-color: #737373; 
                border: none;
                color: white;
                padding: 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 2px 4px;
                cursor: pointer;

            }

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
                        <a href="AdminHomepage.php">
                            <i class="zmdi zmdi-search"></i> Manage Patients
                        </a>
                    </li>
                    <li>
                        <a href="ManageUsers.php">
                            <i class="zmdi zmdi-accounts-add"></i> Manage Users
                        </a>
                    </li>
                    <li>
                        <a href="ManageTickets.php">
                            <i class="zmdi zmdi-accounts-add"></i> Manage Tickets
                        </a>
                    </li>
                    <li>
                        <a href="ManageSchedule.php">
                            <i class="zmdi zmdi-accounts-add"></i> Manage Schedules
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
                            <li>  <a><?php echo $_SESSION['username']; ?>
                                    <li><a href="Logout.php">Log Out</a></li></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">

                    <div id="content" class="p-4 p-md-5 pt-5">
                        <h2>Manage Patient's Information</h2>
                        <br>


                        <?php
                        include ('MySQL.php');

                        if (isSet($_POST['submit'])) {
                            $patient_fname = $mysqlconn->real_escape_string($_POST['patient_fname']);
                            $patient_mname = $mysqlconn->real_escape_string($_POST['patient_mname']);
                            $patient_lname = $mysqlconn->real_escape_string($_POST['patient_lname']);
                            $birthdate = $mysqlconn->real_escape_string($_POST['birthdate']);
                            $sex = $mysqlconn->real_escape_string($_POST['sex']);
                            $address = $mysqlconn->real_escape_string($_POST['address']);
                            $contactno = $mysqlconn->real_escape_string($_POST['contactno']);

                            switch ($_POST['SelectActions']) {
                                case "ACTION_CREATE":
                                    $sqlcmd = "INSERT INTO Patient(patient_fname,patient_mname,patient_lname,birthdate,sex,address,contactno)"
                                            . "values('$patient_fname','$patient_mname','$patient_lname','$birthdate','$sex','$address','$contactno')";
                                    break;
                                case "ACTION_UPDATE":
                                    $patientlist = $mysqlconn->real_escape_string($_POST['patientlist']);
                                    $sqlcmd = "update Patient set patient_fname = '$patient_fname', patient_mname = '$patient_mname', patient_lname='$patient_lname', birthdate='$birthdate', sex='$sex', address='$address', contactno='$contactno'where patient_fname = '$patientlist'";

                                    break;
                                case "ACTION_DELETE":
                                    $patientlist = $mysqlconn->real_escape_string($_POST['patientlist']);
                                    $sqlcmd = "delete from Patient where patient_fname = '$patientlist'";
                                    break;
                            }

                            if ($mysqlconn->query($sqlcmd) === true) {
                                echo 'Patient Information table successfully updated<br>';
                                $_POST['submit'] = '';
                            } else {
                                echo "ERROR: Could not able to execute $sqlcmd. " . $mysqlconn->error;
                            }
                        }
                        if (isset($_POST['search'])) {
                            $valueToSearch = $_POST['valueToSearch'];
                            // search in all table columns
                            // using concat mysql function
                            $conn = "SELECT * FROM Patient(patient_fname,patient_mname,patient_lname,birthdate,sex,address,contactno) LIKE '%" . $valueToSearch . "%'";
                            $search_result = filterTable($conn);
                        } else {
                            $conn = "SELECT * FROM Patient";
                            $search_result = filterTable($conn);
                        }

// function to connect and execute the query
                        function filterTable($conn) {
                            include('MySQL.php');
                            $filter_Result = mysqli_query($mysqlconn, $conn);
                            return $filter_Result;
                        }
                        ?>
                        <form action="" method="post" name="frmUser" >
                            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
                            <input type="submit" name="search" value="Filter"><br><br>

                            <table>
                                <tr>
                                    <th></th>  
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Birthdate</th>
                                    <th>Sex</th>
                                    <th>Address</th>
                                    <th>Contact No.</th>

                                </tr>
                                <?php $i = 0; ?>
                                <!-- populate table from mysql database -->
                                <?php while ($row = mysqli_fetch_array($search_result)): ?>
                                    <tr>
                                    <tr class="<?php if (isset($classname)) echo $classname; ?>">
                                        <td><input type="radio" name="patientlist" value="<?php echo $row['patient_fname']; ?>"></td>   

                                        <td><?php echo $row['patient_fname']; ?></td>
                                        <td><?php echo $row['patient_mname']; ?></td>
                                        <td><?php echo $row['patient_lname']; ?></td>
                                        <td><?php echo $row['birthdate']; ?></td>
                                        <td><?php echo $row['sex']; ?></td>
                                        <td><?php echo $row['address']; ?></td> 
                                        <td><?php echo $row['contactno']; ?></td>




                                    </tr>

                                <?php endwhile; ?>
                                <tr>
                                    <td> Add User:</td>         


                                    <td><input type="textbox"  name="patient_fname" class="patient_fname" > </td>
                                    <td><input type="textbox"  name="patient_mname" class="patient_mname"> </td>
                                    <td><input type="textbox"  name="patient_lname" class="patient_lname"> </td>

                                    <td><input type="date"  name="birthdate" class="birthdate" > </td>
                                    <td> <select name="sex" >
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select> </td>           
                                    <td><input type="textbox"  name="address" class="address"> </td>
                                    <td><input type="textbox"  name="contactno" class="contactno"> </td>

                                </tr> 
                                <tr class="listheader">
                                <tr class="listheader">
                                    <td colspan="8">
                                        Mode: <select name="SelectActions">
                                            <option value="ACTION_CREATE">Create</option>
                                            <option value="ACTION_UPDATE">Update</option>
                                            <option value="ACTION_DELETE">Delete</option>

                                        </select>
                                        <input type="submit" name="submit" value="Submit">


                                    </td>
                                </tr>
                            </table>
                        </form>


                    </div>

                </div>
            </div>



        </div>
    </div>
</div>

</body>


</html>