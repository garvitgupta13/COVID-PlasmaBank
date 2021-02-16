<?php 
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include('dbconnect.php');
    $reqEmail=$_POST['EmailID'];
    $password=$_POST['password'];

    $sql1="Select * from patient WHERE pEmail='$reqEmail' AND pPassword='$password'";
    $result1=mysqli_query($conn,$sql1);
    $num1=mysqli_num_rows($result1);

    if($num1==1){
        $row=mysqli_fetch_assoc($result1);
        if($row['pVerified']==1){
            $sql3="SELECT * FROM requests WHERE requests.reqEmail='$reqEmail'";
            $result3=mysqli_query($conn,$sql3);
            $num3=mysqli_num_rows($result3);
            if($num3==0){

                $sql2="INSERT INTO requests VALUES (NULL, '$reqEmail', 0)";
                $result2=mysqli_query($conn,$sql2);
                if($result2){
                    echo'<script type="text/javascript">alert("Your request has been added  !!")</script>';
                }
                else{
                    $message = "Unable to add new request due to" .mysqli_error($conn);
                    echo '<script language = "Javascript" type="text/javascript">';
                    echo 'alert('.json_encode($message) .') ;';
                    echo '</script>';
                }
            }
            else{
                echo'<script type="text/javascript">alert("You have already made a request")</script>';
            }
        }
        else{
            $message = "Please complete your verification process by visiting your neraby Plasma Bank. Only verified patients can request for plasma" .mysqli_error($conn);
            echo '<script language = "Javascript" type="text/javascript">';
            echo 'alert('.json_encode($message) .') ;';
            echo '</script>';
        }
    }
    else{
        $message = "Only registered patients can make request. 
                    Invalid Credentials" .mysqli_error($conn);
        echo '<script language = "Javascript" type="text/javascript">';
        echo 'alert('.json_encode($message) .') ;';
        echo '</script>';
    }

}
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width">
    <title>Patient Request</title>
    <style>
    <?php include './form.css';
    ?>
    </style>
</head>

<body>
    <?php require "header.php" ?>
    <h3>Request Now</h3>
    <form class="login" method="POST">
        <div>
            <p id="warning">**Verified patients can request for plasma**</p>
        </div><br>
        <div>Email ID : <input name="EmailID" type="email" required></div><br>
        <div>Password : <input name="password" type="password" required></div><br>
        <div><button type="submit">Request</button></div><br>
        <div>
            <p>Not registered yet ? first <a href="./Patient_register.php">Register Here</a></p>
        </div>
    </form>
    <?php require "footer.php" ?>
</body>

</html>