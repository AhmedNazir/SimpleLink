<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("location:../index.php");
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
    <title>Delete Profile</title>
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
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <?php

    if (isset($_GET['error'])) {

        if ($_GET['error'] == "admincannotdelete") {
            echo "
    <div class='alert alert-danger text-center' role='alert'> Admin can not delete !!! </div>";
        }

        if ($_GET['error'] == "emptyinput") {
            echo "
    <div class='alert alert-danger text-center' role='alert'> Fill in all field !!! </div>";
        }

        if ($_GET['error'] == "useridnotmatch") {
            echo "
    <div class='alert alert-danger text-center' role='alert'> UserID does not exists!!! </div>";
        }

        if ($_GET['error'] == "pwdnotmatch") {
            echo "
    <div class='alert alert-danger text-center' role='alert'>Password does not match !!! </div>";
        }

        if ($_GET['error'] == "stmterror") {
            echo "
    <div class='alert alert-danger text-center' role='alert'>STMT Error !!! </div>";
        }

        if ($_GET['error'] == "sqlerror") {
            echo "
    <div class='alert alert-danger text-center' role='alert'>SQL Error !!! </div>";
        }
    }
    ?>

    
    <form action="includes/delete.inc.php" method="POST" class="mt-5" style="width: 50%; margin:auto;">
        <div class="form-group row mt-3">
            <label for="userid" class="col-sm-5 col-form-label">User ID</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="userid" name="userid" placeholder="User ID">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="userpassword" class="col-sm-5 col-form-label">Password</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Password">
            </div>
        </div>

        <div class="form-group row mt-3">
            <button type="submit" name="submit" value="submit" class="btn btn-danger mt-3">Delete</button>
        </div>

    </form>

</body>

</html>