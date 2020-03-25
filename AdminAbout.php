<?php
include ('MySQL.php');
session_start();
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header('location:index.php');
    exit();
}
?><!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>TRAST</title>
       <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
        <link rel="stylesheet" href="./style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

        <style>
            h2 {
                color: #b48608;
                font-family: 'Droid serif', serif;
                font-size: 36px;
                font-weight: 400;
                font-style: italic;
                line-height: 44px;
                margin: 0 0 12px;
                text-align: center;
            }

            /* p 
        { color: #000;
         font-family: 'Droid Sans', sans-serif; 
         font-size: 20px; font-weight: 400; 
         line-height: 24px; 
         margin: 0 0 14px; 
        } */
            p {
                color: #000;
                font-family: 'Verdana', sans-serif;
                font-size: 16px;
                line-height: 26px;
                text-indent: 30px;
                margin-left: 40px;
                margin-right: 40px;
                text-align: justify; 
                background-attachment: fixed;

            }
            body {
                background-image: url('lines.jpg');
                width: auto;
                height: 100%;
                min-height: 100%;
                background-size: 2000px;
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
                        <a href="AdminHelpPage.php">
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
                                    <li><a href="ManagePatientInfo.php">Patients' Chart</a></li>
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
                        <div class="mb-5">
                            <br>
                            <h2>About Us</h2>
                                <br>
                                <p align="justify">

                                    The website application aims to help in efficiently aiding the
                                    physician in assessing a patient's condition and complications while implementing the ITIL
                                    principles such as Incident Management and Event and Monitoring Management.
                                    The capstone project will help in creating a website that calculates the risk of a
                                    patient incurring pulmonary embolism and recommend the necessary prophylactic regimen.
                                    <br><br>
                                    The Thrombosis Risk Assessment for Medical and Surgical Patients (TRAMSP) form is used
                                    as a criteria to assess the risk of a patient.
                                    Patient care information was added in the capstone project to make sure that all the
                                    information related to the patient and the pattern in their lifestyle is available while
                                    assessing risks.
                                    The system's purpose is not only to assess patients for pulmonary embolism but to also
                                    recommend to the physician the prophylactic regimen that will aid in making their quality of
                                    life better.
                                    Adding the patient care information, admission history, risk assessment results in the
                                    system will help with the process improvement of the USTH-CRM.
                                    <br><br><br>
                                </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- partial -->

    </body>

</html>