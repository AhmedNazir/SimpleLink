<?php
session_start();

require_once 'includes/db.inc.php';
require_once 'includes/functions.db.inc.php';
?>


<?php
// redirect to longurl url...
if (isset($_GET['link'])) {
    $link = strtolower($_GET['link']);

    $query = "SELECT * FROM urls WHERE shorturl =  '$link'";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) != 0) {


        $arr = mysqli_fetch_assoc($result);
        $_SESSION[$link] = $arr;

        // update Click
        $totalclick = $arr['click'] + 1;
        $query = "UPDATE urls SET click='$totalclick' WHERE shorturl =  '$link'";

        $result = mysqli_query($conn, $query);


        if ($arr['passcode']) {
            header("location:password.php?link={$link}");
            exit();
        }
        // $full = $website . "passcode/" . $link;
        else if ($arr['capcha']) {
            header("location:capcha.php?link={$link}");
            exit();
        }

        // $full = $website . "capcha/" . $link;
        else if ($arr['preview']) {
            header("location:preview.php?link={$link}");
            exit();
        }
        // $full = $website . "preview/" . $link;
        else {
            $full = $arr['longurl'];
            header("location:{$full}");
            exit();
        }

        // header('location:')
        // echo "<script> setTimeout(function() { window.location = '$full'; }, 0); </script>";
    } else {
        header("location:preview.php?link={$link}");
        exit();

        // $full = $website . "preview/" . $link;
        // echo "<script> setTimeout(function() { window.location = '$full'; }, 0); </script>";
    }
} else {


    $message = "Welcome";
    if (isset($_POST['link'])) {

        $url = $_POST['link'];

        if (empty($_POST['creator']))
            $creator = "Unknown";

        if (empty($_POST['edit']))
            $edit = randomKey();
        else
            $edit = $_POST['edit'];

        if (!empty($_POST['isPreview']))
            $preview = intval($_POST['isPreview']);

        if (!empty($_POST['creator']))
            $creator = $_POST['creator'];

        if (!empty($_POST['isCapcha']))
            $capcha = intval($_POST['isCapcha']);

        if (!empty($_POST['passcode']))
            $passcode = $_POST['passcode'];


        if (strpos($url, "://") == false) {
            $url = "https://" . $url;
        }

        if (filter_var($url, FILTER_VALIDATE_URL)) {

            $flag = true;
            $shorted = "";
            // echo $_POST['custom'];
            if (empty($_POST['custom']))
                $shorted = uniqueKey($conn, $length = 3);
            else {
                $key = urlencode(str_replace(' ', '', $_POST['custom']));
                $query = "SELECT * FROM urls WHERE shorturl =  '$key'";

                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result)) {
                    $message = "Custom path is not available.<br> Please enter new alias...";
                    $fullURL = $url;
                    $flag = "";
                } else {
                    $shorted = $key;
                    $fullURL = "";
                }
            }

            if ($flag) {
                $query = "INSERT INTO urls ( longurl, shorturl, creator, edit, preview, capcha, passcode) VALUES ( '$url', '$shorted', '$creator', '$edit', '$preview', '$capcha', '$passcode')";


                $result = mysqli_query($conn, $query);
                if ($result) {
                    // $shorted = strval(mysqli_insert_id($conn));
                    $full = "$website$shorted";

                    // $message = "<p id='seltxt' style='user-select:all'>$full </p>";
                    // $message .= "<a href='$full' class='btn btn-primary'>GO</a>";


                    if(isset($_SESSION['userid'])){
                        $userid = $_SESSION['userid'];
                        $totalurl = (int) $_SESSION['totalurl'];
                        $totalurl++;
                        $_SESSION['totalurl'] = $totalurl;
                        $userquery = "UPDATE users SET totalurl = '$totalurl' WHERE userid = '$userid';";

                        mysqli_query($conn, $userquery);
                    }


                    $_SESSION['wildcard']   = $shorted;
                    header("location:preview.php?link={$shorted}");
                    exit();


                    // echo "<script> setTimeout(function() { window.location = 'preview/$shorted'; }, 0); </script>";


                    $_POST['link'] = "";
                } else {
                    $message = "Error: " . $query . "<br>" . mysqli_error($conn);
                    $flag = "";
                }
            }
        } else {
            $message = "Please  Enter Valid URL";
            $flag = "";
        }
    } else {
        $flag = "hidden";
        $message = "Welcome";
        $creator = "";
        $preview = 0;
        $capcha = 0;
        $passcode = null;
        $shorted = "";
        $url = "";
        $edit = randomKey();
    }

    require_once "includes/index.inc.php";
}
?>


<?php

mysqli_close($conn);

?>