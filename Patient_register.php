<!-- INSERT INTO `patient` (`pEmail`, `pName`, `pAge`, `pSex`, `pDoc`, `pHospital`, `pPincode`, `pBldGrp`, `pPassword`, `pPhone`, `pDoa`, `pVerified`) VALUES ('gg@g.com', 'garry', '20', '1', 'Dr. Sharad Shukla', 'Hospital of Mirzapur', '222002', 'AB+', 'gg@1', '7424902827', '2020-11-17', '0'); -->
<?php
session_start(); 

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include('dbconnect.php');
    $pName=$_POST['Name'];
    $pEmail=$_POST['EmailId'];
    $pAge=$_POST['Age'];
    $pSex=(int)$_POST['Sex'];
    $pDoc=$_POST['doc'];
    $pHospital=$_POST['Hospital'];
    $pPassword=$_POST['password'];
    $pconfPassword=$_POST['cPassword'];
    $pPincode=$_POST['Pincode'];
    $pPhone=$_POST['MobileNo'];
    $pBldGrp=$_POST['BldGrp'];
    $pdoa=$_POST['doa'];

    if($pconfPassword==$pPassword){
    $sql="INSERT INTO patient VALUES ('$pEmail', '$pName', '$pAge', '$pSex', '$pDoc', '$pHospital', '$pPincode', '$pBldGrp', '$pPassword', '$pPhone', '$pdoa', 0)";
    $result=mysqli_query($conn,$sql);
        
        if($result){
            echo'<script type="text/javascript">alert("Congratulations!! You are registered as patient. Please complete your verification process by visiting nearby Plasma Bank")</script>';
        }
        else{
            $message = "Unable to add new patient due to" .mysqli_error($conn);
            echo '<script language = "Javascript" type="text/javascript">';
            echo 'alert('.json_encode($message) .') ;';
            echo '</script>';
        }
    }
    else{
        echo'<script type="text/javascript">alert("Password and confirm password does not match")</script>';
    }

}


?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width">
    <title>Patient Register</title>
    <style>
    <?php include './form.css';
    ?>
    </style>
</head>

<body>
    <?php require "header.php" ?>
    <h3>Register Here</h3>
    <form class="Patient_register" method="POST">
        <div>
            <p id="warning">**All fields are mandatory**</p>
        </div><br>
        <fieldset>
            <legend>Patient Details : </legend>
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
        </fieldset><br>
        <fieldset>
            <legend>Hospital Details : </legend>
            <div>Hospital Name : <input name="Hospital" type="text" required></div><br>
            <div>Doctor Incharge : <input name="doc" type="text" required></div><br>
            <div>Date of admission : <input name="doa" type="date" required></div><br>
            <div>Pincode : <input name="Pincode" type="text" required></div><br>
        </fieldset><br>
        <div>Password : <input name="password" type="password" required></div><br>
        <div>Confirm Password : <input name="cPassword" type="password" required></div><br>
        <div><button type="submit">Submit</button></div><br>
        <div>
            <p>Aldeady registered <a href="./Patient_request.php">Request Now</a></p>
        </div>
    </form>
    <?php require "footer.php" ?>
</body>

</html>