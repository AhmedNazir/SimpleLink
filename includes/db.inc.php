<?php


// $dbHost = "sql303.epizy.com";
// $dbUser = "epiz_25442413";
// $dbPassword = "Yxv3FDREWwHLvj";
// $dbName = "epiz_25442413_urlshortener";
// $website =  "http://" . $_SERVER['SERVER_NAME'];


$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "urlshortener";
$website =  "http://{$_SERVER['SERVER_NAME']}/simplelink/";

$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);


if ($conn) {
    // echo "connected";
} else {
    die("Error: " . mysqli_connect_error());
}
