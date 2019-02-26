<?php 
include("includes/config.php");
include("includes/classes/Account.php");
$account = new Account($connection);

include("includes/classes/Constants.php");
include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInput($userInput) {
    if(isset($_POST[$userInput])) {
        echo $_POST[$userInput];
    }
}

?>

<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:300|Montserrat:900i" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script> 
</head>

<body>

    <?php 
    if(isset($_POST['rgButton'])) {
        echo '<script>
                $(document).ready(function() {
                    $("#rg").show();
                    $("#lg").hide();
                });
            </script>';
    }
    else {
        echo '<script>
                $(document).ready(function() {
                    $("#lg").show();
                    $("#rg").hide();
                });
            </script>';
    }
    ?>

    <div id="bg">
        <div id="lgContainer">
            <div id="input">
                <form id="lg" action="register.php" method="POST">
                    <!-- LOG IN Form -->
                    <h2>Log In</h2>
                    <p>
                        <?php echo $account->getError(Constants::$logInFail); ?>
                        <label for="lgUsername">Username</label>
                        <input id="lgUsername" name="lgUsername" type="text" placeholder="Enter your username" required>
                    </p>
                    <p>
                        <label for="lgPassword">Password</label>
                        <input id="lgPassword" name="lgPassword" type="password" placeholder="Enter your password"
                            required>
                    </p>
                    <button type="submit" name="lgButton">LOG IN</button>
                    <div class="switchForm">
                        <span id="hideLoginForm">Don't have an account? Sign up here.</span>
                    </div>
                </form>
                <form id="rg" action="register.php" method="POST">
                    <!-- REGISTER Form -->
                    <h2>Sign Up</h2>
                    <p>
                        <?php echo $account->getError(Constants::$usernameLength); ?>
                        <?php echo $account->getError(Constants::$usernameExists); ?>
                        <label for="rgUsername">Username</label>
                        <input id="rgUsername" name="rgUsername" type="text" placeholder="Enter a username" value="<?php getInput('rgUsername') ?>"
                            required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$firstNameLength); ?>
                        <label for="rgFirstName">First Name</label>
                        <input id="rgFirstName" name="rgFirstName" type="text" placeholder="Enter your first name"
                            value="<?php getInput('rgFirstName') ?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$lastNameLength); ?>
                        <label for="rgLastName">Last Name</label>
                        <input id="rgLastName" name="rgLastName" type="text" placeholder="Enter your last name" value="<?php getInput('rgLastName') ?>"
                            required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$emailDontMatch); ?>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailExists); ?>
                        <label for="rgEmail">E-mail</label>
                        <input id="rgEmail" name="rgEmail" type="email" placeholder="Enter your e-mail" value="<?php getInput('rgEmail') ?>"
                            required>
                    </p>
                    <p>
                        <label for="rgConfirmEmail">Confirm E-mail</label>
                        <input id="rgConfirmEmail" name="rgConfirmEmail" type="email" placeholder="Confirm your e-mail"
                            required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$passwordDontMatch); ?>
                        <?php echo $account->getError(Constants::$passwordAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordLength); ?>
                        <label for="rgPassword">Password</label>
                        <input id="rgPassword" name="rgPassword" type="password" placeholder="Enter a password"
                            required>
                    </p>
                    <p>
                        <label for="rgConfirmPassword">Confirm Password</label>
                        <input id="rgConfirmPassword" name="rgConfirmPassword" type="password" placeholder="Confirm your password"
                            required>
                    </p>
                    <button type="submit" name="rgButton">SIGN UP</button>
                    <div class="switchForm">
                        <span id="hideRegisterForm">Already have an account? Click here.</span>
                    </div>
                </form>
            </div>
            <div id="bodyText">
                <h1>LIT🔥</h1>
                <h2>Discover music you'll fall in love with</h2>
                <ul>
                    <li>Listen to amazing new songs</li>
                    <li>Find great new artists</li>
                    <li>Curate a personalised playlist made just for you</li>
                    </div>
                        <div id="bodyImage">
                    </div>
                </ul>
        </div>
    </div>
</body>

</html>