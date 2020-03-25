<?php
session_start();
include ('MySQL.php');

$id = mysqli_real_escape_string($mysqlconn, $_GET['id']);

$sql = "SELECT * FROM RiskAssessment WHERE ph_id='$id'";
$result = mysqli_query($mysqlconn, $sql);
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">


        <title>TRAST</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet'
              href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
        <link rel="stylesheet" href="./style3.css">    </head>
</head>

<body>
  <!-- partial:index.partial.html -->
  <div id="viewport">
    <!-- Sidebar -->
    <div id="sidebar">
      <br>
      <br>
      <header>
        <a id="header">
          <br>
          <img src="usthlogo.png" style="width:70%;">
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
    </div>
    
    <div class="container">
      <table class="table table-RA" style="float: inherit;">
            <form action="ResultsPage.php"method="post">

                    <input type="hidden" name ="ph_id" id="ph_id" value="" >


                    <h1>STEP 1: Check Risk Factors associated with Clinical Setting </h1>
                    <h2>(Baseline Risk Factor Score)</h2>      
                    <thead>
                        <tr>                  
                            <th scope="col">Score 1 factor</th>
                            <th scope="col">Score 2 factor</th>
                            <th scope="col">Score 3 factor</th>
                            <th scope="col">Score 5 factor</th>
                        </tr>
                    </thead>
                    <tbody>   
                        <tr>  
                            <!--SF1-->  <td><input type="radio" name="step_one" value="Minor surgery" data-trf="1" id="checked"/>Minor surgery <br> </td>
                            <!--SF2-->  <td>  <input type="radio" name="step_one" value="Major Surgery  >45min" data-trf="2" id="checked"/> Major Surgery  >45min<br> </td>
                            <td>
                                <!--SF3--> <input type="radio" name="step_one" value=" Major surgery with Myocardial infarction/Congestive heart failure/Severe sepsis/infection" data-trf="1" cid="checked"/> 
                                Major surgery with
                                <br>  - Myocardial infarction
                                <br>  - Congestive heart failure
                                <br>  - Severe sepsis/infection
                            </td>
                            <!--SF5-->   <td scope="row">
                                <input type="radio" name="step_one" value="Elective major lower extremity arthroplasty" data-trf="5" id="checked"/> 
                                Elective major lower  
                                <br>extremity arthroplasty
                            </td> </tr>
                        <tr>
                            <td> <br> </td>
                            <!--SF2-->  <td>   <input type="radio" name="step_one" value="Laparoscopic surgery (>45min)" data-trf="2" id="checked"/> Laparoscopic surgery (>45min)</td>                                  
                            <!--SF3-->  <td>   <input type="radio" name="step_one" value="Medical patient with additional risk factors" data-trf="3" id="checked"/> Medical patient with additional risk factors<br></td>
                            <!--SF5-->  <td>   <input type="radio" name="step_one" value="Hip, pelvis or leg fracture" data-trf="5"id="checked"/> Hip, pelvis or leg fracture</td>

                        </tr>
                        <tr>
                            <td></td>
                            <!--SF2-->   <td><input type="radio" name="step_one" value="Patients confined to bed >72 hours" data-trf="2" id="checked"/>Patients confined to bed >72 hours</td>

                            <td></td>
                            <!--SF5--> <td><input type="radio" name="step_one" value="Stroke" data-trf="5" id="checked"/> Stroke</td>                   

                        </tr>
                        <tr>
                            <td></td>
                            <!--SF2-->  <td> <input type="radio" name="step_one" value="Immobilizing plaster cast" data-trf="2" d="checked"/> Immobilizing plaster cast</td>

                            <td></td>
                            <!--SF5--> <td><input type="radio" name="step_one" value="Multiple trauma" data-trf="5" id="checked"/> Multiple trauma</td>   

                        </tr>

                        <tr>
                            <td></td>
                            <!--SF2--> <td> <input type="radio" name="step_one" value="Central venous access" data-trf="2" id="checked"/>Central venous access</td>

                            <td></td>
                            <!--SF5--> <td> <input type="radio" name="step_one" value="Acute spinal cord injury (paralysis)" data-trf="5" id="checked"/> Acute spinal cord injury (paralysis)</td>
                        </tr>
                    </tbody>
                </table> 
                </div>

                <!-- START OF STEP 2 -->

                <div class="container">
                    <table class="table table-sm">
                        <h1>STEP 2: Check Risk Factors associated with Patient</h1>
                        <h2>(Additional Risk Factor Score)</h2>
                        <thead>
                            <tr>                  
                                <th scope="col">Clinical</th>
                                <th scope="col">Hypercoagulable States (Thrombophilia)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>    
                            <tr>
                                <td><br></td>
                                <td> INHERITED</td>                     
                                <td> ACQUIRED</td>
                            </tr>
                            <tr class="noBorder">       
                                <!--SF1-->   <td><input type="checkbox" name="step_two[]" value="Age 41 to 60 years" data-trf="1" id="checked"> Age 41 to 60 years<br> </td>
                                <!--SF3--> <td><input type="checkbox" name="step_two[]" value="Factor V Leiden/Activated protein C resistance" data-trf="3" id="checked"> Factor V Leiden/Activated protein <br> C resistance </td>
                                <!--SF3--><td><input type="checkbox" name="step_two[]" value="Lupus anticoagulant"data-trf="3" id="checked"> Lupus anticoagulant</td>
                            </tr>
                            <tr>
                                <!--SF2--> <td><input type="checkbox" name="step_two[]" value="Age over 60 years (2 factors)" data-trf="2" id="checked"> Age over 60 years (2 factors)<br> </td>
                                <!--SF3--><td><input type="checkbox" name="step_two[]" value="Antithrombin III deficiency" data-trf="3" id="checked"> Antithrombin III deficiency</td>                     
                                <!--SF3--><td><input type="checkbox" name="step_two[]" value="Antiphospholipid antibodies"data-trf="3" id="checked"> Antiphospholipid antibodies</td>
                            </tr>
                            <tr>
                                <!--SF3--> <td><input type="checkbox" name="step_two[]" value="History of DVT/PE (3 factors)"data-trf="3" id="checked"> History of DVT/PE (3 factors)</td>
                                <!--SF3-->  <td><input type="checkbox" name="step_two[]" value="Protein C or S deficiency" data-trf="3 id="checked""> Protein C or S deficiency</td>                                            
                                <!--SF3--> <td><input type="checkbox" name="step_two[]" value="Myeloproliferative disorders"data-trf="3" id="checked"> Myeloproliferative disorders</td>
                            </tr>
                            <tr>
                                <!--SF1--> <td><input type="checkbox" name="step_two[]" value="History of prior major surgery"data-trf="1" id="checked"> History of prior major surgery</td>
                                <!--SF3--><td><input type="checkbox" name="step_two[]" value="Dysfibrinogenemia"data-trf="3" id="checked"> Dysfibrinogenemia</td>
                                <!--SF3--> <td><input type="checkbox" name="step_two[]" value="Disorders of plasminogen & plasmin activation"data-trf="3"id="checked"> Disorders of plasminogen & plasmin activation</td>
                            </tr> 
                            <tr>
                                <!--SF1--> <td><input type="checkbox" name="step_two[]" value="Pregnancy, or postpartum (<1 month)"data-trf="1"id="checked"> Pregnancy, or postpartum (<1 month)</td>
                                <!--SF3--> <td><input type="checkbox" name="step_two[]" value="Prothrombin 20210A" data-trf="3"id="checked"> Prothrombin 20210A</td>
                                <!--SF3-->  <td><input type="checkbox" name="step_two[]" value="Heparin-induced thrombocytopenia" data-trf="3"id="checked"> Heparin-induced thrombocytopenia</td>
                            </tr> 
                            <tr>
                                <!--SF2-->  <td><input type="checkbox" name="step_two[]" value="Malignacy (2 factors)"data-trf="2"id="checked"> Malignacy (2 factors)</td>
                                <!--SF3--><td><input type="checkbox" name="step_two[]" value="Homocysteinemia" data-trf="3"id="checked"> Homocysteinemia</td>
                                <!--SF3--> <td><input type="checkbox" name="step_two[]" value="Hyperviscosity syndrome" data-trf="3" id="checked"> Hyperviscosity syndrome</td>
                            </tr> 
                            <tr>
                                <!--SF1-->  <td><input type="checkbox" name="step_two[]" value="Varicose veins" data-trf="1" id="checked"> Varicose veins</td>
                                <td></td>
                                <!--SF3--> <td><input type="checkbox" name="step_two[]" value="Homocysteinemia"data-trf="3" id="checked"> Homocysteinemia</td>
                            </tr> 
                            <tr>
                                <!--SF1-->   <td><input type="checkbox" name="step_two[]" value="Inflammatory bowel disease" data-trf="1" id="checked"> Inflammatory bowel disease</td>
                                <td></td>
                                <td></td>
                            </tr> 
                            <tr>
                                <!--SF1--> <td><input type="checkbox" name="step_two[]" value="Obesity (>20% of ideal body weight)"data-trf="1" id="checked"> Obesity (>20% of ideal body weight)</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <!--SF1-->   <td><input type="checkbox" name="step_two[]" value="Oral contraceptives or hormone replacement therapy"data-trf="1" id="checked"> Oral contraceptives or hormone <br> replacement therapy</td>
                                <td></td>
                                <td></td>
                            </tr> 
                        </tbody>
                    </table>

                    <!-- START OF STEP 3 -->
                    <br><br>
                    <h1>STEP 3: Total Risk Factor Score (TRF Score)</h1>
        <!--            <input type="text" style="border-color: 3px solid black;
                           padding: 12px 20px;
                           margin: 8px 0;
                           box-sizing: border-box; 
                           align-self:center;
                           width: 60%;" placeholder="Baseline Risk Factor Score + Additional Risk Factor Score = Total Risk Factor Score">-->
