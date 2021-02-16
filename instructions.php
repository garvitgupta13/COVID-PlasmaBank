<?php
session_start();
?>
<html>

<head>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(to bottom, rgb(220, 238, 255), rgb(114, 210, 255));
        font-family: "Roboto", sans-serif;
    }

    h3 {
        font-size: 2.5rem;
        text-align: center;
        padding: 1.5rem;
    }

    section {
        width: 100%;
        height: 75vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    section>div {
        width: 90vw;
        height: 70vh;
        background: rgba(255, 255, 255, 0.4);
    }

    section>div:hover {
        background: rgba(255, 255, 255, 0.6);
    }

    h4 {
        font-size: 1.6rem;
        text-align: center;
        padding: 1rem;
    }

    .container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        justify-content: space-between;
    }

    .container>div {
        font-size: 1.3rem;
        margin: 0.7rem;
        padding: 1rem;
    }

    /*.checkbox{
        margin-left: 4rem;
    }*/
    button {
        font-size: 1rem;
        padding: 0.3rem 0.8rem;
        margin: 1rem 4rem;
        cursor: pointer;

    }
    </style>
    <title>Instructions</title>
</head>

<body>
    <?php require "header.php" ?>
    <h3>Instructions</h3>
    <section>
        <div>
            <h4>Eligibility criteria for donor - </h4>
            <div class="container">
                <div>1. A COVID Positive patient in past.</div>
                <div>2. Now negative after infection.</div>
                <div>3. Cured for 14 days.</div>
                <div>4. Healthy and feeling excited to donate plasma.</div>
                <div>5. Between 18-60 years of age.</div>
            </div>
        </div>
    </section>
    <section>
        <div>
            <h4>Donor ineligible for convalescent plasma donation - </h4>
            <div class="container">
                <div>1. Weight less than 50 kg.</div>
                <div>2. Females who have ever been pregnant</div>
                <div>3. Diabetic on insulin</div>
                <div>4. B.P more than 140 and diastolic less than 60 or more than 90</div>
                <div>5. Uncontrolled diabetes or hypertension with change in medication in last 28 days</div>
                <div>6. Cancer Survivor</div>
                <div>7. Chronic kidney/heart/lung or liver disease.</div>
            </div>
        </div>
    </section>

    <!--<div class="checkbox">
        <input type="checkbox" id="exampleCheck1" required>
        <label for="exampleCheck1">I satisfy the above requirements to be donor</label>
    </div><br>-->

    <a href="./Donor_Register.php"><button>Register Now</button></a>
    <?php require "footer.php" ?>
</body>

</html>