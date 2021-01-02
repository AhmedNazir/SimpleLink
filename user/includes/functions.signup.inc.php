<?php

function isEmptyInput($username, $useremail, $userid, $userpassword, $repeatpassword)
{
    if (empty($username) || empty($userid) || empty($useremail) || empty($userpassword) || empty($repeatpassword)) {
        return true;
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


function invalidPassword($userpassword, $repeatpassword)
{
    if ($userpassword != $repeatpassword) {
        return true;
    } else {
        return false;
    }
}



function useridExist($conn, $userid, $useremail)
{

    $query = "SELECT * FROM users WHERE userid = ? or useremail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location:../signup.php?error=stmterror");
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

function createAccount($conn, $username, $useremail, $userid, $userpassword)
{
    $usertype = "user";
    $query = "INSERT INTO users (username, useremail, userid, userpassword, usertype) VALUES (?,?,?,?,?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location:../signup.php?error=createfail");
        exit();
    }

    $hashedpwd = password_hash($userpassword, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssss", $username, $useremail, $userid, $hashedpwd, $usertype);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);

    header("location:../signup.php?error=none");
    exit();
}


