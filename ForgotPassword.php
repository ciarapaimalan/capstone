<?php
include ('MySQL.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css"
              href="LogInStartCSS/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css"
              href="LogInStartCSS/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="BootstrapLandingPageTrial.css" />


        <link rel="stylesheet" type="text/css" href="style6.css" />
        <title>UST-CRM Log In</title>
    </head>
    <style>
        .main-content {
            width: 50%;
            background-color: #ffff99;
            border-radius: 20px;
            box-shadow: 0 5px 5px rgba(0, 0, 0, .4);
            margin: 5em auto;
            display: flex;
        }

        .company__info {
            background-color: #ffcc00;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #000000;
        }

        .fa-android {
            font-size: 3em;
        }

        @media screen and (max-width: 640px) {
            .main-content {
                width: 90%;
            }
            .company__info {
                display: none;
            }
            .login_form {
                border-top-left-radius: 20px;
                border-bottom-left-radius: 20px;
            }
        }

        @media screen and (min-width: 642px) and (max-width:800px) {
            .main-content {
                width: 70%;
            }
        }

        .row>h2 {
            color: #000000;
        }

        .login_form {
            background-color: #f2f2f2;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            /* border-top:1px solid #ccc; */
            border-right: 1px solid #ccc;
        }

        form {
            padding: 0 2em;
        }

        .form__input {
            width: 100%;
            border: 0px solid transparent;
            border-radius: 0;
            border-bottom: 1px solid #aaa;
            padding: 1em .5em .5em;
            padding-left: 2em;
            outline: none;
            margin: 1.5em auto;
            transition: all .5s ease;
        }

        .form__input:focus {
            /* border-bottom-color: #000000; */
            box-shadow: 0 0 5px #000000;
            border-radius: 4px;
        }

        .btn {
            transition: all .5s ease;
            width: 70%;
            border-radius: 30px;
            color: #000000;
            font-weight: 600;
            background-color: #fff;
            border: 1px solid #000000;
            margin-top: 1.5em;
            margin-bottom: 1em;
        }

        .btn:hover, .btn:focus {
            background-color: #000000;
            color: #fff;
        }

        .TRAST {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 30px;
            text-align: center;
            /*text-shadow: 1px 1px #ffcc00;*/
        }

        .CRM {
            font-family: Arial, Helvetica, sans-serif;
            color: #666666;
            font-size: 20px;
            text-align: center;
            /* text-shadow: 1px 1px #000000; */
        }

        .desc {
            font-family: Arial, Helvetica, sans-serif;
            color: #262626;
            font-size: 15px;
            text-align: center;
            font-style: italic;
            /* text-shadow: 1px 1px #000000; */
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 90px; /*Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .space {
            margin-top: 200px;
            align-self: center;
        }

        body {
            /* The image used */
            /*background-image: url("StartBG.png");*/
            background-image: url("CRM copy.jpg");
            /* Full height */
            height: 10%;
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .button {
            background-color: #D5D3D5;
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 30px;
        }
        .button:hover, .button:focus {
            background-color: #404040;
            color: white;
        }
    </style>
    <body>
        <br><br><br><br>



        <div class="row main-content bg-success text-center">
            <div class="col-md-4 text-center company__info">
                <img src="USTransp.png" height="50%" width="100%">


                <br>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">

                    <div class="row">
                        <h2>Forgot Password</h2>
                    </div>
                    <form method="POST" action="">
                        <br>
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
                        <input type="hidden" name ="q_id" id="q_id" value="33" >

                        <br>
                        <div class="row">

                            <input type="text" name="username" value=""  class="form__input" placeholder="username" required ><br>
                        </div>
                        <div class="row">
                            <textarea rows="3" cols="5" placeholder="Note" name="message"  class="form__input"required></textarea><br>
                        </div>
                        <input type="submit" name="submit">

                        <div class="row">
                            <p>

                            </p>
                            <span class="psw"><a href="index.php">Go back to Login
                                </a></span> <br> <br> <br>
                        </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="container-fluid text-center footer"></div>
    </div>
</body>

</html>
