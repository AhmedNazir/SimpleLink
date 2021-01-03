<?php
require_once "../includes/db.inc.php";

session_start();
session_unset();
session_destroy();
setcookie("userid", "", time() - 3600,"/");
setcookie("useremail", "", time() - 3600, "/");
setcookie("userpassword", "", time() - 3600, "/");

header("location:../index.php");
exit();