<?php
session_start(); 


if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true){
    header("location: Bank_login.php");
    exit();
}

$showError=0;
$showError2=0;
$success=0;
$fail=0;

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include('dbconnect.php');
    $reqEmail=$_POST['email'];
    $dot=$_POST['dot'];
    $bank=$_SESSION['bankId'];

    $sql1="SELECT * FROM requests WHERE requests.reqEmail='$reqEmail'";
    $result1=mysqli_query($conn,$sql1);
    $num1=mysqli_num_rows($result1);
    if($result1){
        if($num1==1){
            //Check the req Status
            $row=mysqli_fetch_assoc($result1);
            $reqId=$row['reqId'];
            $reqStat=$row['reqStatus'];

            //Grab the bldGrp of requestee
            $sq="SELECT * FROM patient WHERE patient.pEmail='$reqEmail'";
            $res=mysqli_query($conn,$sq);
            $row1=mysqli_fetch_assoc($res);
            $bldGrp=$row1['pBldGrp'];


            if($reqStat!=1){
                //Update reqStatus to 1
                $sql2="UPDATE requests SET reqStatus = 1 WHERE requests.reqEmail='$reqEmail'";
                $result2=mysqli_query($conn,$sql2);
                if($result2){
                    //Insert data to transfer table
                    $sql3="INSERT INTO transfer VALUES ('$reqId', '$bank', '$dot')";
                    $result3=mysqli_query($conn,$sql3);
                    if($result3){
                        //Reduce the stock by 1
                        $sql5="UPDATE stock SET `$bldGrp`=`$bldGrp`-1 WHERE stock.bankId = $bank";
                            $result5=mysqli_query($conn,$sql5);
                            if($result5){
                                $success=1;
                                //echo"Stock updated";
                            }
                            else{                 
                                $fail=1;
                                //echo"Stock updation failed-> ".mysqli_error($conn);
                            }
                    }
                }
            }
            else{
                $showError2=1;
            }


        }
        else{
            $showError=1;
        }
    }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plasma Donated</title>
    <style>
        <?php include './form.css'; ?>
    </style>
</head>

<body>
    <?php require "header.php" ?>
        <?php
        if($showError==1){
            echo'<script type="text/javascript">alert("Please request for plasma. Please complete your request form first.")</script>';
        }
        if($showError2==1){
            echo'<script type="text/javascript">alert("This patient has already recived plasma.")</script>';
        }
        if($success==1){
            echo'<script type="text/javascript">alert("This requestee is successfully donated plasma !!")</script>';
        }
        if($fail==1){
            $message = "Unable to donate this requestee due to" .mysqli_error($conn);
            echo '<script language = "Javascript" type="text/javascript">';
            echo 'alert('.json_encode($message) .') ;';
            echo '</script>';
        }
    ?>

        <h3>Plasma Donated</h3>
        <form method="post" class="login">
            <div> Requestee's Email address: <br> <input type="email" name="email" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Email"></div><br>
            <div> Plasma is given to requestee on date: <br> <input type="date" name="dot" id="exampleInputEmail1" aria-describedby="emailHelp"
                    required></div><br>
            <div> <input type="checkbox" id="exampleCheck1" required>
                <label for="exampleCheck1">I verify that this patient is given plasma </label></div><br>

            <div><button type="submit" class="btn btn-primary">Alloted</button></div>
        </form>
    </div>
    <?php require "footer.php" ?>
</body>

</html>