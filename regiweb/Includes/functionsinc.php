<?php

function emptyInputSignup($useremail, $pass) {
    $result;
    if (empty($useremail) || empty($pass)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidemail($useremail) {
    $result;
    if (filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function uidExists($conn, $useremail) {
    $sql = "SELECT * FROM users WHERE usersEmail =?;";
    $stmt = mysqli_stmt_init($conn); //initialize for prepare statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtFail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $useremail); // 1s for 1 string check
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    //fetch data from DB if user exist
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $usermail, $pass) {
    $sql = "INSERT INTO users (usersEmail, usersPass) VALUE (?, ?);";
    $stmt = mysqli_stmt_init($conn); //initialize for prepare statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtFail");
        exit();
    }

    $hashPass = password_hash($pass, PASSWORD_DEFAULT); //pass protect

    mysqli_stmt_bind_param($stmt, "sss", $useremail, $pass, $hashPass); // 1s for 1 string check
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputSignin($useremail, $pass) {
    $result;
    if (empty($useremail) || empty($pass)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function loginUser($conn, $useremail, $pass) {
    $uidExist = uidExists($conn, $useremail);

    if ($uidExist === false) {
        header("location: ../signin.php?error=errorlogin");
        exit();
    }

    $hashPass = $uidExist["usersPass"];
    $checkPass = password_verify($pass, $hashPass);

    if ($checkPass === false) {
        header("location: ../signin.php?error=errorlogin");
        exit();
    } elseif ($checkPass === true) {
        session_start();
        $_SESSION["useremail"] = $uidExist["usersEmail"];
        header("location: ../userlogin.php"); // really need to re-arrange the front page cuz this shoud be "/index.php"
        exit();        
    }
}