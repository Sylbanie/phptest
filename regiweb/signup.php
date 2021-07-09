<!DOCTYPE html>
<html>
    <head>
        <title>Register form</title>
    </head>

    <body>
        <h1>Register here!</h1>

        <section>
        <div class="signup">
            <form action="Includes/signupinc.php" method="POST">
                <label for="useremail">Email:</label>
                <input type="email" id="useremail" name="useremail" placeholder="abc@xmail.com"><br>
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" placeholder="********"><br>
                <button type="submit" value="Submit">Sign up</button><br>
            </form>
        </div>


        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "empty") {
                    echo "<p>Please fill all information.";
                } elseif ($_GET["error"] == "invalidemail") {
                    echo "<p>Please choose another email.</p>";
                } elseif ($_GET["error"] == "invalidpassword") {
                    echo "<p>Please choose another password.</p>";
                } elseif ($_GET["error"] == "stmtfailed") {
                    echo "<p>Something went wrong, please try again.</p>";
                } 
            }
        ?>
        
        </section>

    </body>
</html>