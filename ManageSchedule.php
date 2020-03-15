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
                            <i class="zmdi zmdi-search"></i> Search Patient
                        </a>
                    </li>
                    <li>
                        <a href="AdminNewPatient.php">
                            <i class="zmdi zmdi-accounts-add"></i> New Patient
                        </a>
                    </li>
                    <li>
                        <a href=“AdminHelpPage.php">
                            <i class="zmdi zmdi-help-outline"></i> Help
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="zmdi zmdi-calendar"></i> About
                        </a>
                    </li>

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
                            <li> 

                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" >Manage<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="ManageUsers.php">User</a></li>
                                    <li><a href="ManagePatient.php">Patients</a></li>
                                    <li><a href="ManagePatientInfo.php">Patient's Charts</a></li>
                                    <li><a href="ManageSchedule.php">Schedule</a></li>
                                    <li><a href="ManageTickets.php">Tickets</a></li>
                                    <li><a href="AdminChangePw.php">Change Password</a></li>
                                </ul>
                            </li>

                            <li><a href="Logout.php">Log Out</a></li></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">

                    <div id="content" class="p-4 p-md-5 pt-5">
                        <h2>Manage Scheduled Check-Ups</h2>

                        <?php
                        if (isset($_POST['SelectRow'])) {

                            switch ($_POST['SelectActions']) {
                                case "ACTION_CANCELLED":
                                    $sql = 'update schedule set status = "Cancelled" where ';
                                    updateList($sql);
                                    break;

                                case "ACTION_DONE":
                                    $sql = 'update schedule set status = "Done" where ';
                                    updateList($sql);
                                    break;
                            }
                        }

                        function updateList($sql) {
                            include 'MySQL.php';

                            $criteria = "";
                            foreach ($_POST['SelectRow'] as $value) {
                                $criteria = $criteria . "sched_id=" . $value . " or ";
                            }


                            $criteria = rtrim($criteria, " or ");

                            $criteria;

                            $sql = $sql . $criteria;


                            if ($mysqlconn->query($sql) == true) {
                                echo "<br><b>Schedule Updated</b>";
                            }

                            $mysqlconn->close();
                        }
                        ?>

                        <?php
                        $sql = "SELECT Patient.*, schedule.*
                                     FROM Patient
                                     INNER JOIN schedule
                                     ON (Patient.ph_id = schedule.ph_id) ";

                        $profileActions = '<option value="ACTION_CANCELLED">Cancel</option>'
                                . '<option value="ACTION_DONE">Done</option>';
                        $result = mysqli_query($mysqlconn, $sql);
                        ?>
                        <form action="" method="post" name="frmUser" >
                            <br><br>
                            <table>
                                <tr>
                                    <th> </th>
                                    <th> Patient No.</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Contact No.</th>
                                    <th>Scheduled date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Physician</th>
                                    <th>Note</th>
                                    <th>Status</th>

                                </tr>
                                <tr>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td> <input type='checkbox' name='SelectRow[]' value=" . $row['sched_id'] . ">";
                                        echo "<td>" . $row['ph_id'] . "</td>";
                                        echo "<td>" . $row['patient_fname'] . "</td>";
                                        echo "<td>" . $row['patient_mname'] . "</td>";
                                        echo "<td>" . $row['patient_lname'] . "</td>";
                                        echo "<td>" . $row['contactno'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['start_time'] . "</td>";
                                        echo "<td>" . $row['end_time'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['note'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "</tr>";
                                    }

                                    echo "</table>";

                                    mysqli_close($mysqlconn);
                                    ?>

                                <br><br>
                                Select Action to Perform: <select name="SelectActions">
                                    <?php echo $profileActions ?>
                                </select><br><br>

                                <input type="submit" name="Submit" value="Submit" class="button">
        <!--                        <input type= "button" type="submit" name="Submit" value="Submit" onclick="myFunction()" value="Submit">-->


                            </table>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </body>


</html>