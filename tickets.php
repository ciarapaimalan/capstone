<?php
include ('MySQL.php');
session_start();
$username = mysqli_real_escape_string($mysqlconn, $_SESSION['username']);
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}
?>
<?php
if (isSet($_POST['Export'])) {

    $sqlSelect = "SELECT * FROM tickets ";
    $result = mysqli_query($mysqlconn, $sqlSelect);

    $num_column = mysqli_num_fields($result);

    $csv_header = '';
    for ($i = 0; $i < $num_column; $i++) {
        $csv_header .= '"' . mysqli_fetch_field_direct($result, $i)->name . '",';
    }
    $csv_header .= "\n";

    $csv_row = '';
    while ($row = mysqli_fetch_row($result)) {
        for ($i = 0; $i < $num_column; $i++) {
            $csv_row .= '"' . $row[$i] . '",';
        }
        $csv_row .= "\n";
    }

    /* Download as CSV File */
    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename=UserAccnt.csv');
    echo $csv_header . $csv_row;
    exit;
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
        <link rel="icon" href="usthlogo.png">


        <!--        tabs-->
        <!-- Bootstrap -->
        <!--        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
                 Datatables 
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
                <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
                <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
                <script src="https://nightly.datatables.net/js/dataTables.bootstrap.js"></script>-->


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
                font-size:12px;
            }
            /*            span{
                            font-weight:bold;
                            font-size: 12pt;
                            padding:5px;
            
                        }*/
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
            .dashed {
                border-style: dashed;
                padding: 10px;

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
                        <h2>Manage tickets</h2>


                        <?php
                        if (isSet($_POST['submit'])) {
                            $question = $mysqlconn->real_escape_string($_POST['question']);
                            $message = $mysqlconn->real_escape_string($_POST['message']);
                            $severity = $mysqlconn->real_escape_string($_POST['severity']);
                            $username = $mysqlconn->real_escape_string($_POST['username']);
                            $date = $mysqlconn->real_escape_string($_POST['date']);
                            $adminmessage = $mysqlconn->real_escape_string($_POST['adminmessage']);
                            $adminusername = $mysqlconn->real_escape_string($_POST['adminusername']);
                            $dateupdated = $mysqlconn->real_escape_string($_POST['dateupdated']);


                            $ticketlist = $mysqlconn->real_escape_string($_POST['ticketlist']);
                            $sqlcmd = "update ticket set question  = '$question', message = '$message', severity='$severity', username='$username', date='$date',adminmessage='$adminmessage',adminmessage='$adminusername',dateupdated='$dateupdated'WHERE ticketlist = '$ticketlist'";
//                            $sql = "Update  ticket(question,message,severity,username,date,adminmessage,dateupdated) values('$question','$message','$severity','$username','$date','$adminmessage','$dateupdated' )";
                            if ($mysqlconn->query($sql) === true) {
                                ?>
                                <div class="alert alert-success">
                                    <strong>Success!</strong> This incident has been recorded. The administrator will notify you regarding this.
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Error!</strong> Please check your inputs.
                                </div>
                                <?php
                            }
                        }
                        if (isset($_POST['search'])) {
                            $valueToSearch = $_POST['valueToSearch'];
                            // search in all table columns
                            // using concat mysql function
                            $conn = "SELECT * FROM ticket WHERE status='Processing' AND date LIKE '%" . $valueToSearch . "%'
                                        OR username LIKE '%" . $valueToSearch . "%' 
                                        OR question LIKE '%" . $valueToSearch . "%' 
                                        OR severity LIKE '%" . $valueToSearch . "%' 
                                        OR status LIKE '%" . $valueToSearch . "%'
 
  ";
                            $search_result = filterTable($conn);
                        } else {
                            $conn = "SELECT * FROM ticket WHERE status='Processing'";
                            $search_result = filterTable($conn);
                        }

// function to connect and execute the query
                        function filterTable($conn) {
                            include('MySQL.php');
                            $filter_Result = mysqli_query($mysqlconn, $conn);
                            return $filter_Result;
                        }
                        ?>


                        <button type="submit" class="btn btn-default"  name="Export" value="Export" >
                            <span class="glyphicon glyphicon-export"></span> Export
                        </button>


                    </div>
                    <br>
                    <table id="example" class="table table-striped table-hover table-bordered" width="100%">

                        <form action="" method="post" name="frmUser" >
                            <input type="text" name="valueToSearch" placeholder="Value To Search">
                            <input type="submit" name="search" value="Filter"><br><br>

                            <table>
                                <tr>
                                    <th></th>
                                    <th>Date</th>
                                    <th>username</th>
                                    <th>Incident</th>
                                    <th>Severity</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Admin</th>
                                    <th>Message to User</th>
                                    <th>Date Updated</th>


                                </tr>
                                <?php $i = 0; ?>
                                <!-- populate table from mysql database -->
                                <?php while ($row = mysqli_fetch_array($search_result)): ?>
                                    <tr>
                                    <tr class="<?php if (isset($classname)) echo $classname; ?>">
                                        <td><input type="radio" name="tickelist" value="<?php echo $row['q_id']; ?>"></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['question']; ?></td>
                                        <td><?php echo $row['severity']; ?></td>
                                        <td><?php echo $row['message']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td><?php echo $row['adminusername']; ?></td>
                                        <td><?php echo $row['adminmessage']; ?></td>
                                        <td><?php echo $row['dateupdated']; ?></td>


                                    </tr>

                                <?php endwhile; ?>
                            </table>



                            <label for="status" >Status</label>
                            <select id="disposition" name="status" class="form-control"  value="<?php echo $row['status']; ?>"required>
                                <option value="Processing">Processing</option>
                                <option value="Resolved">Resolved</option>


                            </select>   

                            <div class="form-input">
                                <label for="adminmessage" class="required">Message to User</label>
                                <textarea class="form-control"  name="adminmessage" required></textarea>
                            </div>
                            <input type="hidden" name="adminusername" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">
                            <?php
                            date_default_timezone_set('Asia/Manila');
                            ?>

                            <input type="hidden" name="dateupdated" value="<?= date('Y-m-d'); ?>"> 


                            <input type="submit" name="submit" value="Submit" class="btn btn-success">


                            </td>
                            </tr>
                            <br>

                        </form>


                </div>

            </div>
        </div>



    </div>
</div>
</div>

</body>


</html>