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
                    <a class="nav-link active" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>



    <div class="text-center mt-5 form">
        Name : <input type="text" name="username" value="<?php echo $username ?>" disabled><br>
        email : <input type="text" name="useremail" value="<?php echo $useremail ?>" disabled><br>
        id : <input type="text" name="userid" value="<?php echo $userid ?> " disabled><br>
        type : <input type="text" name="usertype" value="<?php echo $usertype ?>" disabled><br>
        total Url : <input type="text" name="totalurl" value="<?php echo $totalurl ?>" disabled><br>
    </div>

    <div class="text-center mt-5">
        <p class="font-weight-bolder">Edit Info? <a href="edit.php">Edit</a></p>
    </div>

    <div class="text-center mt-5">
        <p class="font-weight-bolder">Change Password? <a href="password.php">change</a></p>
    </div>

    <div class="text-center mt-5">
        <p class="font-weight-bolder">Delete Account? <a href="delete.php" class="text-danger">DELETE</a></p>
    </div>
</body>

</html>