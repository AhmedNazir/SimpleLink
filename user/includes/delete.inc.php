<?php
session_start();

if (isset($_POST['submit'])) {

    require_once "../../includes/db.inc.php";

    $userid = $_POST['userid'];
    $userpassword = $_POST['userpassword'];

    if ($_SESSION['usertype'] == "admin") {
        header("location:../delete.php?error=admincannotdelete");
        exit();
    }

    if (empty($userid) || empty($userpassword)) {
        header("location:../delete.php?error=emptyinput");
        exit();
    }

    if ($userid != $_SESSION['userid']) {
        header("location:../delete.php?error=useridnotmatch");
        exit();
    }

    if (!password_verify($userpassword, $_SESSION['userpassword'])) {
        header("location:../delete.php?error=pwdnotmatch");
        exit();
    }

    $query = "DELETE FROM users WHERE userid = ?;";
    $stmt= mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$query)){
        header("location:../delete.php?error=stmterror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, 's', $userid);

    if(mysqli_stmt_execute($stmt)){
        session_unset();
        session_destroy();
        
        header("location:../../index.php");
        exit();
    } else {
        header("location:../delete.php?error=sqlerror");
        exit();
    }

} else {
    header("location:../profile.php");
    exit();
}
