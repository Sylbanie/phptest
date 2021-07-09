<?php

if (isset($_POST["submit"])) {

    $useremail = $_POST["useremail"];
    $pass = $_POST["pass"];

    require_once 'dbhinc.php';
    require_once 'functionsinc.php';
    
    if (emptyInputSignup($useremail, $pass) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidemail($useremail) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    if (invalidpass($pass) !== false) {
        header("location: ../signup.php?error=invalidpass");
        exit();
    }

    if (uidExists($conn, $useremail) !== false) {
        header("location: ../signup.php?error=usertaken");
        exit();
    }

    createUser($conn, $usermail, $pass);

} else {
    header("location: ../signup.php");
    exit();
}