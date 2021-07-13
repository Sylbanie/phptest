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
    $nameErr = $emailErr = $passErr = "";
    $nameTest = $emailTest = $passTest = "";

    //Setting up variables
    $username = $_POST["name"];
    $useremail = $_POST["email"];
    $userpass = $_POST["pass"];

    //Check validation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //Name check
        if (empty($_POST["name"])) {
            $nameErr = "Please enter your name!<br>";
        } else {
            //
            $sql = "SELECT id FROM users WHERE username = ?";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                //Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $username);
                
                //Set parameters
                $username = test_input($username);
                // echo "Name: ".$username;
                //Execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    //Store result
                    mysqli_stmt_store_result($stmt);
                    
                    //Check infor in database
                    if(mysqli_stmt_num_rows($stmt) != 0) {
                        $nameErr = "This username is already taken.";
                        // echo "Number of records:".mysqli_stmt_num_rows($stmt);
                    }
                } else {
                    echo "Please try again.";
                }
    
                //Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        //Email check
        if (empty($_POST["email"])) {
            $emailErr = "Please enter your email!<br>";
        } else {
            //Prepare select statement
            $sql = "SELECT id FROM users WHERE email = ?";
            
            if($stmt = mysqli_prepare($conn, $sql)) {
                //Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $useremail);

                // //Check if e-mail address is well-formed
                // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //     $emailErr = "Please recheck your email!<br>"; 
                // }
                
                //Execute the prepared statement
                $a = mysqli_stmt_execute($stmt);
                
                if ($a) {
                    //Store result
                    mysqli_stmt_store_result($stmt);
                    
                    //Check infor in database
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        $emailErr = "This email is already registered.";
                    } else {
                        $emailTest = test_input($_POST["email"]);
                    }
                } else {
                    echo "Please try again.";
                }
    
                //Close statement
                mysqli_stmt_close($stmt);
            }
        }

        //Password check
        if (empty($_POST["pass"])) {
            $passErr = "Please enter your password!<br>";
        } else {
            $passTest = test_input($_POST["pass"]);
        }

        //Final check before reaching database
        if (empty($nameErr) && empty($emailErr) && empty($passErr) && empty($passErrCf)) {
            
            //Prepare an insert statement
            $sql = "INSERT INTO users (username, email, pass) VALUES (?, ?, ?)";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                //Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $username, $useremail, $userpass);
                
                //Execute the prepared statement
                $a = mysqli_stmt_execute($stmt);
                // echo $a;
                //Attempt to execute the prepared statement
                if ($a) {
                    //Redirect to login page
                    echo "Welcome " . $username . "! <br>
                        <a href=\"signout.php\">Sign Out here!</a>";
                    die();

                } else {
                    printf("Error: %s.\n", mysqli_stmt_error($stmt));
                    echo "Please try again.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        //Close connection
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<body>
    <h1>This is the Sign Up page!</h1>
    
    <form action="signup.php" method="post">
        * Is required information <a type="text"> </a> <br> <br>

        Name: <input type="text" name="name">
        <span class = "error">* <?php echo $nameErr;?> </span> <br>

        E-mail: <input type="email" name="email">
        <span class = "error">* <?php echo $emailErr;?> </span> <br>

        Password: <input type="password" name="pass">
        <span class = "error">* <?php echo $passErr;?> </span> <br>

        <br> <input type="submit">
    </form>

</body>
</html>
