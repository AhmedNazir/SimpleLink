<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("location:../index.php");
    exit();
}

if ($_SESSION["usertype"] != "admin") {
    header("location:../user/dashboard.php");
    exit();
}

require_once "../includes/db.inc.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- vendor -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" type="image/png" href="..\resources\img\favicon.png" />
    <!-- Resources -->
    <link rel="stylesheet" href="..\resources\css\style.css">
    <link rel="stylesheet" href="..\resources\css\responsive.css">

    <title>URL</title>

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
                    <a class="nav-link " href="dashboard.php">Admin</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="url.php">URL</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link " href="account.php">Account</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="../user/dashboard.php">User Section</a>
                </li>


            </ul>
        </div>
    </nav>


    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "notdeleted") {
            echo "
                <div class='alert alert-danger text-center' role='alert'> Delete Query failed !!! </div>";
        }
    }

    ?>


    <div class=" text-center mt-5">
        <form action="" method="POST">
            <input type="text" name="shorturl" placeholder="Custom Alias">
            <button type="submit" name="submit" value="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
        </form>
    </div>


    <?php
    $page = 0;
    if (isset($_GET["page"])) {
        $page = (int) $_GET["page"];
    }

    $userid = $_SESSION["userid"];

    if (isset($_POST['submit']) && empty($_POST['shorturl']) == false) {
        $shorturl = $_POST['shorturl'];
        $query = "SELECT * FROM urls WHERE shorturl = '$shorturl';";
        $page = 0;
    } else {
        $query = "SELECT * FROM  urls WHERE 1;";
    }

    $result = mysqli_query($conn, $query);
    $row = mysqli_num_rows($result);

    if (!$row) {
        echo '<div class="alert alert-danger text-center" role="alert">No URL Exists</div>';
    }

    $i = 0;
    for (; $i < $page * 10; $i++) {
        $entity = mysqli_fetch_assoc($result);
    }

    ?>


    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Custom Alias</th>
                <th scope="col">UserID</th>
                <th scope="col">Long URL</th>
                <th scope="col">forcePreview</th>
                <th scope="col">forceCapcha</th>
                <th scope="col">Password</th>
                <th scope="col">Submission</th>
                <th scope="col">Total Click</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ii = ++$i;
            while (($entity = mysqli_fetch_assoc($result)) && ($i < $ii + 10)) {
                if ($entity['preview']) {
                    $preview = "Yes";
                } else {
                    $preview = "No";
                }

                if ($entity['capcha']) {
                    $capcha = "Yes";
                } else {
                    $capcha = "No";
                }

                echo '
                <tr>
                    <th scope="row">' . $i . '</th>
                    <td>' . $entity['shorturl'] . '</td>
                    <td>' . $entity['userid'] . '</td>
                    <td><input type="text" value="' . $entity['longurl'] . '">
                    <a href="' . $entity['longurl'] . '" class="btn btn-primary" target="_blank">GO</a>
                    </td>
                    <td>' . $preview . '</td>
                    <td>' . $capcha . '</td>
                    <td>' . $entity['passcode'] . '</td>
                    <td>' . $entity['submission'] . '</td>
                    <td>' . $entity['click'] . '</td>
                    <td>
                        <form action="includes/url.delete.inc.php" method="POST">
                            <input type="hidden" name="shorturl" value="' . $entity['shorturl'] . '">
                            <input type="hidden" name="page" value="' . $page . '">
                            <button type="submit" name="submit" value="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                ';

                $i++;
            }
            ?>

        </tbody>
    </table>




    <?php
    --$row;
    $row /= 10;

    echo "<b>page : </b>";
    for ($i = 0; $i <= $row; $i++) {
        echo '
            <b><a href="url.php?page=' . $i . '">[' . $i . ']</a> </b>
            ';
    }

    ?>
</body>

</html>