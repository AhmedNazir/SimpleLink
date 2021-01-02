<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("location:..\index.php");
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

    <title>Account</title>

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
                    <a class="nav-link active" href="dashboard.php">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../admin/dashboard.php">Admin</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../edit.php">Edit</a>
                </li>

            </ul>
        </div>
    </nav>

    <div class=" text-center mt-5">
        <form action="includes/user.info.php" method="POST">
            <input type="text" name="userid" placeholder="User ID/Email">
            <button type="submit" name="submit" value="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
        </form>
    </div>



    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Full Name</th>
                <th scope="col">UID</th>
                <th scope="col">Total URL</th>
                <th scope="col">Info</th>
                <th scope="col">Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $page = 0;
            if (isset($_GET["page"])) {
                $page = (int) $_GET["page"];
            }

            $userid = $_SESSION["userid"];
            $query = "SELECT * FROM users WHERE usertype = 'user';";

            $result = mysqli_query($conn, $query);
            $row = mysqli_num_rows($result);

            $i = 0;
            for (; $i < $page * 10; $i++) {
                $entity = mysqli_fetch_assoc($result);
            }

            $ii = ++$i;
            while (($entity = mysqli_fetch_assoc($result)) && ($i < $ii + 10)) {
                echo '
                <tr>
                    <th scope="row">' . $i . '</th>
                    <td>' . $entity['username'] . '</td>
                    <td>' . $entity['userid'] . '</td>
                    <td>' . $entity['totalurl'] . '</td>
                    <td>
                        <form action="includes/account.info.inc.php" method="POST">
                            <input type="hidden" name="shorturl" value="' . $entity['userid'] . '">
                            <input type="hidden" name="page" value="' . $page . '">
                            <button type="submit" name="submit" value="submit" class="btn btn-success"><i class="fas fa-info"></i></button>
                        </form>
                    </td>
                    <td>
                        <form action="includes/account.delete.inc.php" method="POST">
                            <input type="hidden" name="shorturl" value="' . $entity['userid'] . '">
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
            <b><a href="dashboard.php?page=' . $i . '">[' . $i . ']</a> </b>
            ';
    }

    ?>
</body>

</html>