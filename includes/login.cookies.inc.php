
<?php
// COOKIES............

function useridExist($conn, $userid, $useremail)
{
    $query = "SELECT * FROM users WHERE userid = ? or useremail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        return false;
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


function login($conn, $userid, $useremail, $userpassword)
{
    $userdata = useridExist($conn, $userid, $userid);

    if ($userdata) {

        if (password_verify($userdata['useremail'], $useremail) && password_verify($userdata["userpassword"], $userpassword)) {

            $_SESSION["userid"] = $userdata["userid"];
            $_SESSION["useremail"] = $userdata["useremail"];
            $_SESSION["username"] = $userdata["username"];
            $_SESSION["userpassword"] = $userdata["userpassword"];
            $_SESSION["usertype"] = $userdata["usertype"];
            $_SESSION["totalurl"] = $userdata["totalurl"];

            $cookie_name = 'userid';
            $cookie_value = $userdata['userid'];
            $time = 30;
            setcookie($cookie_name, $cookie_value, time() + (86400 * $time), "/");


            $cookie_name = 'useremail';
            $cookie_value = password_hash($userdata['useremail'], PASSWORD_DEFAULT);
            $time = 30;
            setcookie($cookie_name, $cookie_value, time() + (86400 * $time), "/");

            $cookie_name = 'userpassword';
            $cookie_value = password_hash($userdata['userpassword'], PASSWORD_DEFAULT);
            $time = 30;
            setcookie($cookie_name, $cookie_value, time() + (86400 * $time), "/");
        }
    }
}


if (isset($_COOKIE['userid']) && !isset($_SESSION['userid'])) {
    $cid = $_COOKIE['userid'];
    $cemail = $_COOKIE['useremail'];
    $cpassword = $_COOKIE['userpassword'];

    login($conn, $cid, $cemail, $cpassword);
}


?>