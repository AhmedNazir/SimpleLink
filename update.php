<?php
session_start();

if (!isset($_POST['submit'])) {
    header("location:edit.php");
    exit();
}

if (empty($_POST['givencode'])) {
    header("location:edit.php?link={$_POST['shorturl']}");
    exit();
}



require_once "includes/db.inc.php";

if ($_POST['actualcode'] != $_POST['givencode']) {
    header("location:includes/edit.code.inc.php?link={$_POST['shorturl']}&error=wrongcode");
    exit();
}


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
    <link rel="stylesheet" href="resources\css\style.css">
    <link rel="stylesheet" href="resources\css\responsive.css">

    <title>Info</title>
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
                    <a class="nav-link " href="edit.php">Edit</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="\includes\edit.code.inc.php">Edit Code</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="\includes\edit.info.inc.php">Info</a>
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

    <form action="includes/edit.update.inc.php" method="POST" class="mt-5 mb-5" style="width: 70%; margin:auto;">
        <div class="form-group row mt-3 mb-5">
            <label for="oldpwd" class="col-sm-5 col-form-label">Custom Alias</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" value="<?php echo $data['shorturl'] ?>" disabled>
            </div>
        </div>

        <input type="hidden" name="shorturl" value="<?php echo $data['shorturl'] ?>">


        <div class="form-group row mt-3">
            <label for="longurl" class="col-sm-5 col-form-label">Destination</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="longurl" name="longurl" value="<?php echo $data['longurl'] ?>" placeholder="Destination">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="userid" class="col-sm-5 col-form-label">UserID</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="userid" name="userid" value="<?php echo $data['userid'] ?>" placeholder="UserID" disabled>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="creator" class="col-sm-5 col-form-label">Creator</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="creator" name="creator" value="<?php echo $data['creator'] ?>" placeholder="creator">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="edit" class="col-sm-5 col-form-label">Edit</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="edit" name="edit" value="<?php echo $data['edit'] ?>" placeholder="creator">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="edit" class="col-sm-5 col-form-label">password</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="passcode" name="passcode" value="<?php echo $data['passcode'] ?>" placeholder="password">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="submission" class="col-sm-5 col-form-label">Submission</label>
            <div class="col-sm-7">
                <input type="date" class="form-control" id="submission" name="submission" value="<?php echo $data['submission'] ?>" placeholder="submission" disabled>
            </div>
        </div>

        <!-- <div class="form-group row mt-3">
            <label for="expire" class="col-sm-5 col-form-label">Expire</label>
            <div class="col-sm-7">
                <input type="date" class="form-control" id="expire" name="expire" value="<?php //echo $data['expire'] 
                                                                                            ?>" placeholder="expire" disabled>
            </div>
        </div> -->


        <div class="form-group row mt-3">
            <label for="click" class="col-sm-5 col-form-label">total Click</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="click" name="click" value="<?php echo $data['click'] ?>" placeholder="click" disabled>
            </div>
        </div>


        <div class="mt-3 form-check form-check-inline">
            <input type="checkbox" class="form-check-input" id="preview" value="1" name="preview" <?php echo $data['preview']  ? 'checked' : '' ?>>
            <label class="form-check-label" for="preview" checked>Force Preview</label>
        </div>


        <div class="mt-3 form-check form-check-inline">
            <input type="checkbox" class="form-check-input" id="capcha" value="1" name="capcha" <?php echo $data['capcha'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="capcha">Force Capcha</label>
        </div>


        <div class="form-group row mt-3">
            <button type="submit" name="submit" value="submit" class="btn btn-primary mt-3">Change</button>
        </div>

    </form>

</body>

<!-- JS Vendors -->
<!-- JavaScript Bundle with Popper.js -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
<script src="resources\js\main.js"></script>


</html>