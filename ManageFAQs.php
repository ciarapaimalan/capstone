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
        <link rel="icon" href="usthlogo.png">

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
                                    <li><a href="ManagePatientInfo.php">Patients' Chart</a></li>
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
                        <h2>Manage FAQs</h2><br>
                        <?php
                        if (isSet($_POST['submit'])) {
                            $question = $mysqlconn->real_escape_string($_POST['question']);
                            $answer = $mysqlconn->real_escape_string($_POST['answer']);
                            $severity = $mysqlconn->real_escape_string($_POST['severity']);
                            $role = $mysqlconn->real_escape_string($_POST['role']);

                            switch ($_POST['SelectActions']) {
                                case "ACTION_CREATE":
                                    $sqlcmd = "insert into FAQs(question,answer,severity,role) values('$question','$answer','$severity','$role')";
                                    break;
                                case "ACTION_UPDATE":
                                    $faqslist = $mysqlconn->real_escape_string($_POST['faqslist']);
                                    $sqlcmd = "update FAQs set question = '$question', answer='$answer', severity='$severity', role='$role' where question = '$faqslist'";

                                    break;
                                case "ACTION_DELETE":
                                    $faqslist = $mysqlconn->real_escape_string($_POST['faqslist']);
                                    $sqlcmd = "delete from FAQs where question = '$faqslist'";
                                    break;
                            }


                            if ($mysqlconn->query($sqlcmd) === true) {
                                ?>
                                <div class="alert alert-success">
                                    <strong>Success!</strong> FAQs table has been updated.
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
                            $conn = "SELECT * FROM FAQs WHERE CONCAT(question,answer,severity,role) LIKE '%" . $valueToSearch . "%'";
                            $search_result = filterTable($conn);
                        } else {
                            $conn = "SELECT * FROM FAQs";
                            $search_result = filterTable($conn);
                        }

// function to connect and execute the query
                        function filterTable($conn) {
                            include('MySQL.php');
                            $filter_Result = mysqli_query($mysqlconn, $conn);
                            return $filter_Result;
                        }
                        ?>
                        <form class="form-horizontal" action="" method="post"   enctype="multipart/form-data">    

                            <button type="submit" class="btn btn-default"  name="Export" value="Export" >
                                <span class="glyphicon glyphicon-export"></span> Export
                            </button>
                        </form>

                        <form action="" method="post" name="frmUser" >
                            <input type="text" name="valueToSearch" placeholder="Value To Search">
                            <input type="submit" name="search" value="Filter"><br><br>

                            <table>
                                <tr>
                                    <th></th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Severity</th>
                                    <th>Role</th>

                                </tr>
                                <?php $i = 0; ?>
                                <!-- populate table from mysql database -->
                                <?php while ($row = mysqli_fetch_array($search_result)): ?>
                                    <tr>
                                    <tr class="<?php if (isset($classname)) echo $classname; ?>">
                                        <td><input type="radio" name="faqslist" value="<?php echo $row['question']; ?>"></td>
                                        <td><?php echo $row['question']; ?></td>
                                        <td><?php echo $row['answer']; ?></td>
                                        <td><?php echo $row['severity']; ?></td>
                                        <td><?php echo $row['role']; ?></td>
                                    </tr>

                                <?php endwhile; ?>
                                <tr>
                                    <td> Add FAQ:</td>
                                    <td><input type="textbox"  name="question" class="question" required> </td>
                                    <td><input type="textbox"  name="answer" class="answer"required> </td>
                                    <td><input type="number"  name="severity" class="severity" min="1" max="5"required> </td>

                                    <td> <select name="role" required>
                                            <option value="Physician">Physician</option>
                                            <option value="Admin">Admin</option>
                                        </select> </td>

                                </tr> 
                                <tr class="listheader">
                                <tr class="listheader">
                                    <td colspan="5">
                                        Mode: <select name="SelectActions">
                                            <option value="ACTION_CREATE">Create</option>
                                            <option value="ACTION_UPDATE">Update</option>
                                            <option value="ACTION_DELETE">Delete</option>

                                        </select>
                                        <input type="submit" name="submit" value="Submit" class="btn btn-success">


                                    </td>
                                </tr>
                            </table>
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
