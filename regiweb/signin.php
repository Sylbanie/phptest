<!DOCTYPE html>
<html>
    <head>
        <title>Log in form</title>
    </head>

    <body>
        <h1>Log in here!</h1>

        <div class="signin">
            <form action="Includes/signininc.php" method="POST">
                <label for="useremail">Email:</label>
                <input type="email" id="useremail" name="useremail" placeholder="abc@xmail.com"><br>
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" placeholder="********"><br>
                <button type="submit" value="Submit">Sign in</button><br>
            </form>
        </div>
    </body>
</html>