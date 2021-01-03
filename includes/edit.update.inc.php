<?php
session_start();

require_once "db.inc.php";

function checkURL($longurl)
{
    if (strpos($longurl, "://") == false) {
        $longurl = "https://" . $longurl;
    }

    if (filter_var($longurl, FILTER_VALIDATE_URL) && strpos($longurl, ".") && strpos($longurl, ".") != strlen($longurl) - 1) {
        return $longurl;
    } else {
        return false;
    }
}


if (isset($_POST['submit'])) {
    $shorturl = $_POST['shorturl'];
    $data = $_SESSION['edit'][$shorturl];

    if (empty($_POST['longurl']) || checkURL($_POST['longurl']) == false)
        $longurl = $data['longurl'];
    else
        $longurl = checkURL($_POST['longurl']);

    if (empty($_POST['creator']))
        $creator = $data['creator'];
    else
        $creator = $_POST['creator'];


    if (empty($_POST['edit']))
        $edit = $data['edit'];
    else
        $edit = $_POST['edit'];

    $preview = intval($_POST['preview']);
    $capcha = intval($_POST['capcha']);
    $passcode = $_POST['passcode'];

    // $today = Date("Y-m-d");
    // if ($_POST['expire'] > $today)
    //     $expire = $_POST['expire'];
    // else
    //     $expire = $today;




    $query = "UPDATE urls SET longurl = '$longurl', creator = '$creator', edit = '$edit', preview ='$preview', capcha = '$capcha', passcode = '$passcode' WHERE  shorturl = '$shorturl';";

    if (mysqli_query($conn, $query)) {

        header("location:../preview.php?link={$shorturl}");
        exit();
    }
} else {
    header("location:../edit.php");
    exit();
}
