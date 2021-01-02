<?php
session_start();

if (!isset($_POST['submit'])) {
    header("location:dashboard.php");
    exit();
}


require_once "../includes/db.inc.php";

$shorturl = $_POST['shorturl'];
$query = "SELECT * FROM urls WHERE shorturl = '$shorturl';";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$_SESSION['edit'][$data['shorturl']] = $data;

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

    <title>Info</title>
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
                    <a class="nav-link active" href="../preview">Preview</a>
                </li>

                <?php
                if (isset($_SESSION['userid'])) {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="ashboard.php">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href=/profile.php">' . $_SESSION["username"] . '</a>
                    </li>
                    ';
                } else {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Signup</a>
                    </li>
                    ';
                }
                ?>
            </ul>
        </div>
    </nav>

    <form action="includes/url.update.inc.php" method="post" class="text-center mt-5">
        Custom Alias :<input type="text" value="<?php echo $data['shorturl'] ?>" disabled><br>
        <input type="hidden" name="shorturl" value="<?php echo $data['shorturl'] ?>"><br>

        Destination : <input type="text" name="longurl" value="<?php echo $data['longurl'] ?>"><br>
        UserID : <input type="text" name="userid" value="<?php echo $data['userid'] ?>" disabled><br>
        Creator : <input type="text" name="creator" value="<?php echo $data['creator'] ?>"><br>
        Edit Code : <input type="text" name="edit" value="<?php echo $data['edit'] ?>"><br>
        Preview : <input type="checkbox" name="preview" value="1" <?php echo $data['preview'] ? 'checked' : '' ?>><br>
        Capcha : <input type="checkbox" name="capcha" value="1" <?php echo $data['capcha'] ? 'checked' : '' ?>><br>
        Password : <input type="text" name="passcode" value="<?php echo $data['passcode'] ?>"><br>
        Submission : <input type="date" name="submission" value="<?php echo $data['submission'] ?>" disabled><br>
        Total Click : <input type="number" name="click" value="<?php echo $data['click'] ?>" disabled><br>
        <!-- Expire : <input type="date" name="expire" value="<?php //echo $data['expire']?>"><br> -->
        <button type="submit" name="submit" value="submit" class="btn btn-primary">UPDATE</button>
    </form>


</body>

<!-- JS Vendors -->
<!-- JavaScript Bundle with Popper.js -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
<script src="resources\js\main.js"></script>


</html>