<?php
require_once "../includes/db.inc.php";

if (!isset($_SESSION["userid"])) {
    header("location:profile.php");
    exit();
}

function useridExist($conn, $userid, $useremail)
{
    $query = "SELECT * FROM users WHERE userid = ? or useremail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location:../profile.php?error=stmterror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $userid, $useremail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }

    mysqli_stmt_close($stmt);
}

$fetchdata = useridExist($conn, $_SESSION["userid"], $_SESSION["useremail"]);
if ($fetchdata) {
    $username = $fetchdata['username'];
    $userid = $fetchdata['userid'];
    $useremail = $fetchdata['useremail'];
    $userpassword = $fetchdata['userpassword'];
    $usertype = $fetchdata['usertype'];
} else {
    header("location:profile.php?error=error");
    exit();
}