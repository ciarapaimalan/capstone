<html>
    <head>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <link rel="stylesheet" href="styles.css">

    </head>
    <body>


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
                $homepage = 'location:AdminHomepage.php';
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