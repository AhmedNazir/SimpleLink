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

    <title>URL Shortener</title>

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
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
    if (!empty($message)) {
        if ($message == "Welcome") {
            echo '<div class="alert alert-success text-center" role="alert">' . $message . '</div>';
        } else {
            echo '<div class="alert alert-danger text-center" role="alert">' . $message . '</div>';
        }
    }
    ?>
    <!-- <div class="alert alert-danger text-center" role="alert" <?php $flag ?>>
        <?php //$message 
        ?>
    </div> -->


    <!-- Form
    <form action="" method="post">

        <div class="container mt-5 w-90 pl-3 pr-3">
            <div class="row mb-5">
                <label for="longurl" class="col-md-3 pl-0">Long URL</label>
                <input type="text" id="longurl" oninput="validSubmit()" name="link" value="' . $url . '" class="col-md-7 col-8">-->
    <!-- 
                <div class="col-md-7 col-8  pl-0">
                    <input type="text" class="form-control" id="longurl" oninput="validSubmit()" name="link" value="<?php echo $url ?>" placeholder="Long URL">
                </div>
                <button type="submit" id="create" name="create" value="submit" class="col-md-2 col-4 btn btn-primary" disabled>Create</button>
            </div>

            <div class="row mb-3">
                <input type="text" placeholder="Optional" class="input-group-text text-center" readonly>
            </div>

            <div class="row form-row">
                <label for="custom" class="col-md-3 pl-0">Custom Alias</label>
                <input type="text" class="col-md-4 col-6 input-group-text" value="<?php echo $website ?>" readonly> -->
    <!--<p class="col-md-4 col-4"><mark>' . $website . '</mark></p>-->
    <!-- 
                <div class="col-md-5 col-6  pl-0">
                    <input type="text" class="form-control" id="shorturl" name="custom" oninput="validCustomURL()" value="<?php echo $shorted ?>" placeholder="Custom Alias">
                </div>
            </div>

            <div class="row">
                <label for="creator" class="col-md-3 pl-0 ">Creator</label>
                <input type="text" id="creator" name="creator" placeholder="Creator name" oninput="validCreator()" value="<?php echo $creator ?>" class="col-md-9">
            </div>

            <div class="row">
                <label for="edit" class="col-md-3 pl-0">Edit Code</label>
                <input type="text" id="edit" name="edit" placeholder="Edit code" value="<?php echo $edit ?>" class="col-md-9">
            </div> -->

    <!-- <div class="row">
                <label for="edit" class="col-md-3 pl-0">expire</label>
                <input type="date" id="expire" name="expire" placeholder="expire" class="col-md-9">
            </div> -->

    <!-- <div class="row mt-4">
                <div>
                    <input type="checkbox" id="forcePreview" value="1" name="isPreview">
                    <label for="forcePreview">Force Preview</label>
                </div>
            </div>

            <div class="row">
                <div>
                    <input type="checkbox" id="forceCapcha" value="1" name="isCapcha">
                    <label for="forceCapcha">Force Capcha</label>
                </div>
            </div>


            <div class="row">
                <div>
                    <input type="checkbox" id="forcePassCode" value="1" onclick="passcodeBox()" name="isPassCode">
                    <label for="forcePassword">Force Password</label>
                    <input type="text" id="passbox" oninput="validPassCode()" name="passcode" disabled class="col-6 ">
                </div>
            </div>

        </div>

    </form> -->



    <form action="" method="POST" class="mt-5" style="width: 70%; margin:auto;">
        <div class="container mt-5 w-90 pl-3 pr-3">
            <div class="row mb-5">
                <label for="longurl" class="col-md-3 pl-0">Long URL</label>

                <div class="col-md-7 col-8  pl-0">
                    <input type="text" class="form-control" id="longurl" oninput="validSubmit()" name="link" value="<?php echo $url ?>" placeholder="Long URL">
                </div>
                <button type="submit" id="create" name="create" value="submit" class="col-md-2 col-4 btn btn-primary" disabled>Create</button>
            </div>

            <div class="row mb-3">
                <input type="text" placeholder="Optional" class="form-control text-center" readonly>
            </div>

            <div class="row form-row">
                <label for="custom" class="col-md-3 pl-0">Custom Alias</label>
                <input type="text" class="col-md-4 col-4 input-group-text" value="<?php echo $website ?>" readonly>

                <div class="col-md-5 col-6  pl-0">
                    <input type="text" class="form-control" id="shorturl" name="custom" oninput="validCustomURL()" value="<?php echo $shorted ?>" placeholder="Custom Alias">
                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="creator" class="col-sm-5 col-form-label">Creator</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="creator" name="creator" oninput="validCreator()" value="<?php echo $creator ?>" placeholder="creator">
                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="edit" class="col-sm-5 col-form-label">Edit</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="edit" name="edit" value="<?php echo $edit ?>" placeholder="creator">
                </div>
            </div>


            <div class="form-group row mt-3">
                <label for="submission" class="col-sm-5 col-form-label">Submission</label>
                <div class="col-sm-7">
                    <input type="date" class="form-control" id="submission" name="submission" value="<?php echo $submission ?>" placeholder="submission" disabled>
                </div>
            </div>

            <!-- <div class="form-group row mt-3">
            <label for="expire" class="col-sm-5 col-form-label">Expire</label>
            <div class="col-sm-7">
                <input type="date" class="form-control" id="expire" name="expire" value="<?php //echo $data['expire'] 
                                                                                            ?>" placeholder="expire" disabled>
            </div>
        </div> -->


            <div class="mt-3 form-check form-check-inline">
                <input type="checkbox" class="form-check-input" id="preview" value="1" name="isPreview" <?php echo $preview  ? 'checked' : '' ?>>
                <label class="form-check-label" for="preview" checked>Force Preview</label>
            </div>


            <div class="mt-3 form-check form-check-inline">
                <input type="checkbox" class="form-check-input" id="capcha" value="1" name="isCapcha" <?php echo $capcha ? 'checked' : '' ?>>
                <label class="form-check-label" for="capcha">Force Capcha</label>
            </div>

            <div class="mt-3 form-check form-check-inline">
                <input type="checkbox" class="form-check-input" id="forcePassCode" value="1" name="isPassCode" onclick="passcodeBox()">
                <label for="forcePassword" class="form-check-label">Force Password</label>
                <input type="text" id="passbox" oninput="validPassCode()" name="passcode" disabled class="col-6 ">
            </div>

            
    </form>


</body>

<!-- JS Vendors -->
<!-- JavaScript Bundle with Popper.js -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
<script src="resources\js\main.js"></script>

</html>