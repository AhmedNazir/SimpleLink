<?php

session_start();
if (!isset($_SESSION["userid"])) {
    header("location:../index.php");
    exit();
}

require_once "includes/profile.inc.php";

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
    <title>Edit Profile</title>
</head>

<body>

    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" id="header">
        <div class="container-fluid">

            <a class="navbar-brand mr-auto" href="..\index.php">
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

        if ($_GET['error'] == "invaliduserid") {
            echo "
        <div class='alert alert-danger text-center' role='alert'> UserID should be only alphabet and number!!! </div>";
        }

        if ($_GET['error'] == "invalidemail") {
            echo "
        <div class='alert alert-danger text-center' role='alert'>Invalid EMail Address !!! </div>";
        }

        if ($_GET['error'] == "useridexist") {
            echo "
        <div class='alert alert-danger text-center' role='alert'>Already User exists </div>";
        }

        if ($_GET['error'] == "useremailexists") {
            echo "
        <div class='alert alert-danger text-center' role='alert'>Already Email exists </div>";
        }

        if ($_GET['error'] == "stmterror") {
            echo "
        <div class='alert alert-danger text-center' role='alert'>SQL Error !!! </div>";
        }
    }
    ?>

    <form action="includes/edit.inc.php" class="mt-5" method="post" style="width: 50%; margin:auto;">
        <div class="form-group row mt-3">
            <label for="username" class="col-sm-3 col-form-label">Full Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="username" name="username" placeholder="Full Name" value="<?php echo $username ?>">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="useremail" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="useremail" name="useremail" placeholder="Email" value="<?php echo $useremail ?>">
            </div>
        </div>


        <div class="form-group row mt-3">
            <label for="userid" class="col-sm-3 col-form-label">UserID</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="userid" name="userid" placeholder="userid" value="<?php echo $userid ?>">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="usertype" class="col-sm-3 col-form-label">User Type</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="usertype" name="usertype" placeholder="usertype" value="<?php echo $usertype ?>" disabled>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="totalurl" class="col-sm-3 col-form-label">Total Url </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="totalurl" name="totalurl" placeholder="totalurl" value="<?php echo $totalurl ?>" disabled>
            </div>
        </div>
        <div class="form-group row mt-3">
            <button type="submit" name="submit" value="submit" class="btn btn-success mt-3">EDIT</button>
        </div>
    </form>

</body>

</html>