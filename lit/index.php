<?php

include("includes/config.php");

//session_destroy(); //Log out function

if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
}
else {
    header("Location: register.php"); //Redirects to register page if no session started.
}

?>

<html>
<head>
    <title>Lit</title>
</head>
<body>
    Hello!
</body>
</html>
