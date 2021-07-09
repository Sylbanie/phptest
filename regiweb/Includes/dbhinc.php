<?php

$serverName = "localhost";
$dBUserEmail = "root";
$sBPassword = "";
$dBName = "regiweb";

$conn = mysqli_connect($serverName, $dBUserEmail, $sBPassword, $dBName);

if (!$conn) {
    die("Unable to connect" . mysqli_connect_error());
}