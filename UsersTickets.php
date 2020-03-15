<?php
include ('MySQL.php');
session_start();
$username = mysqli_real_escape_string($mysqlconn, $_SESSION['username']);

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
        <link rel="stylesheet" href="./style3.css">

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="./table.css">

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
                            <li> 

                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['username']; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="UsersTickets.php">Tickets</a></li>
                                    <li><a href="UsersPatient.php">Patients</a></li>
                                    <li><a href="UsersSchedule.php">Schedules</a></li>
                                    <li><a href="UsersChangePW.php">Change Password</a></li>
                                </ul>
                            </li>

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

                            <h3 class="h6 mb-3"></h3>
                            <h2>Patients List</h2>

                                <br>
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

                                    <form method="POST" action="">
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
                                            ?> 
                                        <br>
                                        Select Action to Perform:
                                        <select name="SelectActions">
                                                <?php echo $profileActions ?>
                                        </select><br><br>
                                        <input type="submit" name="Submit" value="Submit" class="button">

                                            <?php
                                        } else {
                                            echo "No records found";
                                        }
                                        ?>

                                      

                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

