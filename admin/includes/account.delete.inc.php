<?php

if (!isset($_POST['submit']) && empty($_POST['userid'])) {
    header("location:../account.php");
    exit();
}

require_once "../../includes/db.inc.php";

$userid = $_POST['userid'];

$query = "DELETE FROM users WHERE userid = '$userid' AND usertype = 'user';";

if (mysqli_query($conn, $query)) {
    $query = "DELETE FROM urls WHERE userid = '$userid';";
    if(mysqli_query($conn, $query)){
        header("location:../account.php?error=notdeletedurl");
        exit();
    }

    header("location:../account.php?error=none");
    exit();
} else {
    header("location:../account.php?error=notdeleteduser");
    exit();
}
