<?php
require_once "../../includes/db.inc.php";


if (isset($_POST['submit'])) {
    $shorturl = $_POST['shorturl'];
    $query = "DELETE FROM urls WHERE shorturl = '$shorturl';";

    if (mysqli_query($conn, $query)) {

        header("location:../url.php?page={$_POST['page']}");
        exit();
    } else {
        header("location:../url.php?error=notdeleted");
        exit();
    }
} else {
    header("location:../url.php");
    exit();
}
