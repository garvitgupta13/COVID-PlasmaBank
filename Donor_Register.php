<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include('dbconnect.php');
    $uName=$_POST['Name'];
    $uEmail=$_POST['EmailId'];
    $uAge=$_POST['Age'];
    $uSex=(int)$_POST['Sex'];
    //$uPassword="...";
    $uAdd=$_POST['Address'];
    $uCity=$_POST['City'];
    $uPincode=$_POST['Pincode'];
    $uPhone=$_POST['MobileNo'];
    $uBldGrp=$_POST['BldGrp'];
    $udos=$_POST['dos'];
    // ('uEmail', 'uName', 'uAge', 'uSex', 'uPassword', 'uAddress', 'uCity', 'uPincode', 'uPhone', 'uBldGrp', 'uDos')
    $sql="INSERT INTO user VALUES ('$uEmail', '$uName', '$uAge', '$uSex', '$uAdd', '$uCity', '$uPincode', '$uPhone', '$uBldGrp', '$udos')";
    $result=mysqli_query($conn,$sql);
        if($result){
            echo'<script type="text/javascript">alert("New volunteer Added  !!Please complete your verification process by visiting nearby Plasma Bank")</script>';
        }
        else{
            $message = "Unable to add new user due to" .mysqli_error($conn);
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
    <title>Volunteer Register</title>
    <style>
    <?php include './form.css';
    ?>
    </style>
</head>

<body>
    <?php require "header.php" ?>
    <h3>Register Here</h3>
    <form class="Donor_register" method="POST">
        <div>
            <p id="warning">**All fields are mandatory**</p>
        </div><br>
        <fieldset>
            <legend>Donor Details : </legend>
            <div>Name : <input name="Name" type="text" required></div><br>
            <div>Age : <input name="Age" type="number" required></div><br>
            <div>Sex : <input name="Sex" type="radio" value="1" id="Male" required><label for="male">Male</label>
                <input name="Sex" type="radio" value="0" id="Female"><label for="female">Female</label>
                <input name="Sex" type="radio" value="2" id="Others"><label for="others">Others</label>
            </div><br>
            <div>Blood Group : <select name="BldGrp" required>
                    <option value="A+">A+</option>
                    <option value="O+">O+</option>
                    <option value="B+">B+</option>
                    <option value="AB+">AB+</option>
                    <option value="A-">A-</option>
                    <option value="O-">O-</option>
                    <option value="B-">B-</option>
                    <option value="AB-">AB-</option>
                </select></div><br>
            <div>Mobile No. : <input name="MobileNo" type="tel" required></div><br>
            <div>Email ID : <input name="EmailId" type="email" required></div><br>
            <div>Address : <input name="Address" type="text" required></div><br>
            <div>City : <input name="City" type="text" required></div><br>
            <div>Pincode : <input name="Pincode" type="number" required></div><br>
            <div>Date of Screening : <input name="dos" type="date" required></div><br>
        </fieldset><br>
        <div><button type="submit">Submit</button></div><br>
    </form>
    <?php require "footer.php" ?>
</body>

</html>