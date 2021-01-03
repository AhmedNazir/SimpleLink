<?php
session_start();

if (!isset($_SESSION[$_GET['link']])) {
    header("location:index.php?link={$_GET['link']}");
    exit();
}

if (empty($_SESSION[$_GET['link']]['passcode'])) {
    header("location:index.php?link={$_GET['link']}");
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
    <link rel="icon" type="image/png" href="resources\img\favicon.png" />
    <!-- Resources -->
    <link rel="stylesheet" href="resources\css\style.css">
    <link rel="stylesheet" href="resources\css\responsive.css">

    <title>Verify</title>
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
                    <a class="nav-link" href="preview.php">Preview</a>
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


    if (!isset($_POST['passcode']) || $_POST['passcode'] != $_SESSION[$_GET['link']]['passcode']) {

        if (isset($_POST['passcode']) && $_POST['passcode'] != $_SESSION[$_GET['link']]['passcode']) {
            echo '<div class="alert alert-danger text-center" role="alert">Enter Correct Password!!!</div>';
        }

        echo '
        <form action="" method="post" class="text-center mt-5">
            Password : <input type="text" name="passcode" placeholder="password">
            <button type="submit" name="submit" value="submit" class="btn btn-primary" >SUBMIT</button>
        </form>
        ';

    } else {


        $longurl = $_SESSION[$_GET['link']]['longurl'];
        unset($_SESSION[$_GET['link']]);

        header("location:{$longurl}");
        exit();
    }
    ?>

    <br>

</body>



<!-- JS Vendors -->
<!-- JavaScript Bundle with Popper.js -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
<script src="<?php echo $website ?>resources\js\main.js"></script>


</html>