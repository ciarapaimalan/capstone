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

    $sqlSelect = "SELECT * FROM Patient";
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
    header('Content-Disposition: attachment; filename=PatientList.csv');
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
                        <h2>Manage Patients' Information</h2>
                        <?php
                        include('MySQL.php');
                        $message = '';
//problem: uploads even when eid column are empty 
                        if (isset($_POST["upload"])) {
                            if ($_FILES['patient']['name']) {
                                $filename = explode(".", $_FILES['patient']['name']);
                                if (end($filename) == "csv") {
                                    $handle = fopen($_FILES['patient']['tmp_name'], "r");
                                    fgetcsv($handle, 10000, ",");
                                    while (($column = fgetcsv($handle, 10000, ",")) !== FALSE) {
                                        $sqlcmd = "INSERT into Patient(patient_fname,patient_mname,patient_lname,birthdate,sex,address,contactno) VALUES ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "')";

                                        $result = mysqli_query($mysqlconn, $sqlcmd);

                                        if (!empty($result)) {
                                            $type = "success";
                                            $message = ' <div class="alert alert-success"><strong>Success!</strong> CSV Data Imported into the Database</div>';
                                        } else {
                                            $type = "error";
                                            $message = '<div class="alert alert-danger"><strong>Error!</strong> Problem in Importing CSV Data</div>';
                                        }
                                    }
                                    fclose($handle);
// header("location: UpdateTable.php?updation=1");
                                } else {
                                    $message = '<div class="alert alert-danger"><strong>Error!</strong> Please select CSV File only</label></div>';
                                }
                            } else {
                                $message = '<div class="alert alert-danger"><strong>Error!</strong> Please Select File</div>';
                            }
                        }
                        $sqlcmd = "SELECT * FROM Patient";
                        $result = mysqli_query($mysqlconn, $sqlcmd);
                        ?>

                        <?php
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
                                    if (isset($_POST['patientlist'])) {
                                        $patientlist = $mysqlconn->real_escape_string($_POST['patientlist']);
                                        $sqlcmd = "update Patient set patient_fname = '$patient_fname', patient_mname = '$patient_mname', patient_lname='$patient_lname', birthdate='$birthdate', sex='$sex', address='$address', contactno='$contactno'where patient_fname = '$patientlist'";
                                    } else {
                                        ?>
                                        <div class="alert alert-danger">
                                            <strong>Error!</strong> Please select a record to update.
                                        </div>
                                        <?php
                                    }
                                    break;
                                case "ACTION_DELETE":
                                    if (isset($_POST['patientlist'])) {
                                        $patientlist = $mysqlconn->real_escape_string($_POST['patientlist']);
                                        $sqlcmd = "delete from Patient where patient_fname = '$patientlist'";
                                    } else {
                                        ?>
                                        <div class="alert alert-danger">
                                            <strong>Error!</strong> Please select a record to delete.
                                        </div>
                                        <?php
                                    }
                                    break;
                            }

                            if ($mysqlconn->query($sqlcmd) === true) {
                                ?>
                                <div class="alert alert-success">
                                    <strong>Success!</strong> Patient table has been updated.
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
                            $conn = "SELECT * FROM Patient WHERE CONCAT(patient_fname,patient_mname,patient_lname,birthdate,sex,address,contactno) LIKE '%" . $valueToSearch . "%'";
                            $search_result = filterTable($conn);
                        } else {
                            $conn = "SELECT * FROM Patient ";
                            $search_result = filterTable($conn);
                        }

// function to connect and execute the query
                        function filterTable($conn) {
                            include('MySQL.php');
                            $filter_Result = mysqli_query($mysqlconn, $conn);
                            return $filter_Result;
                        }
                        ?>
                        <?php echo $message; ?>

                        <form class="form-horizontal" action="" method="post"   enctype="multipart/form-data">    

                            <button type="submit" class="btn btn-default"  name="Export" value="Export"style="margin-right: 0;margin-left:auto;display:block;" >
                                <span class="glyphicon glyphicon-export"></span> Export
                            </button>

                            <div class="dashed">

                                <label>Import CSV file of Users' Table</label>
                                <input type="file" name="patient"/> <br>

                                <button type="submit" class="btn btn-default" name="upload"  value="Upload" >
                                    <span class="glyphicon glyphicon-import"></span> Import
                                </button>

                        </form>
                    </div>
                    <form action="" method="post" name="frmUser" >
                        <input type="text" name="valueToSearch" placeholder="Value To Search" > 
                        <input type="submit" name="search" value="Filter"><br><br>

                        <table>
                            <tr>
                                <th></th>
                                <th>Patient ID</th>
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
                                    <td><?php echo $row['ph_id']; ?></td>
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
                                <td> Add Patient:</td>   
                                <td></td>         
                                <td><input type="textbox"  name="patient_fname" class="patient_fname" > </td>
                                <td><input type="textbox"  name="patient_mname" class="patient_mname"> </td>
                                <td><input type="textbox"  name="patient_lname" class="patient_lname"> </td>

                                <td><input type="date"  name="birthdate" class="birthdate" > </td>
                                <td> <select name="sex"required >
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select> </td>           
                                <td><input type="textbox"  name="address" class="address"> </td>
                                <td><input type="textbox"  name="contactno" class="contactno"> </td>

                            </tr> 
                            <tr class="listheader">
                            <tr class="listheader">
                                <td colspan="9">
                                    Mode: <select name="SelectActions">
                                        <option value="ACTION_CREATE">Create</option>
                                        <option value="ACTION_UPDATE">Update</option>
                                        <option value="ACTION_DELETE">Delete</option>

                                    </select>
                                    <input type="submit" name="submit" value="Submit"  class="btn btn-success">


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