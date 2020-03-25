<?php
/*

  NEW.PHP

  Allows user to create a new entry in the database

 */

// creates the new record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($disposition, $discharge_date, $error) {
    ?>
    <html>

        <head>

            <title>New Record</title>

        </head>

        <body>

            <?php
// if there are any errors, display them

            if ($error != '') {

                echo '<div style="padding:4px; border:1px solid red; color:red;">' . $error . '</div>';
            }
            ?>



            <form action="" method="post">

                <div>

                    <strong>Disposition: *</strong> <input type="text" name="disposition" value="<?php echo $disposition; ?>" /><br/>

                    <strong>Discharge Date: *</strong> <input type="text" name="discharge_Date" value="<?php echo $discharge_date; ?>" /><br/>

                    <p>* required</p>

                    <input type="submit" name="submit" value="Submit">

                </div>

            </form>

        </body>

    </html>

    <?php
}

// connect to the database

include ('MySQL.php');

// check if the form has been submitted. If it has, start to process the form and save it to the database

if (isset($_POST['submit'])) {

// get form data, making sure it is valid

    $disposition = mysql_real_escape_string(htmlspecialchars($_POST['disposition']));

    $discharge_date = mysql_real_escape_string(htmlspecialchars($_POST['discharge_date']));



// check to make sure both fields are entered

    if ($disposition == '' || $discharge_date == '') {

// generate error message

        $error = 'ERROR: Please fill in all required fields!';



// if either field is blank, display the form again

        renderForm($disposition, $discharge_date, $error);
    } else {

// save the data to the database

        mysql_query("INSERT PatientInfo SET disposition='$disposition', discharge_date='$discharge_date'")

                or die(mysql_error());



// once saved, redirect back to the view page

        header("Location: patientinfo.php");
    }
} else {

// if the form hasn't been submitted, display the form

    renderForm('', '', '');
}
?>