<!--                                Total: <input type="text" name="total" id="price"/>-->
<!--                    <p>TRF:<span id="trf" name="TRF" ></span></p>-->
                    <p>TRF:<input type="text"id="trf" name="trf"></span></p>
<!--                        <input type="number" id="price" >-->

                    <br><br><br>
                    <!-- START OF STEP 4 -->
                    <div class="container">
                        <table class="table table-sm">
                            <h1>STEP 4: Identify Recommended Prophylactic Regimen 
                                <br>for each Risk Group depending on TRF Score</h1>

                            <tbody>
                            <thead>
                                <tr>                  
                                    <th scope="col">Low Risk <br> (1 factor)</th>
                                    <th scope="col">Moderate Risk <br> (2 factor)</th>
                                    <th>High Risk <br> (3-4 factors)</th>
                                    <th>Highest Risk <br> (5 or more factors)</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>No Specific Measures<br>Early Ambulation</td>
                                <td>IPC or LDUH (q12h) or<br>LMWH or GCS </td>
                                <td>GCS* and IPC or<br> LDUH (q8h) or LMWH</td>
                                <td>GCS* and IPC + (LDUH or LMWH) or<br>ADH or LMWH Oral Anticoagulants</td>
                                Risk Level:<input type="number" name="risk_lvl"/>
                            </tr>
                            </tbody>
                        </table> 
                    </div> 

                    <!-- START OF STEP 5 -->
                    <br><br>
                    <div class="container">
                        <table class="table table-sm">
                            <h1>STEP 5: Choose from Modalities listed below</h1>
                            <h3>guided by STEP 4</h3>


                            <thead>
                            <td>Contraindication to anticoagulants?<br>          
                                <input type="checkbox" name="anticoagulants" value="Yes"> Yes <br>         
                                <input type="checkbox" name="anticoagulants" value="No" > No <br>
                                If yes, elaborate <input type="text" name="anticoagulants_elab" id="anticoagulants_elab" style="border: none; border-bottom: 2px solid black; width: 70%;"></td>
                            <th></th>
                            <th></th>
                            </thead>

                            <tbody>  
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="modalities[]" value="Graduated compression stockings (GCS)"> Graduated compression stockings (GCS)</td>
                                    <td><input type="checkbox" name="modalities[]" value="Enoxaparin 40mg/SC q 24 h"> Enoxaparin 40mg/SC q 24 h</td>
                                    <td><input type="checkbox" name="modalities[]" value="Dabigatran 220 mg/tab po q 24h"> Dabigatran 220 mg/tab po q 24h</td>

                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="modalities[]" value="Intermittent pneumatic compression (IPC)"> Intermittent pneumatic compression (IPC)</td>
                                    <td><input type="checkbox" name="modalities[]" value="Fondaparinux 2.5 mg/SC q 24 h"> Fondaparinux 2.5 mg/SC q 24 h</td>
                                    <td><input type="checkbox" name="modalities[]" value="Rivaroxaban 10mg/tab po q 24 h"> Rivaroxaban 10mg/tab po q 24 h</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="modalities[]" value="Plantar Pneumatic Compression"> Plantar Pneumatic Compression</td>
                                    <td><input type="checkbox" name="modalities[]" value="Nadroparin 3,800 IU/ SC q 24 h" > Nadroparin 3,800 IU/ SC q 24 h</td>
                                    <td>Others: <input type="text"  name="other_modalities" id="other_modalities" style="border: none; border-bottom: 2px solid black; width: 100%;"></td>                   
                                </tr>
                                <tr>

                                    <td><input type="checkbox" name="modalities[]" value="Adjusted dose Heparin (ADH)"> Adjusted dose Heparin (ADH)</td>
                                    <td><input type="checkbox" name="modalities[]" value="Tinzaparin 3,500 IU/SC q 24 h"> Tinzaparin 3,500 IU/SC q 24 h</td>
                                    <td><input type="checkbox" name="modalities[]" value="No prophylaxis"> No prophylaxis</td>     
                                </tr>

                                <tr>
                                    <td></td>
                                    <td><input type="checkbox" name="modalities[]" value="Tinzaparin 4,500 IU/SC q 24 h"> Tinzaparin 4,500 IU/SC q 24 h</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="checkbox" name="modalities[]" value="Low dose unfractionated heparin <br> (LDUH) 5,000 U/SC q 8h"> Low dose unfractionated heparin <br> (LDUH) 5,000 U/SC q 8h </td>
                                    <td></td>
                                </tr>
