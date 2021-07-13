<?php

//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//      echo "This is POST"; 
// } else {
//     echo "This is GET";
// }

// echo "Welcome " . $_GET[""] . "!<br />";

// //Session
// session_start();
   
// $user_check = $_SESSION['login_user'];

// $ses_sql = mysqli_query($db,"select user from admin where user = '$user_check' ");

// $row = mysqli_fetch_array($ses_sql ,MYSQLI_ASSOC);

// $login_session = $row['user'];

// if(!isset($_SESSION['login_user'])){
//     header("Location: index.html");
//     die();
// }

// //Database config
// $serverName = "localhost";
// $dbUser = "root";
// $dbPassword = "";
// $dbName = "phptest";

// $db = mysqli_connect($serverName, $dbUser, $dbPassword, $dbName);
// if ($db->connect_error) {
//     die("Database connection failed: " . $db->connect_error);
//   }

// //Attempt create table query execution
// $sql = "CREATE TABLE users(
//     id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     username VARCHAR(128) NOT NULL,
//     email VARCHAR(128) NOT NULL UNIQUE,
//     pass VARCHAR(18) NOT NULL
//     )";

// if(mysqli_query($db, $sql)){
//     echo "Table created successfully.";
// } else {
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
// }
 
// //Close connection
// mysqli_close($link);

// //Prepare statement & bind
// $stmt = $db->prepare("INSERT INTO users (username, email, pass) VALUES (?, ?, ?)");
// $stmt->bind_param("sss", $username, $useremail, $userpass);

// //Check validation  
// $sql = "SELECT username, email, pass FROM users";
// $result = $db->query($sql);

// if ($result->num_rows > 0) {
//     //Output data of each row
//     while($row = $result->fetch_assoc()) {
//             echo "Welcome " . $username . "! <br>
//             <a href=\"signout.php\">Sign Out here!</a>";
//         die();
//     }
//   } else {
//         echo "Please try again <br>
//             <a href=\"signout.php\">Sign Out here!</a>";
//   }
//   $db->close();


// //Make new registry
// $sql = "INSERT INTO users (username, email, pass)
//         VALUES ($username, $useremail, $userpass);";

$conn = new mysqli("localhost", "debian-sys-maint", "jOUzPzs0anKqLIkO", "phptest");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// $stmt = $conn->prepare("SELECT * FROM users");
// $stmt->execute();
// $result = $stmt->get_result(); 
// $data = $result->fetch_all(MYSQLI_ASSOC);
// print($data[0]['id'].' '.$data[0]['username'].' '.$data[0]['email'].' ');