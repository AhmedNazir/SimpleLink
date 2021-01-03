<?php
session_start();

require_once 'includes/db.inc.php';
require_once 'includes/functions.db.inc.php';
?>

<?php
$longurl = '';
$shorturl = '';
$custom = '';
$creator = '';
$preview = '';
$capcha = '';
$time = '';
$click = '';
$hiddenvisit = '';
$passcode = 0;
$password = "Not Applicable";
$message = 'Preview';
$flag = 'hidden';
$edit = 'Hidden';

// redirect to longurl url...
if (!empty($_GET['link'])) {

    $link = strtolower($_GET['link']);

    $query = "SELECT * FROM urls WHERE shorturl =  '$link'";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) != 0) {

        $arr = mysqli_fetch_assoc($result);

        $longurl = $arr['longurl'];
        $custom = $arr['shorturl'];
        $shorturl = $website . $custom;
        $creator = $arr['creator'];
        $preview = $arr['preview'];
        $capcha = $arr['capcha'];
        $time = $arr['submission'];
        $click = $arr['click'];
        $expire = $arr['expire'];
        if ($arr['passcode']) {
            $passcode = 1;
            $longurl = "Hidden";
            $password = "Hidden";
        } else
            $passcode = 0;


        if (isset($_SESSION['wildcard']) && $_SESSION['wildcard'] == $link) {
            $_SESSION['wildcard'] = '';
            $edit = $arr['edit'];
            if ($arr['passcode'])
                $password = $arr['passcode'];
        }

        // $_SESSION['capcha'] = "";
    } else {
        $flag = "";
        $message = 'Link does not exit';
        $custom = $_GET['link'];
        // $shorturl = $website."preview.php?link=".$custom;
        // $shorturl = $website . $_GET['link'];
    }
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

    <title>Preview</title>
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



    <!-- Form -->
    <div class="form-box">


        <div class="row mb-0">
            <label for="shorturl" class="col-md-2 pl-0">Short URL</label>
            <input type="text" id="shorturl" name="shorturl" placeholder="Short URL" value="<?php echo $website ?>index.php?link=<?php echo $custom ?>" class="col-md-6">
            <button class="btn btn-success col-md-2 col-4" id="shorturl-copy" onclick="copyToClickboard()">Copy</button>

            <!-- <form action="" method="POST" class="form-inline">
                <input type="hidden" name="shorturl" value="<?php //echo $shorturl 
                                                            ?>">
                <button name="submit" value="submit" class="btn btn-primary col-md-3 col-8">Reveal Long URL</button>
            </form> -->

            <a class="btn btn-primary col-md-2 col-7" id="shorturl-btn" onclick="validPreview()">Reveal Long URL</a>

        </div>
        <div class="alert alert-danger text-center" role="alert" <?php echo $flag; ?>>
            <?php echo $message; ?>
        </div>

        <div class="row mb-5 mt-5">
            <label for="longurl" class="col-md-2 pl-0">Long URL</label>
            <input type="text" id="longurl" name="link" value="<?php echo $longurl ?>" class="col-md-8 col-8">
            <a class="col-md-2 col-4 btn btn-primary" href="<?php echo $longurl == "Hidden" ? $shorturl : $longurl ?>">Visit</a>
        </div>

        <div class="input-group mb-3">
            <label for="custom" class="col-md-2 pl-0">Custom Alias</label>
            <input type="text" class="col-md-5 col-8 input-group-text" id="website" value="<?php echo $website; ?>" readonly>
            <input type="text" id="custom" name="custom" value="<?php echo $custom ?>" placeholder="Custom Alias" class="col-md-5 col-4">
        </div>


        <div class="row mb-3">
            <label for="creator" class="col-sm-2 col-form-label">Creator</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="creator" name="creator" placeholder="Creator name" value="<?php echo $creator ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="creator" class="col-sm-2 col-form-label">Submission</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="time" name="time" placeholder="Time" value="<?php echo $time ?>" readonly>
            </div>
        </div>

        <!-- <div class="row mb-3">
            <label for="creator" class="col-sm-2 col-form-label">Expire</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="expire" name="expire" placeholder="Unlimited" value="<?php //echo $expire 
                                                                                                                    ?>" readonly>
            </div>
        </div> -->

        <div class="row mb-3">
            <label for="creator" class="col-sm-2 col-form-label">Total Click</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="click" name="click" placeholder="Total click" value="<?php echo $click ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="creator" class="col-sm-2 col-form-label">Edit Code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit" name="click" placeholder="Edit Code" value="<?php echo $edit ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="creator" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="passcode" name="click" placeholder="Password" value="<?php echo $password ?>" readonly>
            </div>
        </div>

        <div class="mb-3 form-check form-check-inline">
            <input type="checkbox" class="form-check-input" id="forcePreview" value="1" name="isPreview" <?php echo $preview ? 'checked' : '' ?> readonly>
            <label class="form-check-label" for="forcePreview" checked>Force Preview</label>
        </div>


        <div class="mb-3 form-check form-check-inline">
            <input type="checkbox" class="form-check-input" id="forceCapcha" value="1" name="isCapcha" <?php echo $capcha ? 'checked' : '' ?> readonly>
            <label class="form-check-label" for="forceCapcha">Force Capcha</label>
        </div>

        <div class="mb-3 form-check form-check-inline">
            <input type="checkbox" class="form-check-input" id="isPassCode" value="1" name="isPassCode" <?php echo $passcode ? 'checked' : '' ?> readonly>
            <label class="form-check-label" for="isPassCode">Password</label>
        </div>

    </div>

</body>

<!-- JS Vendors -->
<!-- JavaScript Bundle with Popper.js -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
<script src="resources\js\main.js"></script>


</html>


<?php
mysqli_close($conn);
?>