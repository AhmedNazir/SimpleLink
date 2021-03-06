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

    <title>Log In</title>

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
                    <a class="nav-link active" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="signup.php">Signup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../about.php">About</a>
                </li>
            </ul>
        </div>
    </nav>

    <body>

        <div class="container-fluid text-center mt-5 " style="width: 500px; margin:auto;">
            <?php

            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyinput") {
                    echo "
                <div class='alert alert-danger' role='alert'> Fill in all field !!! </div>";
                }

                if ($_GET['error'] == "usernotexist") {
                    echo "
                <div class='alert alert-danger' role='alert'> User does not exists !!! </div>";
                }

                if ($_GET['error'] == "pwdnotmatch") {
                    echo "
                <div class='alert alert-danger' role='alert'>Password does not match!!! </div>";
                }

                if ($_GET['error'] == "stmterror") {
                    echo "
                <div class='alert alert-danger' role='alert'>SQL Error !!! </div>";
                }
            } else {
                echo "
            <div class='alert alert-success' role='alert'> Welcome to login page </div>";
            }
            ?>

        </div>

        <form action="includes/login.inc.php" method="POST" style="width: 500px; margin:auto;">
            <div class="form-group mt-3">
                <label for="userid">Userid</label>
                <input type="text" class="form-control" id="userid" name="userid" placeholder="Enter userid">
                <small id="useridHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
            </div>
            <div class="form-group mt-3">
                <label for="userpassword">Password</label>
                <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
        </form>


        <div class="text-center mt-5">
            <p>Does not have account?</p>
            <a href="signup.php">signup</a>
        </div>



    </body>

</html>