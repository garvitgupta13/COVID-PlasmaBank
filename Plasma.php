<?php
session_start(); 
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width">
    <style>
    <?php include './Plasma.css'?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>I-Plasma</title>
</head>

<body>
    <?php require "header.php" ?>

    <section id="first">

        <?php 
        if(isset($_SESSION['MloggedIn'])){
            if( $_SESSION['MloggedIn']==true){
        $message = "Welcome ". $_SESSION['username']." to the Plasma bank";
        echo '<script language = "Javascript" type="text/javascript">';
        echo 'alert('.json_encode($message) .') ;';
        echo '</script>';}}
    ?>
        <div class="circle">
            <a class="btn" href="./Patient_register.php"><img src="./Images/patient.png"></a>
            <a class="btn" href="./Patient_register.php">Patient Register</a>
        </div>
        <div class="circle">
            <a class="btn" href="./Patient_request.php"><img src="./Images/donor.png"></a>
            <a class="btn" href="./Patient_request.php">Request Plasma</a>
        </div>
        <div class="circle">
            <a class="btn" href="./instructions.php"><img src="./Images/img.png"></a>
            <a class="btn" href="./instructions.php">Volunteer Register</a>
        </div>
    </section>
    <section id="second">
        <div>
            <div class="container-md">
                <br>
                <center>
                    <h3>Shoutout to all donors for helping🥳 🥳 </h3>
                </center>
                <br>
                <table class="table">
                    <?php
                include 'dbconnect.php';
                $sql="SELECT user.uName,user.uAge,user.uCity FROM user,donor WHERE user.uEmail=donor.donorEmail";
                $result=mysqli_query($conn,$sql);
                $num=mysqli_num_rows($result);
                if($num>0){
                    echo"<thead class='thead-dark'>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>City</th>
                        </tr>
                        </thead>
                        <tbody>";
                        while($row=mysqli_fetch_assoc($result)){
                            echo"
                            <tr>
                                <td>".$row['uName']."</td>
                                <td>".$row['uAge']."</td>
                                <td>".$row['uCity']."</td>                               
                            </tr>";
                        }
                    echo"</tbody>";
                    }
                ?>
                </table>
            </div>

        </div>
        <div>
            <div class="container-md">
                <br>
                <center>
                    <h3>Patients who recieved Plasma </h3>
                </center>
                <br>
                <table class="table">
                    <?php
                include 'dbconnect.php';
                $sql="SELECT patient.pName,patient.pAge,patient.pDoc FROM requests,patient WHERE requests.reqStatus=1 AND requests.reqEmail=patient.pEmail";
                $result=mysqli_query($conn,$sql);
                $num=mysqli_num_rows($result);
                if($num>0){
                    echo"<thead class='thead-dark'>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Doctor</th>
                        </tr>
                        </thead>
                        <tbody>";
                        while($row=mysqli_fetch_assoc($result)){
                            echo"
                            <tr>
                                <td>".$row['pName']."</td>
                                <td>".$row['pAge']."</td>
                                <td>".$row['pDoc']."</td>                               
                            </tr>";
                        }
                    echo"</tbody>";
                    }
                ?>
                </table>
            </div>
        </div>
    </section>
    <section id="third">
        <div>
            <br>
            <center>
                <h3>Bank Stocks </h3>
            </center>
            <br><br>
            <div class="container-md">
                <table class="table">
                    <?php
                include 'dbconnect.php';
                $sql="SELECT * FROM bank";
                $result=mysqli_query($conn,$sql);
                $num=mysqli_num_rows($result);
                
                $sql2="SELECT * FROM bank,stock WHERE stock.bankId=bank.bankId";
                $result2=mysqli_query($conn,$sql2);
                $num2=mysqli_num_rows($result2);
                if($num2>0){
                    echo"<thead class='thead-dark'>
                        <tr>
                            <th>Bank</th>
                            <th>City</th>
                            <th>A+</th>
                            <th>B+</th>
                            <th>AB+</th>
                            <th>O+</th>
                            <th>A-</th>
                            <th>B-</th>
                            <th>AB-</th>
                            <th>O-</th>
                            
                        </tr>
                        </thead>
                        <tbody>";
                        while($row2=mysqli_fetch_assoc($result2)){
                            echo"
                            <tr>
                                <td>".$row2['bName']."</td>
                                <td>".$row2['bCity']."</td>
                                <td>".$row2['A+']."</td>
                                <td>".$row2['B+']."</td>
                                <td>".$row2['AB+']."</td>
                                <td>".$row2['O+']."</td>
                                <td>".$row2['A-']."</td>
                                <td>".$row2['B-']."</td>
                                <td>".$row2['AB-']."</td>
                                <td>".$row2['O-']."</td>
                                                               

                            </tr>";
                        }
                    echo"</tbody>";
                    }
                ?>
                </table>
            </div>
        </div>
    </section>
    <!-- <section id="fourth">
        <div></div>
    </section> -->
    <section id="fifth">
        <div>
            <h3>COVID-19 transmission and protective measures</h3>
            <div class="container">
                <div>1. Clean your hands often</div>
                <div>2. Cough or sneeze in your bent elbow - not your hands!</div>
                <div>3. Avoid touching your eyes, nose and mouth</div>
                <div>4. Limit social gatherings and time spent in crowded places</div>
                <div>5. Avoid close contact with someone who is sick</div>
                <div>6. Clean and disinfect frequently touched objects and surfaces</div>
            </div>
        </div>
    </section>
    <?php require "footer.php" ?>
</body>

</html>