<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css"
              href="LogInStartCSS/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css"
              href="LogInStartCSS/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="BootstrapLandingPageTrial.css" />
        <link rel="icon" href="usthlogo.png">





        <link rel="stylesheet" type="text/css" href="style6.css" />
        <title>UST-CRM Log In</title>
    </head>
    <style>
        label{
            color: #ff3333;

        }
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
        <br><br><br><br><br>
    <center>
        <img src="logosfinal.png" alt="lib&ust_logo" style="width: 15%">
    </center>
    <h1 class="CRM">Center for Respiratory Medicine</h1>
    <p class="TRAST">TRAST: Thrombosis Risk Assessment System</p>
    <br>
    <p class="desc"> A platform for the physicians of the UST-CRM in providing the <br>
        best care possible in preventing patients’ having a pulmonary embolism.</p>
    <br>
    <center>
        <img src="process.png" alt="process" style="width: 40%">
        <br>
        <label>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>
        </label>
    </center>

    <br>
    <center>

        <button class="button" id="myBtn">LOGIN</button>
    </center>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="container-fluid">

            <div class="row main-content bg-success text-center">
                <div class="col-md-4 text-center company__info">
                    <img src="USTransp.png" height="50%" width="100%">


                    <br>
                </div>
                <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                    <div class="container-fluid">
                        <span class="close">&times;</span>

                        <div class="row">
                            <h2>Login</h2>
                        </div>
                        <div class="row">
                            <form method="POST" action="Auth.php">
                                <div class="row">
                                    <input type="text" name="username" id="username" name="username"
                                           class="form__input" placeholder="Username" required>
                                </div>
                                <div class="row">
                                        <!-- <span class="fa fa-lock"></span> -->
                                    <input type="password" name="password" id="password" name="password"
                                           class="form__input" placeholder="Password" required>
                                </div>
                                <div class="row">

                                </div>
                                <div class="row">
                                    <input type="submit" value="LOG IN" class="btn">
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <p>

                            </p>
                            <span class="psw"><a href="ForgotPassword.php">Forgot
                                    password?</a></span> <br> <br> <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="container-fluid text-center footer"></div>
</div>
</body>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</html>