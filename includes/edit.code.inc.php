<?php
if (!isset($_GET['link'])) {
    header("location:../edit.php");
    exit();
}

session_start();
require_once "db.inc.php";

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

    <title>Edit Code</title>
</head>


<body>


    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" id="header">
        <div class="container-fluid">

            <a class="navbar-brand mr-auto" href="index.php">
                <img src="../resources\img\logo.svg" alt="" width="30" height="24" class="d-inline-block align-top">
                URL Shortener
            </a>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="..\index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="..\preview.php">Preview</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="..\edit.php">Edit</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="..includes\edit.code.inc.php">Edit Code</a>
                </li>

                <?php
                if (isset($_SESSION['userid'])) {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="../user/dashboard.php">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../user/profile.php">' . $_SESSION["username"] . '</a>
                    </li>
                    ';
                } else {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="../user/login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../user/signup.php">Signup</a>
                    </li>
                    ';
                }
                ?>
            </ul>
        </div>
    </nav>

    <?php

    if (!empty($_GET['link'])) {
        $shorturl = $_GET['link'];
        $query = "SELECT * FROM urls WHERE shorturl = '$shorturl';";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result)) {
            $data = mysqli_fetch_assoc($result);


            // echo "<pre>";
            // print_r($_SESSION);
            // print_r($data);
            // echo "</pre>";

            $editcode = "";
            $actualcode = $data['edit'];
            if (isset($_SESSION['userid']) && $data['userid'] == $_SESSION['userid']) {
                $editcode = $data['edit'];
                // $_SESSION['edit'][$shorturl] = $data;

                // header("location:edit.info.inc.php");
                // exit();

            }

            echo '
        <form action="edit.info.inc.php" method="POST" class="text-center mt-5">
        <input type="hidden" name="shorturl" value="' . $shorturl . '">
        <input type="hidden" name="actualcode" value="' . $actualcode . '">
        <input type="password" name="givencode" value="' . $editcode . '">
        <button type="submit" name="submit" value="submit">Code</button>
        </form>
        ';
        } else {
            header("location:../edit.php?error=urlnotexists");
            exit();
        }
    } else {
        header("location:../edit.php?error=urlnotexists");
        exit();
    }
