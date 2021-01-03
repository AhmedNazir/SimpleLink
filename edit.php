<?php
session_start();
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

    <title>Edit</title>
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
                    <a class="nav-link active" href="edit.php">Edit</a>
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
    $shorturl = "";
    if (isset($_GET['link']) && !empty($_GET['link'])) {
        $shorturl = $_GET['link'];

        header("location:includes/edit.code.inc.php?link=$shorturl");
        exit();
    }

    if (isset($_GET['error']) && $_GET['error'] == "urlnotexists") {
        echo '
            <div class="alert alert-danger text-center" role="alert">
            URL Not Exists
            </div>
            ';
    }

    ?>


    <form action="includes/edit.code.inc.php" method="GET" class="text-center mt-5">
        <input type="text" name="link" placeholder="custom path">
        <button type="submit">Edit</button>
    </form>
</body>

</html>