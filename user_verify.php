<?php
session_start(); 


if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true){
    header("location: Bank_login.php");
    exit();
}

$showErr1=0;
$showErr2=0;
$success=0;
$fail=0;

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include('dbconnect.php');
    $uEmail=$_POST['email'];
    $dod=$_POST['dod'];
    $bank=$_SESSION['bankId'];

    $sql1="SELECT * FROM user WHERE user.uEmail='$uEmail'";
    $result1=mysqli_query($conn,$sql1);
    $num1=mysqli_num_rows($result1);
    if($result1){
        if($num1==1){
            $row=mysqli_fetch_assoc($result1);
            $blgGrp=$row['uBldGrp'];

            $sql="SELECT * FROM donor WHERE donor.donorEmail='$uEmail'";
            $res=mysqli_query($conn,$sql);
            $n=mysqli_num_rows($res);
            if($res){
                if($n!=1){
                    //Insert the user to Donor table
                    //echo $uEmail," ",$dod," ",$bank;
                    $sql2="INSERT INTO donor VALUES (NULL,'$uEmail', 2020000, '$dod', '$bank')";
                    $result2=mysqli_query($conn,$sql2);
                    if($result2){
                        //echo"Inserted";
                        //Update the plasmaId
                        $sql3="SELECT * FROM donor WHERE donor.donorEmail='$uEmail'";
                        $result3=mysqli_query($conn,$sql3);
                        $row3=mysqli_fetch_assoc($result3);
                        $donorId=$row3['donorId'];
                        //echo $donorId;
                        $sql4="UPDATE donor SET plasmaId=plasmaId+$donorId WHERE donor.donorId = $donorId";
                        $result4=mysqli_query($conn,$sql4);
                        if($result4){
                            //UPDATE `stock` SET `A+` = '1' WHERE `stock`.`bankId` = 1004;
                            $sql5="UPDATE stock SET `$blgGrp`=`$blgGrp`+1 WHERE stock.bankId = $bank";
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
                    $showErr2=1;
                }
            }
        }
        else{
            $showErr1=1;
        }
    }
    
}



?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User verification</title>
    <style>
    <?php include './form.css';
    ?>
    </style>
</head>

<body>
    <?php require "header.php" ?>

    <?php
        if($showErr1==1){
            echo'<script type="text/javascript">alert("This email id is not registered. Please complete your registration first.")</script>';
        }
        if($showErr2==1){
            echo'<script type="text/javascript">alert("This volunteer is already verified.")</script>';
        }
        if($success==1){
            echo'<script type="text/javascript">alert("Volunteer Verification Successfull and added to donor table !!")</script>';
        }
        if($fail==1){
            $message = "Unable to verify this user due to" .mysqli_error($conn);
            echo '<script language = "Javascript" type="text/javascript">';
            echo 'alert('.json_encode($message) .') ;';
            echo '</script>';
        }
    ?>

    <h3>Verify Volunteer</h3>
    <form method="post" class="login">
        <div>Donor E-mail address: <br> <input type="email" name="email" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Email" required></div><br>

        <div>Date of Donation: <br> <input type="date" name="dod" id="exampleInputEmail1" aria-describedby="emailHelp"
                required></div><br>
        <div>
            <input type="checkbox" id="exampleCheck1" required>
            <label for="exampleCheck1">I verify that this donor has COVID antibody in his
                plasma and has donated his plasma. </label>
        </div><br>

        <div><button type="submit" class="btn btn-primary">Verified</button></div>
    </form>
    </div>
    <?php require "footer.php" ?>
</body>

</html>