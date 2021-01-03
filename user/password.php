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
    <title>Password</title>
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
        if ($_GET['error'] == "emptyinput") {
            echo "
                <div class='alert alert-danger text-center' role='alert'> Fill in all field !!! </div>";
        }

        if ($_GET['error'] == "oldnotmatch") {
            echo "
                <div class='alert alert-danger text-center' role='alert'> Old Password is incorrect!!!  </div>";
        }

        if ($_GET['error'] == "newpwdnotmatch") {
            echo "
                <div class='alert alert-danger text-center' role='alert'>Password does not match!!! </div>";
        }

        if ($_GET['error'] == "prepareerror") {
            echo "
                <div class='alert alert-danger text-center' role='alert'>Prepare Error !!! </div>";
        }

        if ($_GET['error'] == "sqlerror") {
            echo "
                <div class='alert alert-danger text-center' role='alert'>SQL Error !!! </div>";
        }
    }

    ?>

    <form action="includes/password.inc.php" method="POST" class="mt-5" style="width: 500px; margin:auto;">
        <div class="form-group row mt-3">
            <label for="oldpwd" class="col-sm-5 col-form-label">Old Password</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" id="oldpwd" name="oldpwd" placeholder="Old Password">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="newpwd" class="col-sm-5 col-form-label">New Password</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" id="newpwd" name="newpwd" placeholder="New Password">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="repeatnewpwd" class="col-sm-5 col-form-label">Repeat New Password</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" id="repeatnewpwd" name="repeatnewpwd" placeholder="Repeat New Password">
            </div>
        </div>

        <div class="form-group row mt-3">
            <button type="submit" name="submit" value="submit" class="btn btn-primary mt-3">Change</button>
        </div>

    </form>

</body>

</html>