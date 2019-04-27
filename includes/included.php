<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    include("includes/config.php");
    include("includes/classes/User.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
    include("includes/classes/Song.php");
    include("includes/classes/Playlist.php");

    if(isset($_GET['userLoggedIn'])) {
        $userLoggedIn = new User($dbConnection, $_GET['userLoggedIn']);
    }
    else {
        echo "Username variable was not passed into page, check changePage().";
        exit();
    }

}
else {
    include("includes/header.php");
    //Header includes all code from navigation bar up to main content
    include("includes/footer.php");
    //Footer includes all code from main content ending to music player
    $url = $_SERVER['REQUEST_URI'];
    echo "<script>changePage('$url')</script>";
    exit();
}

?>