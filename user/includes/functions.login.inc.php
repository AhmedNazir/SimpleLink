<?php

function isEmptyInput($userid, $userpassword)
{
    if (empty($userid) || empty($userpassword)) {
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
        header("location:../login.php?error=stmterror");
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

function login($conn, $userid, $userpassword)
{
    $userdata = useridExist($conn, $userid, $userid);
    if ($userdata) {

        if (password_verify($userpassword, $userdata["userpassword"])) {

            $_SESSION["userid"] = $userdata["userid"];
            $_SESSION["useremail"] = $userdata["useremail"];
            $_SESSION["username"] = $userdata["username"];
            $_SESSION["userpassword"] = $userdata["userpassword"];
            $_SESSION["usertype"] = $userdata["usertype"];
            $_SESSION["totalurl"] = $userdata["totalurl"];

            header("location:../dashboard.php");
            exit();
        } else {
            header("location:../login.php?error=pwdnotmatch");
            exit();
        }
    } else {
        header("location:../login.php?error=usernotexist");
        exit();
    }
}
