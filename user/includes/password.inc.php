<?php
session_start();

if (isset($_POST['submit'])) {

    require_once "../../includes/db.inc.php";

    $oldpwd = $_POST['oldpwd'];
    $newpwd = $_POST['newpwd'];
    $repeatnewpwd = $_POST['repeatnewpwd'];

    if (empty($oldpwd) || empty($newpwd) || empty($repeatnewpwd)) {
        header("location:../password.php?error=emptyinput");
        exit();
    }

    if (!password_verify($oldpwd, $_SESSION['userpassword'])) {
        header("location:../password.php?error=oldnotmatch");
        exit();
    }

    if ($newpwd != $repeatnewpwd) {
        header("location:../password.php?error=newpwdnotmatch");
        exit();
    }

    $userid = $_SESSION["userid"];
    $newpwd = password_hash($newpwd, PASSWORD_DEFAULT);

    $query = "UPDATE users SET userpassword = ? WHERE userid = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location:../password.php?error=prepareerror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $newpwd, $userid);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["userpassword"] = $newpwd;
        header("location:../profile.php");
        exit();
    } else {
        header("location:../password.php?error=sqlerror");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("location:../password.php");
    exit();
}
