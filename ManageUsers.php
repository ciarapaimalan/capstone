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
                        <h2>Manage Users</h2>
                        <br>

                        <?php
                        if (isSet($_POST['submit'])) {
                            $username = $mysqlconn->real_escape_string($_POST['username']);
                            $password = $mysqlconn->real_escape_string($_POST['password']);
                            $password = md5($password);

                            $fullname = $mysqlconn->real_escape_string($_POST['fullname']);
                            $role = $mysqlconn->real_escape_string($_POST['role']);

                            switch ($_POST['SelectActions']) {
                                case "ACTION_CREATE":
                                    $sqlcmd = "insert into UserAccnt(username,password, fullname,role) values('$username', '$password','$fullname','$role')";
                                    break;
                                case "ACTION_UPDATE":
                                    $userlist = $mysqlconn->real_escape_string($_POST['userlist']);
//            $sqlcmd = "update users set FullName = '$fullname', Profile = '$profile', password = '$password', eid='$eid' where eid = '$eidlist'";
                                    $sqlcmd = "update UserAccnt set username = '$username', password = '$password', fullname='$fullname', role='$role'where username = '$userlist'";

                                    break;
                                case "ACTION_DELETE":
                                    $userlist = $mysqlconn->real_escape_string($_POST['userlist']);
                                    $sqlcmd = "delete from UserAccnt where username = '$userlist'";
                                    break;
                            }

                            if ($mysqlconn->query($sqlcmd) === true) {
                                echo 'User table successfully updated<br>';
                                $_POST['submit'] = '';
                            } else {
                                echo "ERROR: Could not able to execute $sqlcmd. " . $mysqlconn->error;
                            }
                        }
                        if (isset($_POST['search'])) {
                            $valueToSearch = $_POST['valueToSearch'];
                            // search in all table columns
                            // using concat mysql function
                            $conn = "SELECT * FROM UserAccnt WHERE CONCAT(username,password,fullname,role) LIKE '%" . $valueToSearch . "%'";
                            $search_result = filterTable($conn);
                        } else {
                            $conn = "SELECT * FROM UserAccnt";
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
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Fullname</th>
                                    <th>Role</th>
                                </tr>
                                <?php $i = 0; ?>
                                <!-- populate table from mysql database -->
                                <?php while ($row = mysqli_fetch_array($search_result)): ?>
                                    <tr>
                                    <tr class="<?php if (isset($classname)) echo $classname; ?>">
                                        <td><input type="radio" name="userlist" value="<?php echo $row['username']; ?>"></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['password']; ?></td>
                                        <td><?php echo $row['fullname']; ?></td>
                                        <td><?php echo $row['role']; ?></td>


                                    </tr>

                                <?php endwhile; ?>
                                <tr>
                                    <td> Add User:</td>
                                    <td><input type="textbox"  name="username" class="username" > </td>
                                    <td><input type="textbox"  name="password" class="password"> </td>
                                    <td><input type="textbox"  name="fullname" class="fullname"> </td>

                                    <td> <select name="role" >
                                            <option value="Physician">Physician</option>
                                            <option value="Admin">Admin</option>
                                        </select> </td>

                                </tr> 
                                <tr class="listheader">
                                <tr class="listheader">
                                    <td colspan="6">
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