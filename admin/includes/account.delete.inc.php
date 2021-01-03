<?php

if (!isset($_POST['submit']) && empty($_POST['userid'])) {
    header("location:../account.php");
    exit();
}

require_once "../../includes/db.inc.php";

$userid = $_POST['userid'];

$query = "DELETE FROM users WHERE userid = '$userid' AND usertype = 'user';";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result)) {
    
    $query = "DELETE FROM urls WHERE userid = '$userid';";
    if (mysqli_query($conn, $query)) {
        header("location:../account.php");
        exit();
    } else {
        header("location:../account.php?error=notdeleteurl");
        exit();
    }

    header("location:../account.php?page={$_POST['page']}");
    exit();
} else {
    header("location:../account.php?error=notdeleteduser");
    exit();
}
