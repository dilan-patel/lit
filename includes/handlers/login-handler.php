<?php 


if(isset($_POST['lgButton'])) {
    //Log In button clicked
    $username = $_POST['lgUsername']; //Checks input by posting to database
    $password = $_POST['lgPassword'];

    $logIn = $userAccount->login($username, $password);
    if($logIn == true) {
        $_SESSION['userLoggedIn'] = $username; //Sets session to username if log in was successful.
        header("Location: index.php"); //Takes user to index page if log in successful.
    }
}

?>