<!--                                Physician: <input type="text" name="exam_phys"/>-->
                            <input type="hidden" name="username" class="username" required readonly value="<?php echo $_SESSION['username']; ?>">

<!--                            Date: <input type="date" name="exam_date"/> -->
<!--                            Date Updated: <input type="date" name="date_updated"/> -->

                            </tbody>
                        </table> 
                    </div> 
                    <br><br>
        <!--                    <center><button class="button"style="padding: 5px; width: 40%";>Submit</button></center>-->
                    <input type="submit" name="Submit" value="Submit">  

                    <br><br><br>
                    <!-- what div -->
                </div>
            </form>
        </table>

        <script>
            function calcTRF() {
                var trf = 0;
                $("input[id=checked][data-trf]:checked").each(function (i, el) {
                    trf += +$(el).data("trf");
                });
                $("#trf").val(trf);
            }

            $("input[id=checked]").on("change", calcTRF);
            calcTRF();




//                    $(document).ready(function () {
//                $("input[id=checked][data-trf]").click(function (event) {
//                    var total = 0;
//                    $("input[id=checked][data-trf]:checked").each(function () {
//                        total += parseInt($(this).val());
//                    });
//
//                    if (total == 0) {
//                        $('#amount').val('');
//                    } else {
//                        $('#amount').val(total);
//                    }
//                });
//            });
            var val = "<?php echo $id ?>";
//        alert(val);

            document.getElementById("ph_id").setAttribute("value", val);
            //call date


        </script>
    </script>
</body> 
</html>



