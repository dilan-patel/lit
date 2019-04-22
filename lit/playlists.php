<?php

include("includes/included.php");

?>

<div class="playlistsContainer">
    <div class="entityInfo">
        <div class="middleSection">
            <h1 class="mainHeader playlistTitle">Playlists</h1>
            <div class="mainButton">
                <button class="playlistButton" onclick="createPlaylist()">NEW</button>
            </div>
        </div>
    </div>
    
    <?php 
        $username = $userLoggedIn->getUsername();
        //retrieves username from User class so $username variable can be used in this page.
        $playlistSearch = mysqli_query($connection, "SELECT * FROM playlists WHERE owner = '$username'");
        
        if(mysqli_num_rows($playlistSearch) == 0) {
            echo '<span class="noResult" style="margin-left: 430px;">No playlists were found.</span>';
        }
        
        while($row = mysqli_fetch_array($playlistSearch)) {
            /* Takes the query and converts the result into an array
            so each row contains the row of the playlist table returned. */

            $playlist = new Playlist($connection, $row);

            echo "<div class='gridViewItem' role='link' tabindex='0' onclick='changePage(\"playlist.php?id=" . $playlist->getId() . "\")'>
                    <div class='playlistIcon'>
                        <img src='assets/images/icons/playlist.png'>
                    </div>

                    <div class='gridViewInfo'>"
                        . $playlist->getName() .
                    "</div>
                </div>";   
        }
    ?>

</div>
