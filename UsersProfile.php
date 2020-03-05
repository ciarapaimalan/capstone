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
                        <br>
                        <h1>Hi, <i> <?php echo $_SESSION['username']; ?>!</i></h1>
                        <br>
                        <br>
                        <div class="container">

                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a  href="#1" data-toggle="tab">Tickets</a>
                                </li>
                                <li><a href="#2" data-toggle="tab">Patients</a>
                                </li>
                            </ul>

                            <div class="tab-content ">
                                <!----------TAB 1-------->

                                <div class="tab-pane active" id="1">

                                    <?php
                                    if (isset($_POST['SelectRow'])) {

                                        switch ($_POST['SelectActions']) {
                                            case "ACTION_CANCEL":
                                                $sql = 'update ticket set status = "Cancelled" where ';
                                                updateList($sql);
                                                break;
                                            case "ACTION_PROCESSING":
                                                $sql = 'update ticket set status = "Processing" where ';
                                                updateList($sql);
                                                break;
                                            case "ACTION_RESOLVED":
                                                $sql = 'update ticket set status = "Resolved" where ';
                                                updateList($sql);
                                                break;
                                        }
                                    }

                                    function updateList($sql) {
                                        include 'MySQL.php';

                                        $criteria = "";
                                        foreach ($_POST['SelectRow'] as $value) {
                                            $criteria = $criteria . "id=" . $value . " or ";
                                        }


                                        $criteria = rtrim($criteria, " or ");

                                        $criteria;

                                        $sql = $sql . $criteria;

                                        if ($mysqlconn->query($sql) == true) {
                                            echo "<br><b>Ticket Updated</b>";
                                        }

                                        $mysqlconn->close();
                                    }
                                    ?>                                   
                                    <?php
                                    $sql = "SELECT * FROM ticket where username='$username' ORDER BY severity DESC";

                                    $profileActions = '<option value="ACTION_PROCESSING">Process</option>'
                                            . '<option value="ACTION_CANCEL">Cancel</option>';

                                    $result = mysqli_query($mysqlconn, $sql);
                                    ?>
                                    <table id="example" class="table table-striped table-hover table-bordered" width="100%">

                                        <form method="POST" action="UsersProfile.php">
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                echo" <table>
                                            <tr>
                                                <th> </th>
                                                <th>Date</th>
                                                <th>Incident</th>
                                                <th>Message</th>
                                                <th>Severity</th>
                                                <th>Status</th>

                                            </tr>";
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<tr>";
                                                    echo "<td> <input type='checkbox' name='SelectRow[]' value=" . $row['id'] . ">";
                                                    echo "<td>" . $row['date'] . "</td>";
                                                    echo "<td>" . $row['question'] . "</td>";
                                                    echo "<td>" . $row['message'] . "</td>";
                                                    echo "<td>" . $row['severity'] . "</td>";
                                                    echo "<td>" . $row['status'] . "</td>";
                                                    echo "</tr>";
                                                }

                                                echo "</table>";
                                            } else {
                                                echo "No records found";
                                            }
                                            ?>

                                            <br><br>
                                            Select Action to Perform: <select name="SelectActions">
                                                <?php echo $profileActions ?>
                                            </select><br><br>

                                            <input type="submit" name="Submit" value="Submit" class="button">
                                        </form>
                                    </table>


                                    </table>
                                </div>

                                <!----------TAB 2-------->
                                <div class="tab-pane" id="2">

                                    <table id="example" class="table table-striped table-hover table-bordered" width="100%">
                                        <?php
                                        $sqlinfo = "SELECT * FROM PatientInfo WHERE username='$username'";

                                        $resultinfo = mysqli_query($mysqlconn, $sqlinfo);

                                        if (mysqli_num_rows($resultinfo) > 0) {
                                            echo" <center> <table>
                                            <tr>
                                                <th>Pulmonary Diagnosis</th>
                                                <th>Other Diagnosis</th>
                                                <th>Oxygen Level</th>
                                                <th>Special Endorsement</th>
                                                <th>Physician</th>
                                                <th>Status</th>
                                                <th>Ward</th>
                                                <th>Bed No.</th>
                                                <th>Admission No.</th>
                                                <th>Hospital No.</th>
                                                <th>Admission Date</th>
                                                <th>Disposition</th>
                                                <th>Discharge Date</th>
                                                <th></th>
                                                <th></th>

                                            </tr></center>";

                                            while ($row = mysqli_fetch_array($resultinfo)) {
                                                echo '<a href="PatientInfoForm.php?id=' . $row['ph_id'] . '">Add New Record</a>';

                                                echo "<td>" . $row['pulmonary_diagnosis'] . "</td>";
                                                echo "<td>" . $row['other_diagnosis'] . "</td>";
                                                echo "<td>" . $row['oxygen_lvl'] . "</td>";
                                                echo "<td>" . $row['special_endorsement'] . "</td>";
                                                echo "<td>" . $row['username'] . "</td>";
                                                echo "<td>" . $row['status'] . "</td>";
                                                echo "<td>" . $row['ward'] . "</td>";
                                                echo "<td>" . $row['bed_no'] . "</td>";
                                                echo "<td>" . $row['admission_no'] . "</td>";
                                                echo "<td>" . $row['hosp_no'] . "</td>";
                                                echo "<td>" . $row['admission_date'] . "</td>";
                                                echo "<td>" . $row['disposition'] . "</td>";
                                                echo "<td>" . $row['discharge_date'] . "</td>";
                                                echo '<td><a href="edit.php?id=' . $row['info_id'] . '">Edit</a></td>';
                                                echo '<td><a href="delete.php?id=' . $row['info_id'] . '">Delete</a></td>';
                                                echo "</tr>";
                                            }
                                            echo "</table>";
                                        } else {
                                            echo "No records found";
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

    </body>


</html>