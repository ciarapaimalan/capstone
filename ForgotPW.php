<?php
include ('MySQL.php');
?>


<html>
    <head></head>
    <body>
        <form method="POST" action="">hello
            <?php
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
            $sql = mysqli_query($mysqlconn, "SELECT question FROM FAQs WHERE q_id='33'");
            while ($row = mysqli_fetch_array($sql)) {
                echo'<tr><td><input  type="hidden" value="' . $row["question"] . '"  id ="question" name="question" ></td></tr>';
            }
            ?>
            <br>
            <?php
            $sql = mysqli_query($mysqlconn, "SELECT severity FROM FAQs WHERE q_id='33'");
            while ($row = mysqli_fetch_array($sql)) {
                echo'<tr><td><input  type="hidden" value="' . $row["severity"] . '"  id ="severity" name="severity" ></td></tr>';
            }
            ?>

            <br>

            Username: <input type="text" name="username" value=""required><br>

            <input type="hidden" name ="q_id" id="q_id" value="33" >


            Note:<br> <textarea name="message" id="message" rows="10" cols="30"> </textarea>
            <br>

            <input type="submit" name="submit">

        </form>
    </body>
</html>