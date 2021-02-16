<!DOCTYPE html>
<html>
<!-- font-family: "Roboto", sans-serif; -->

<head>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    header {
        width: 100%;
        height: 12vh;
        background: rgb(204, 247, 255);
        padding: 0 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 1.5rem;

        font-weight: bold;
    }

    header img {
        height: 12vh;
    }

    nav {
        width: 100%;
        height: 7vh;
        background: rgb(190, 193, 194);
        background: rgb(52, 54, 64);
    }

    nav a {
        text-decoration: none;
        color: white;
    }

    ul {
        list-style-type: none;
    }

    ul li {
        background: rgb(148, 152, 153);
        background: rgb(52, 54, 64);
        font-size: 1.1rem;
        width: 10vw;
        border: 1px solid white;
        height: 7vh;
        line-height: 7vh;
        text-align: center;
        float: left;
        color: white;
        position: relative;
    }

    ul li:hover {
        background: rgb(93, 96, 97);
    }

    ul ul {
        display: none;
    }

    ul li:hover>ul {
        display: block;
    }
    </style>
</head>

<body>

    <header>
        <img src="./Images/LOGO1.png">
        <h2>I-PLASMA</h2>

        <?php 
        if(isset($_SESSION['MloggedIn'])){
            if( $_SESSION['MloggedIn']==true){
                echo"<h4>".$_SESSION['username']."</h4>";
            }
        }
        ?>

    </header>
    <nav>
        <ul id="navigation">
            <a href="./Plasma.php">
                <li>Home</li>
            </a>
            <li>Patient
                <ul>
                    <a href="./Patient_register.php">
                        <li> Register </li>
                    </a>
                    <a href="./Patient_request.php">
                        <li> Request </li>
                    </a>
                </ul>
            </li>
            <li>Volunteer
                <ul>
                    <a href="./instructions.php">
                        <li> Register </li>
                    </a>
                    <a href="./view_donors.php">
                        <li>Shoutout</li>
                    </a>
                </ul>
            </li>
            <li>Info
                <ul>
                    <a href="./view_banks.php">
                        <li> Centre Details </li>
                    </a>
                    <a href="./view_plasma_recieved.php">
                        <li>Plasma Recieved</li>
                    </a>
                    <a href="./view_request.php">
                        <li> Pendings </li>
                    </a>
                </ul>
            </li>
            <li>Admin
                <ul>

                    <?php
                        if(isset($_SESSION['MloggedIn'])){
                            if($_SESSION['MloggedIn']){
                                echo"
                                    <a href='./patient_verify.php'><li> Verify Patient </li></a>
                                    <a href='./user_verify.php'><li> Verify Volunteer </li></a>
                                    <a href='./transfer.php'><li> Transfer Update </li></a>
                                    <a href='./logout.php'><li> Logout </li></a>";
                            }
                        }
                        else{
                            echo" <a href='./Bank_login.php'><li> Login </li></a>";
                        }
                        ?>
                </ul>
            </li>
        </ul>
    </nav>


</body>

</html>