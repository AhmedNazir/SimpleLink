<?php
session_start();
if (isset($_SESSION["userid"])) {
    header("location:dashboard.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- vendor -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="..\resources\img\favicon.png" />
    <!-- Resources -->
    <link rel="stylesheet" href="..\resources\css\style.css">
    <link rel="stylesheet" href="..\resources\css\responsive.css">

    <title>Sign UP</title>

</head>


<body>


    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" id="header">
        <div class="container-fluid">

            <a class="navbar-brand mr-auto" href="index.php">
                <img src="..\resources\img\logo.svg" alt="" width="30" height="24" class="d-inline-block align-top">
                URL Shortener
            </a>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../preview.php">Preview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="signup.php">Signup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../about.php">About</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid text-center mt-5">
        <?php

        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyinput") {
                echo "
                <div class='alert alert-danger' role='alert'> Fill in all field !!! </div>";
            }

            if ($_GET['error'] == "invaliduserid") {
                echo "
                <div class='alert alert-danger' role='alert'> UserID should be only alphabet and number!!! </div>";
            }

            if ($_GET['error'] == "invalidemail") {
                echo "
                <div class='alert alert-danger' role='alert'>Invalid EMail Address !!! </div>";
            }

            if ($_GET['error'] == "passwordnotmatch") {
                echo "
                <div class='alert alert-danger' role='alert'>Password does not match!!! </div>";
            }

            if ($_GET['error'] == "useridexist") {
                echo "
                <div class='alert alert-danger' role='alert'>Already User exists </div>";
            }


            if ($_GET['error'] == "stmterror") {
                echo "
                <div class='alert alert-danger' role='alert'>SQL Error !!! </div>";
            }

            if ($_GET['error'] == "createfail") {
                echo "
                <div class='alert alert-danger' role='alert'>Account Creation Failed !!! </div>";
            }

            if ($_GET['error'] == "none") {
                echo "
                <div class='alert alert-success' role='alert'>Account Creation Successfull !!! </div>";

                echo '
                <a href="login.php" class="btn btn-success mb-3">Login </a> <br>
                ';
            }
        } else {
            echo "
        <div class='alert alert-success' role='alert'> Welcome to signup page </div>";
        }


        ?>
        <form action="includes/signup.inc.php" method="POST">
            <input type="text" name="username" placeholder="Full Name"><br>
            <input type="text" name="userid" placeholder="User ID"><br>
            <input type="text" name="useremail" placeholder="User Email"><br>
            <input type="password" name="userpassword" placeholder="User Password"><br>
            <input type="password" name="repeatpassword" placeholder="Repeat Password"><br>
            <input type="submit" name="submit" class="btn btn-primary mt-3">
        </form>
    </div>

    <div class="text-center mt-5">
        <p>Already have account?</p>
        <a href="login.php">login</a>
    </div>



</body>

</html>