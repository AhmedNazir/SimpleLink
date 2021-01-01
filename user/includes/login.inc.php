<?php
session_start();

if (isset($_POST['submit'])) {

    require_once "../../includes/db.inc.php";
    require_once "functions.login.inc.php";

    $userid = $_POST['userid'];
    $userpassword = $_POST['userpassword'];

    if (isEmptyInput( $userid, $userpassword)) {
        header("location:../login.php?error=emptyinput");
        exit();
    }

    login($conn, $userid, $userpassword);
} else {
    header("location:../login.php");
    exit();
}
