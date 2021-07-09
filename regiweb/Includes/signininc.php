<?php

if (isset($_POST["submit"])) {

    $useremail = $_POST["useremail"];
    $pass = $_POST["pass"];

    require_once 'bdhinc.php';
    require_once 'functionsinc.php';

    if (emptyInputSignin($useremail, $pass) !== false) {
        header("location: ../signin.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $useremail, $pass);
} else {
    header("location: ../signin.php");
    exit();
}