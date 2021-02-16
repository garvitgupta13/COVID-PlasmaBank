<!-- SELECT patient.pName,patient.pEmail,patient.pAge,patient.pSex,patient.pBldGrp,patient.pPhone FROM patient,requests
WHERE requests.reqEmail=patient.pEmail AND requests.reqStatus=0 -->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Plasma Recieved</title>
    <style>
        <?php include './style.css'; ?>
    </style>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
      <?php require "header.php" ?>
    <br><br>
    <center>
        <h3>Recieved Plasma🥳 🥳 </h3>
    </center>
    <br><br>
    <div class="container-md">
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
    <?php require "footer.php" ?>
</body>

</html>