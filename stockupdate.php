<?php

session_start(); 


if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true){
    header("location: Bank_login.php");
    exit();
}

include('dbconnect.php');


$bank=1004;
$blgGrp='A-';

$sql5="UPDATE stock SET `$blgGrp`=`$blgGrp`+1 WHERE stock.bankId = $bank";
$result5=mysqli_query($conn,$sql5);

if($result5){
    echo"Stock updated";
}
else{
    echo"Stock updation failed-> ".mysqli_error($conn);
}


?>