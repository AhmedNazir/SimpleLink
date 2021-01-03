<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("location:..\index.php");
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
    <title>Profile</title>
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
                    <a class="nav-link active" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>



    <form class="mt-5" style="width: 500px; margin:auto;">
        <div class="form-group row mt-3">
            <label for="username" class="col-sm-3 col-form-label">Full Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="username" name="username" placeholder="Full Name" value="<?php echo $username ?>" disabled>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="useremail" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="useremail" name="useremail" placeholder="Email" value="<?php echo $useremail ?>" disabled>
            </div>
        </div>


        <div class="form-group row mt-3">
            <label for="userid" class="col-sm-3 col-form-label">UserID</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="userid" name="userid" placeholder="userid" value="<?php echo $userid ?>" disabled>
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
    </form>



    <div class="text-center mt-5">
        <p class="font-weight-bolder">Edit Info? <a href="edit.php">Edit</a></p>
    </div>

    <div class="text-center mt-5">
        <p class="font-weight-bolder">Change Password? <a href="password.php">change</a></p>
    </div>

    <div class="text-center mt-5">
        <p class="font-weight-bolder">Delete Account? <a href="delete.php" class="text-danger">DELETE</a></p>
    </div>
    </form>
</body>

</html>