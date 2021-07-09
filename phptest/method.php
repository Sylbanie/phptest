<html>
<body>

<?php

//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//      echo "This is POST"; 
// } else {
//     echo "This is GET";
// }

// echo "Welcome " . $_GET[""] . "!<br />";

//Database config
$serverName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "phptest";

$db = mysqli_connect($serverName, $dbUser, $dbPassword, $dbName);

//Attempt create table query execution
$sql = "CREATE TABLE persons(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    uname VARCHAR(30) NOT NULL,
    email VARCHAR(70) NOT NULL UNIQUE,
    pass VARCHAR(30) NOT NULL
    )";

if(mysqli_query($db, $sql)){
    echo "Table created successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}
 
//Close connection
mysqli_close($link);

//Session
session_start();
   
$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($db,"select user from admin where user = '$user_check' ");

$row = mysqli_fetch_array($ses_sql ,MYSQLI_ASSOC);

$login_session = $row['user'];

if(!isset($_SESSION['login_user'])){
    header("Location: index.html");
    die();
}