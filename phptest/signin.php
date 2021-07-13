<?php   
    ob_start();
    session_start();
    require_once "config.php";
        
    //Shorten the validation code
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    //Define Test variables and set to empty values
    $nameErr = $emailErr = $passErr = $loginErr = "";
    $nameTest = $emailTest = $passTest = "";

    //Setting up variables
    $username = $_POST["name"];
    $useremail = $_POST["email"];
    $userpass = $_POST["pass"];

    //Check validation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //Check name
        if (empty($username)) {
            $nameErr = "Please enter your name!<br>";
        } else {
            $nameTest = test_input($username);
        }
        
        //Check email
        if (empty($useremail)) {
            $emailErr = "Please enter your email!<br>";
        } else {
            $emailTest = test_input($useremail);
            
            if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Please recheck your email!<br>"; 
            }
        }
        
        //Check pass
        if (empty($_POST["pass"])) {
            $passErr = "Please enter your password!<br>";
        } else {
            $passTest = test_input($userpass);
        }

        //Validation
        if (empty($nameErr) && empty($passErr)) {
            //Prepare a select statement
            $sql = "SELECT * FROM users WHERE username='$username' AND email='$useremail' AND pass='$userpass'";
            echo "1";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                //Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $username, $useremail, $userpass);
                // Attempt to execute the prepared statement
                echo "2";

                $a = mysqli_stmt_execute($stmt);
                if ($a) {
                    //Store result
                    mysqli_stmt_store_result($stmt);
                    echo "3";
                    //If username exists then verify password
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        echo "4";
                        if (mysqli_stmt_fetch($stmt)) {
                            
                            // if (password_verify($password, $hashed_password)) {
                                // // Password is correct, so start a new session
                                // session_start();
                                
                                // Redirect user to welcome page
                                echo "Welcome " . $username . "! <br>
                                    <a href=\"signout.php\">Sign Out here!</a>";
                                die();
                            // } 
                        } 
                    } else {
                        // Password is not valid, display a generic error message
                        $loginErr = "Invalid username or password.";
                    } 
                } else {
                    echo "Invalid username or password, <a href=\"signin.php\">please try again!</a>";
                    die ();
                }

                //Close statement
                mysqli_stmt_close($stmt);
            }
        
        }

        // Close connection
        mysqli_close($conn);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST["name"] || $_POST["email"] || $_POST["pass"])) {
            echo "<p><span class =\"error\">* required field.</span></p>";
        } else {
            echo "Welcome " . $username . "! <br>
                <a href=\"signout.php\">Sign Out here!</a>";
            die();
        }
    }

?>

<html>
<body>

    <h1>This is the Sign In page!</h1>
    
    <form action="signin.php" method="post">
        * Is required information <a type="text"> <br> <br>

        Name: <input type="text" name="name">
        <span class = "error">* <?php echo $nameErr;?></span> <br>

        E-mail: <input type="email" name="email">
        <span class = "error">* <?php echo $emailErr;?></span> <br>

        Password: <input type="password" name="pass">
        <span class = "error">* <?php echo $passErr;?></span> <br>

        <br> <input type="submit">
    </form>

</body>
</html>