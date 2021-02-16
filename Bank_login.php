<?php

$Mlogin=false;
$loggedIn=false;
$showError=false;

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'dbconnect.php';
    $EmpId=$_POST['empId'];
    $password=$_POST['password'];

    $sql="Select * from manager where empId='$EmpId' AND empPassword='$password'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    $row=mysqli_fetch_assoc($result);

    if($num==1){
        $Mlogin=true;
        session_start();
        $_SESSION['MloggedIn']=true;
        $_SESSION['loggedIn']=true;
        $_SESSION['username']=$row['empName'];
        $_SESSION['bankId']=$row['BankId'];
        header("location: Plasma.php");
    }
    else{
        $showError="Invalid credentials";
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width">
    <title>Bank Login</title>
    <style>
        <?php include './form.css'; ?>
    </style>
</head>

<body>
    <?php require "header.php" ?>
    <h3>Login Now</h3>
    <?php
    if($showError){
        echo'<script type="text/javascript">alert("ERROR !! Invalid credentials")</script>';
    }
    if($Mlogin){
        echo'<script type="text/javascript">alert("Logged In succesfully!")</script>';
    }
    ?>
    <form class="login" method="POST">
        <div><p id="warning">**All fields are mandatory**</p></div><br>
        <div>Employee Id : <input name="empId" type="number" required></div><br>
        <div>Password : <input name="password" type="password" required></div><br>
        <div><button type="submit">Submit</button></div><br>
    </form>
    <?php require "footer.php" ?>
</body>

</html>