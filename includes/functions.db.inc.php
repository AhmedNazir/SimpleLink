<?php


function randomKey($length = 3)
{
    $str = "0123456789abcdefghijklmnopqrstuvwxyz";
    return substr(str_shuffle($str), 0, $length);
}


function uniqueKey($conn, $length)
{
    while (true) {
        $key = randomKey($length);
        $query = "SELECT * FROM urls WHERE shorturl =  '$key'";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == false) {
            return $key;
        }
    };
}
