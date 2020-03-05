<html>
    <head>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <link rel="stylesheet" href="styles.css">
<!--        <style>

            .hero-image {
                background-image:url("z_Accenture_background.jpg");
                height: 40%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
            }

            .hero-text {
                text-align: left;
                position: absolute;
                top: 50%;
                right: 40%;
                transform: translate(-50%, -50%);
                color: white;
            }


        </style>-->
    </head>
    <body>

<!--
        <div class="hero-image">
            <div class="hero-text">
                <h1 style="font-size:70px">IC Seat Management</h1>
                <p>Elevate Role</p>

            </div>
        </div>
    <body>
        <div class="navbar">


            <div style="float:right" class="dropdown">
                <button class="dropbtn">Settings 
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="RedirectRole.php?elevate=true">Elevate Role</a>
                    <a href="Logout.php">Logout</a>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="leftcolumn">
                <div class="card">-->

                    <?php
                    session_start();
                    /* Notes on status flows
                     * Status: For Approval (submitted by requestor) -> Approved/Rejected/Preapproved (approved by Execs) -> Confirmed/Cancelled(Requestor) -> Occupied/Cancelled (Requestor) -> Unoccupied (PoC)
                     * 
                     * include('MySQL.php');
                      $userid=$_SESSION['id'];

                      $userq=mysqli_query($mysqlconn,"select * from `login` where userid='$userid'");
                      $userrow=mysqli_fetch_array($userq); */
                    if (isSet($_POST['SelectProfile'])) {
                        // echo "you have selected this profile:=" . $_POST['SelectProfile'] . "<br>";
                        $_SESSION['current_profile'] = $_POST['SelectProfile'];
                    }


                    $profileOptions = "";
                    $optPhysician = "";
                    $optAdmin = "";


                    switch ($_SESSION['current_profile']) {
                        case "Physician":
                            $optPhysician = "selected";
                            $homepage = 'location:UserHomepage.php';
                            break;
                        
                        default: //default is Admin
                            $optAdmin = "selected";
                            $homepage = 'location:HomePageAdmin.php';
                            break;
                    }

                    if (!isSet($_REQUEST['elevate'])) {
                        header($homepage);
                    }



                    switch ($_SESSION['profile']) {
                        case "Physician":
                            $profileOptions = '<option value="Physician"' . $optPhyscian . '>Physicianh</option>';

                            break;
                      
                        default: //default is Admin
                            $profileOptions = '<option value="Physician"' . $optPhyscian . '>Physician</option>';
                                   
                            break;
                    }
                    ?>
                    <!doctype html>
<!--                   