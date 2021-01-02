<?php

require_once 'includes/db.inc.php';

function randomKey($length = 6)
{
    $str = "0123456789abcdefghijklmnopqrstuvwxyz";
    return substr(str_shuffle($str), 0, $length);
}


for ($i = 0; $i < 50; $i++) {

    $username = randomKey(5) . " " . randomKey(6);
    $useremail = randomKey(2) . "@gmail.com";
    $userid = randomKey(3);
    $userpassword = password_hash("a", PASSWORD_DEFAULT);
    $usertype = "user";


    $query = "INSERT INTO users (username, useremail, userid, userpassword, usertype) VALUES ('$username','$useremail','$userid','$userpassword','$usertype')";
    mysqli_query($conn, $query);
}

echo "complete";

