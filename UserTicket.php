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
        echo "<center><h1>Success!</h1> <br></center>";
        echo "<center><h4>Status Updated</h4><br></center> ";
    }

    $mysqlconn->close();
}
?>







<html>
    <head>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            table, td, th {
                border: 1px solid black;
                padding: 5px;
            }

            th {text-align: left;}
        </style>  
    </head>
    <body>

        <div class="row">
            <div class="leftcolumn">
                <?php
                session_start();
                include 'MySQL.php';
                
                $username = mysqli_real_escape_string($mysqlconn, $_SESSION['username']);

                $sql = "SELECT * FROM ticket where username='$username'";

                $profileActions = '<option value="ACTION_PROCESSING">Processing</option>'
                        . '<option value="ACTION_RESOLVED">Resolved</option>';

                $result = mysqli_query($mysqlconn, $sql);
                ?>
                <form method="POST" action="UserTicket.php">
                    <table>
                        <tr>
                            <td> </td>
                            <td>Date</td>
                            <td>Incident</td>
                            <td>Message</td>
                            <td>Severity</td>
                            <td>Status</td>

                        </tr>
                        <tr>
                            <?php
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

                            mysqli_close($mysqlconn);
                            ?>

                        <br><br>
                        Select Action to Perform: <select name="SelectActions">
                            <?php echo $profileActions ?>
                        </select><br><br>

                        <input type="submit" name="Submit" value="Submit" class="button">
<!--                        <input type= "button" type="submit" name="Submit" value="Submit" onclick="myFunction()" value="Submit">-->
                        <br><br>

                        <input type="button" onclick="goBack()" class="back" value="Back">

                        <script>
                            function goBack() {
                                window.history.back();
                            }
                        </script> 

                    </table>


                </form>
                </body>

                </html>