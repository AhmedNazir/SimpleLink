<?php
session_start();

require_once "db.inc.php";

if (isset($_POST['submit'])) {
    $shorturl = $_POST['shorturl'];
    $data = $_SESSION['edit'][$shorturl];



    echo '<pre>';
    print_r($data);
    print_r($_POST);
    echo '</pre>';

    if (empty($_POST['longurl']))
        $longurl = $data['longurl'];
    else
        $longurl = $_POST['longurl'];


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




    $query = "UPDATE urls SET longurl = '$longurl', creator = '$creator', edit = '$edit', preview ='$preview', capcha = '$capcha', passcode = '$passcode' WHERE  shorturl = '$shorturl';";

    if (mysqli_query($conn, $query)) {
        // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        header("location:../preview.php?link={$shorturl}");
        exit();
    }
} else {
    header("location:../edit.php");
    exit();
}
