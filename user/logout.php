<?php
require_once "../includes/db.inc.php";

session_start();
session_unset();
session_destroy();

header("location:../index.php");
exit();