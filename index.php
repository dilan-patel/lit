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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:300|Montserrat:900i" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div id="bottomMusicPlayer">
        <div id="bottomMusicPlayerContainer">
            <div id="musicPlayerLeft">
            </div>
            <div id="musicPlayerMiddle">
                <div class="contents controls">
                    <div class="buttons">
                        <button class="controlButtons shuffle" title="Shuffle">
                            <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                        </button>
                        <button class="controlButtons previous" title="Previous">
                            <img src="assets/images/icons/previous.png" alt="Previous">
                        </button>
                        <button class="controlButtons play" title="Play">
                            <img src="assets/images/icons/play.png" alt="Play">
                        </button>
                        <button class="controlButtons pause" title="Pause" style="display: none;">
                            <img src="assets/images/icons/pause.png" alt="Pause">
                        </button>
                        <button class="controlButtons next" title="Next">
                            <img src="assets/images/icons/next.png" alt="Next">
                        </button>
                        <button class="controlButtons repeat" title="Repeat">
                            <img src="assets/images/icons/repeat.png" alt="Repeat">
                        </button>
                    </div>
                    <div class="playingBar">
                        <span class="progressTimer current">0:00</span>

                        <div class="progressBar">
                            <div class="progressBackground">
                                <div class="progress"></div>
                            </div>
                        </div>

                        <span class="progressTimer remaining ">0:00</span>
                    </div>
                </div>
            </div>
            <div id="musicPlayerRight">

            </div>
        </div>
    </div>
</body>
</html>