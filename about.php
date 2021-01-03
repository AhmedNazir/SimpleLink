<?php
session_start();
require_once "includes/db.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- vendor -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="resources\img\favicon.png" />
    <!-- Resources -->
    <link rel="stylesheet" href="resources\css\style.css">
    <link rel="stylesheet" href="resources\css\responsive.css">

    <title>Stats</title>
</head>


<body>


    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" id="header">
        <div class="container-fluid">

            <a class="navbar-brand mr-auto" href="index.php">
                <img src="resources\img\logo.svg" alt="" width="30" height="24" class="d-inline-block align-top">
                URL Shortener
            </a>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="preview.php">Preview</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="edit.php">Edit</a>
                </li>


                <?php
                if (isset($_SESSION['userid'])) {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="user/dashboard.php">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="user/profile.php">' . $_SESSION["username"] . '</a>
                    </li>
                    ';
                } else {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="user/login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="user/signup.php">Signup</a>
                    </li>
                    ';
                }

                ?>
            </ul>
        </div>
    </nav>


    <?php
    $query = "SELECT * FROM users WHERE 1;";

    $result = mysqli_query($conn, $query);
    $users = mysqli_num_rows($result);


    $query = "SELECT * FROM urls WHERE 1;";

    $result = mysqli_query($conn, $query);
    $urls = mysqli_num_rows($result);

    ?>

    <div class="row text-center mt-5">
        <div class="card text-white bg-info mb-3 ml-3" style="max-width: 18rem;">
            <div class="card-header">Total Users</div>
            <div class="card-body">
                <h5 class="card-title text-danger"><?php echo $users ?></h5>
                <p class="card-text">Number of users is growing..</p>
            </div>
        </div>
        <div class="card text-white bg-info mb-3 ml-3" style="max-width: 18rem;">
            <div class="card-header">Total URLs</div>
            <div class="card-body">
                <h5 class="card-title text-danger"><?php echo $urls ?></h5>
                <p class="card-text">Number of urls is growing..</p>
            </div>
        </div>
</body>

</html>