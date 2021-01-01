<?php
session_start();

require_once 'includes/db.inc.php';
require_once 'includes/functions.db.inc.php';
?>

<?php

    if (!empty($_GET['link'])) {
        $url = $_GET['link'];

        if (strpos($url, "://") == false) {
            $url = "https://" . $url;
        }

        if (filter_var($url, FILTER_VALIDATE_URL)) {

            $shorted = "";
            // echo $_GET['custom'];
            if (empty($_GET['custom']))
                $shorted = uniqueKey($conn, $length = 3);
            else {
                $key = $_GET['custom'];
                $query = "SELECT * FROM urls WHERE shorturl =  '$key'";

                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result)) {
                    die("0");
                    $fullURL = $url;
                } else {
                    $shorted = $_GET['custom'];
                    $fullURL = "";
                }
            }

            $creator = "unknown";
            $editcode = randomKey();
            $preview = 0;
            $capcha = 0;
            $passcode = null;


            if (!empty($_GET['preview']))
                $preview = intval($_GET['preview']);

            if (!empty($_GET['capcha']))
                $capcha = intval($_GET['capcha']);

            if (!empty($_GET['creator']))
                $creator = $_GET['creator'];

            if (!empty($_GET['passcode']))
                $passcode = $_GET['passcode'];

            $query = "INSERT INTO urls ( longurl, shorturl, creator, edit, preview, capcha, passcode) VALUES ( '$url', '$shorted', '$creator', '$editcode', '$preview', '$capcha', '$passcode')";


            $result = mysqli_query($conn, $query);
            if ($result) {
                echo $website . $shorted;
                $_GET['link'] = "";
            } else {
                echo '0';
            }
        } else {
            echo '0';
        }
    } else if ((empty($_GET['link']))&&!empty($_GET['custom'])) {

        $key = $_GET['custom'];
        $query = "SELECT * FROM links WHERE shorturl =  '$key'";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result)) {
            echo '0';
        } else {
            echo '1';
        }
    } else {
        echo '0';
    }
    ?>

<?php
mysqli_close($conn);
?>