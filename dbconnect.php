<?php
$host="localhost";
$username="root";
$password="";
$database="rakt";

$conn=mysqli_connect($host,$username,$password,$database);
if($conn){
    // echo"   
    // <div class='alert alert-success alert-dismissible fade show' role='alert'>
    //     <strong>DB Connected !</strong>
    //     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    //     <span aria-hidden='true'>&times;</span>
    //     </button>
    // </div>";
}
else{
    die("Unable to connect to database due to: ".mysqli_connect_error());
}
?>