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
        $username = $userLoggedIn->getAccountUsername();
        //retrieves username from User class so $username variable can be used in this page.
        $userPlaylistSearch = mysqli_query($dbConnection, "SELECT * FROM playlists WHERE owner = '$username'");
        
        if(mysqli_num_rows($userPlaylistSearch) == 0) {
            echo '<span class="noResult" style="margin-left: 430px;">No playlists were found.</span>';
        }
        
        while($songRow = mysqli_fetch_array($userPlaylistSearch)) {
            /* Takes the query and converts the result into an array
            so each row contains the row of the playlist table returned. */

            $userPlaylist = new Playlist($dbConnection, $songRow);

            echo "<div class='gridViewItem' role='link' tabindex='0' onclick='changePage(\"playlist.php?id=" . $userPlaylist->getId() . "\")'>
                    <div class='playlistIcon'>
                        <img src='assets/images/icons/playlist.png'>
                    </div>

                    <div class='gridViewInfo'>"
                        . $userPlaylist->getTheName() .
                    "</div>
                </div>";   
        }
    ?>

</div>
