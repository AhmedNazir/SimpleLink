<?php
session_start();

require_once "../../includes/db.inc.php";

function userExists($conn, $userid, $useremail)
{

    $query = "SELECT * FROM users WHERE userid = ? OR useremail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location:../edit.php?error=stmterror");
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
}

function invalidUserid($userid)
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $userid)) {
        return true;
    } else {
        return false;
    }
}


function invalidUseremail($useremail)
{
    if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}


function updateInfo($conn, $username, $useremail, $userid, $olduserid)
{
    $sql = "UPDATE users SET username = '$username', useremail = '$useremail', userid = '$userid' WHERE userid='$olduserid'; ";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['username'] = $username;
        $_SESSION['useremail'] = $useremail;
        $_SESSION['userid'] = $userid;

        header("location:../profile.php");
        exit();
    } else {

        echo mysqli_error($conn);
    }
    mysqli_close($conn);
}


if (isset($_POST['submit'])) {

    $username = $_POST['username'];

    $olduseremail = $_SESSION['useremail'];
    $useremail = $_POST['useremail'];

    $olduserid = $_SESSION['userid'];
    $userid = $_POST['userid'];

    if (empty($username) || empty($userid) || empty($useremail)) {
        header("location:../edit.php?error=emptyinput");
        exit();
    }

    if (invalidUserid($userid)) {
        header("location:../edit.php?error=invaliduserid");
        exit();
    }

    if (invalidUseremail($useremail)) {
        header("location:../edit.php?error=invalidemail");
        exit();
    }


    if ($olduserid != $userid && userExists($conn, $userid, $userid)) {
        header("location:../edit.php?error=useridexists");
        exit();
    }

    if ($olduseremail != $useremail && userExists($conn, $useremail, $useremail)) {
        header("location:../edit.php?error=useremailexists");
        exit();
    }

    updateInfo($conn, $username, $useremail, $userid, $olduserid);


    // Close connection
    mysqli_close($conn);
} else {
    header("location:../edit.php");
    exit();
}
