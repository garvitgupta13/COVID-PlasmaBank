<?php
session_start(); 


if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true){
    header("location: Bank_login.php");
    exit();
}
// UPDATE `patient` SET `pVerified` = '0' WHERE `patient`.`pEmail` = 'garvitgupta2001@gmail.com';
$success=0;
$fail=0;
$showError1=0;
$showError2=0;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include('dbconnect.php');
    $pEmail=$_POST['email'];
    

    $sql1="SELECT * FROM patient WHERE patient.pEmail='$pEmail'";
    $result1=mysqli_query($conn,$sql1);
    $num1=mysqli_num_rows($result1);
    if($num1==1){
        $row=mysqli_fetch_assoc($result1);
        if($row['pVerified']==0){
            $sql="UPDATE patient SET pVerified=1 WHERE patient.pEmail = '$pEmail'";
            $result=mysqli_query($conn,$sql);
            if($result){
                $success=1;
            }
            else{
                $fail=1;
            }

        }
        else{
        $showError2=1;
        }


    }
    else{
        $showError1=1;
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient verification</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <style>
    <?php include './form.css';

    ?>body {
        font-family: "Roboto", sans-serif;

    }
    </style>
</head>

<body>
    <?php require "header.php" ?>


    <?php
    if($showError1==1){
        echo'<script type="text/javascript">alert("This email id is not registered. Please complete your registration first.")</script>';
    }
    if($showError2==1){
        echo'<script type="text/javascript">alert("This patient is already verified.")</script>';
    }
    if($success==1){
        echo'<script type="text/javascript">alert("Patient Verification Successfull !!")</script>';
    }
    if($fail==1){
        $message = "Unable to verify this patient due to" .mysqli_error($conn);
            echo '<script language = "Javascript" type="text/javascript">';
            echo 'alert('.json_encode($message) .') ;';
            echo '</script>';
    }
    ?>

    <h3>Verify Patient</h3>
    <form method="post" class="login">
        <div>Patient Email address: <br><br> <input type="email" name="email" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Email" required></div><br>
        <div>
            <input type="checkbox" id="exampleCheck1" required>
            <label for="exampleCheck1">I verify that this patient is genuine. </label>
        </div><br>

        <div><button type="submit">Verify</button></div>
    </form>
    <?php require "footer.php" ?>
</body>

</html>