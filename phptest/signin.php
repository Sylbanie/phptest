<?php
   ob_start();
   session_start();
?>

<html>
    <body>
    
        <?php
            
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
                if (empty($_POST["name"])) {
                    $nameErr = "Please enter your name!<br>";
                } else {
                    $nameTest = test_input($_POST["name"]);
                }
                
                if (empty($_POST["email"])) {
                    $emailErr = "Please enter your email!<br>";
                } else {
                    $emailTest = test_input($_POST["email"]);
                    
                    //Check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Please recheck your email!<br>"; 
                    }
                }

                if (empty($_POST["pass"])) {
                    $passErr = "Please enter your password!<br>";
                } else {
                    $passTest = test_input($_POST["pass"]);
                }

            }
        ?>

        <?php
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