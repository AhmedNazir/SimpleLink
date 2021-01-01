<?php
session_start();


if (isset($_POST['submit'])) {

    require_once "../../includes/db.inc.php";
    require_once "functions.signup.inc.php";

    $username = $_POST['username'];
    $userid = $_POST['userid'];
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];
    $repeatpassword = $_POST['repeatpassword'];



    if (isEmptyInput($username, $useremail, $userid, $userpassword, $repeatpassword)) {
        header("location:../signup.php?error=emptyinput");
        exit();
    }

    if (invalidUserid($userid)) {
        header("location:../signup.php?error=invaliduserid");
        exit();
    }

    if (invalidUseremail($useremail)) {
        header("location:../signup.php?error=invalidemail");
        exit();
    }

    if (invalidPassword($userpassword, $repeatpassword)) {
        header("location:../signup.php?error=passwordnotmatch");
        exit();
    }

    if (useridExist($conn, $userid, $useremail)) {
        header("location:../signup.php?error=useridexist");
        exit();
    }

    createAccount($conn, $username, $useremail, $userid, $userpassword);
} else {
    header("location:../signup.php");
    exit();
}
