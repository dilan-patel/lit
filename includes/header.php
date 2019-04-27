<?php
include("includes/config.php");
include("includes/classes/User.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");
include("includes/classes/Playlist.php");

//session_destroy(); //Log out function
if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = new User($dbConnection, $_SESSION['userLoggedIn']);
    $username= $userLoggedIn->getAccountUsername();
    echo "<script>userLoggedIn = '$username';</script>";
}
else {
    header("Location: landing.php"); //Redirects to register page if no session started.
}
?>

<html>

<head>
    <title>Lit</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400|Montserrat:900i" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>


    <div id="primaryContainer">
        <div id="topContainer">
            <?php include("includes/navContainer.php"); ?>

            <div id="mainContainer">
                <div id="mainContent">