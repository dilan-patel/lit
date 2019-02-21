<?php 
include("includes/classes/Account.php");
$account = new Account();

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");
?>

<html>

<head>
    <title>Register</title>
</head>

<body>
    <div id="input">
        <form id="lg" action="register.php" method="POST">
            <!-- LOG IN Form -->
            <h2>Log In</h2>
            <p>
                <label for="lgUsername">Username</label>
                <input id="lgUsername" name="lgUsername" type="text" placeholder="Enter your username" required>
            </p>
            <p>
                <label for="lgPassword">Password</label>
                <input id="lgPassword" name="lgPassword" type="password" placeholder="Enter your password" required>
            </p>
            <button type="submit" name="lgButton">LOG IN</button>
        </form>
        <form id="rg" action="register.php" method="POST">
            <!-- REGISTER Form -->
            <h2>Sign Up</h2>
            <p>
                <label for="rgUsername">Username</label>
                <input id="rgUsername" name="rgUsername" type="text" placeholder="Enter a username" required>
            </p>
            <p>
                <label for="rgFirstName">First Name</label>
                <input id="rgFirstName" name="rgFirstName" type="text" placeholder="Enter your first name" required>
            </p>
            <p>
                <label for="rgLastName">Last Name</label>
                <input id="rgLastName" name="rgLastName" type="text" placeholder="Enter your last name" required>
            </p>
            <p>
                <label for="rgEmail">E-mail</label>
                <input id="rgEmail" name="rgEmail" type="email" placeholder="Enter your e-mail" required>
            </p>
            <p>
                <label for="rgConfirmEmail">Confirm E-mail</label>
                <input id="rgConfirmEmail" name="rgConfirmEmail" type="email" placeholder="Confirm your e-mail"
                    required>
            </p>
            <p>
                <label for="rgPassword">Password</label>
                <input id="rgPassword" name="rgPassword" type="password" placeholder="Enter a password" required>
            </p>
            <p>
                <label for="rgConfirmPassword">Confirm Password</label>
                <input id="rgConfirmPassword" name="rgConfirmPassword" type="password" placeholder="Confirm your password"
                    required>
            </p>
            <button type="submit" name="rgButton">SIGN UP</button>
        </form>
    </div>
</body>

</html>