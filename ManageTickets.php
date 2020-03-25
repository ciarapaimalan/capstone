<?php
include ('MySQL.php');
session_start();
$username = mysqli_real_escape_string($mysqlconn, $_SESSION['username']);
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}
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
                width: 100%;
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
                        <a href="AdminHelpPage.php">
                            <i class="zmdi zmdi-help-outline"></i> Help
                        </a>
                    </li>
                    <li>
                        <a href="AdminAbout.php">
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
                                    <li><a href="ManageFAQs.php">FAQs</a></li>
                                </ul>
                            </li>

                            <li><a href="Logout.php">Log Out</a></li></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">

                    <div id="content" class="p-4 p-md-5 pt-5">
                        <h2>Manage Tickets</h2><br>

                        <?php
                        if (isset($_POST['SelectRow'])) {

                            switch ($_POST['SelectActions']) {
                                case "ACTION_CANCEL":
                                    $search_result = 'update ticket set status = "Cancelled" where ';
                                    updateList($search_result);
                                    break;
                                case "ACTION_PROCESSING":
                                    $search_result = 'update ticket set status = "Processing" where ';
                                    updateList($sql);
                                    break;
                                case "ACTION_RESOLVED":
                                    $search_result = 'update ticket set status = "Resolved" where ';
                                    updateList($search_result);
                                    break;
                            }
                        }

                        function updateList($search_result) {
                            include 'MySQL.php';

                            $criteria = "";
                            foreach ($_POST['SelectRow'] as $value) {
                                $criteria = $criteria . "id=" . $value . " or ";
                            }


                            $criteria = rtrim($criteria, " or ");

                            $criteria;

                            $search_result = $search_result . $criteria;


                            if ($mysqlconn->query($search_result) == true) {
                                ?>
                                <div class="alert alert-success">
                                    <strong>Success!</strong> Ticket has been Updated.
                                </div>
                                <?php
                            }
                        }
                        ?>        

                        <?php
                        if (isset($_POST['search'])) {
                            $valueToSearch = $_POST['valueToSearch'];
                            // search in all table columns
                            // using concat mysql function
                            $conn = "SELECT * FROM ticket WHERE CONCAT(question,message,severity,username,date,status) LIKE '%" . $valueToSearch . "%'";
                            $search_result = filterTable($conn);
                        } else {
                            $conn = "SELECT * FROM ticket ORDER BY date DESC LIMIT 20 ";
                            $search_result = filterTable($conn);
                        }

// function to connect and execute the query
                        function filterTable($conn) {
                            include('MySQL.php');
                            $filter_Result = mysqli_query($mysqlconn, $conn);
                            return $filter_Result;
                        }

//                        $sql = "SELECT * FROM ticket ORDER BY severity DESC";

                        $profileActions = '<option value="ACTION_PROCESSING">Processing</option>'
                                . '<option value="ACTION_RESOLVED">Resolved</option>';

//                        $result = mysqli_query($mysqlconn, $sql);
                        ?>
                        <table id="example" class="table table-striped table-hover table-bordered" width="100%">

                            <form action="" method="post" name="frmUser" >
                                <input type="text" name="valueToSearch" placeholder="Value To Search">
                                <input type="submit" name="search" value="Filter"><br><br>         
                                <?php
                                echo" <table>
                                            <tr>
                                                <th> </th>
                                                <th>Date</th>
                                                <th>username</th>
                                                <th>Incident</th>
                                                <th>Message</th>
                                                <th>Severity</th>
                                                <th>Status</th>

                                            </tr>";
                                while ($row = mysqli_fetch_array($search_result)) {
                                    echo "<tr>";
                                    echo "<td> <input type='checkbox' name='SelectRow[]' value=" . $row['id'] . ">";
                                    echo "<td>" . $row['date'] . "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['question'] . "</td>";
                                    echo "<td>" . $row['message'] . "</td>";
                                    echo "<td>" . $row['severity'] . "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    echo "</tr>";
                                }

                                echo "</table>";
                                ?>

                                <br><br>
                                Select Action to Perform: <select name="SelectActions">
                                    <?php echo $profileActions ?>
                                </select><br><br>
                                <div class="form-submit">

                                    <input type="submit" name="Submit" value="Submit" class="btn btn-success" id="submit">
                                </div>
                                <br>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </body>


</html>