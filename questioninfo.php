

<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>TRAST</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
        <link rel="stylesheet" href="./style3.css">

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
                        <img src="USTransp.png" style="width:70%;"> 
                        <br>

                        TRAST
                    </a>

                </header>
                <ul class="nav">
                    <br>
                    <li>
                        <a href="index.html">
                            <i class="zmdi zmdi-search"></i> Search Patient
                        </a>
                    </li>
                    <li>
                        <a href="NewPatient.html">
                            <i class="zmdi zmdi-accounts-add"></i> New Patient
                        </a>
                    </li>
                    <li>
                        <a href="#">
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
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                              <!-- <a href="#"><i class="zmdi zmdi-notifications text-danger"></i>
                              </a> -->
                            </li>
                            <li><a href="LandingPage.html">Log Out</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">


                    <div id="content" class="p-4 p-md-5 pt-5">
                        <h2 class="mb-4">TRAST: Thrombosis Risk Assessment System</h2>

                        <p>	     
                        <div class="mb-5">
                            <?php
                            session_start();
                            include 'MySQL.php';

// Check connection
                            if ($mysqlconn === false) {
                                die("ERROR: Could not connect. " . $mysqlconn->connect_error);
                            }

                            if (isSet($_POST['submit'])) {
                                $id = $mysqlconn->real_escape_string($_POST['q_id']);
                                $question = $mysqlconn->real_escape_string($_POST['question']);
                                $message = $mysqlconn->real_escape_string($_POST['message']);
                                $severity = $mysqlconn->real_escape_string($_POST['severity']);
                                $username = $mysqlconn->real_escape_string($_POST['username']);

                                $sql = "Insert into ticket(q_id,question,message,severity,username,date) values('$id','$question','$message','$severity','$username',NOW() )";

                                if ($mysqlconn->query($sql) === true) {
                                    $msg = "This incident has been recorded. The administrator will notify you regarding this";
                                } else {
                                    $msg = "Could not able to execute $sql. " . $mysqlconn->error;
                                }

                                echo $msg;
                            }
                            ?>
                            <?php
                            $id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

                            $sql = "SELECT * FROM FAQs WHERE q_id='$id'";
                            $result = mysqli_query($mysqlconn, $sql);
                            ?>
                            <table>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    ?> 
                                    <h1><?php echo $row['question']; ?></h1><br><br>
                                    <?php echo $row['answer']; ?><br>


                                    <?php
                                }
                                ?>
                            </table>    
                            <br>
                            <br>
                            Need more assistance?<br>

                            <form action=""method="post">

                                <?php
                                $sql = mysqli_query($mysqlconn, "SELECT question FROM FAQs WHERE q_id='$id'");
                                while ($row = mysqli_fetch_array($sql)) {
                                    echo'<tr><td><input  type="hidden" value="' . $row["question"] . '"  id ="question" name="question" ></td></tr>';
                                }
                                ?>
                                <br>
                                <?php
                                $sql = mysqli_query($mysqlconn, "SELECT severity FROM FAQs WHERE q_id='$id'");
                                while ($row = mysqli_fetch_array($sql)) {
                                    echo'<tr><td><input  type="hidden" value="' . $row["severity"] . '"  id ="severity" name="severity" ></td></tr>';
                                }
                                ?>

                                <br>

                                <input type="hidden" name="username" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">

                                <input type="checkbox" name ="q_id" id="q_id" value="" onclick="ShowHideDiv()"> Let us know about this incident<br><br>
                                <div id="dvtext" style="display: none">

                                    Tell us more about this concern:<br>

                                    <textarea name="message" id="message" rows="10" cols="30"> </textarea>
                                    <br>

                                    <input type="submit" name="submit">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <script>
        var val = "<?php echo $id ?>";

        document.getElementById("q_id").setAttribute("value", val);
        //call date
        function ShowHideDiv() {
            var q_id = document.getElementById("q_id");
            var dvtext = document.getElementById("dvtext");
            dvtext.style.display = q_id.checked ? "block" : "none";
        }
    </script>
</html>
