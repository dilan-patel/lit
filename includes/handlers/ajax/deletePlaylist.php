<?php

include("../../config.php");

if(isset($_POST['playlistId'])) {
    $userPlaylistId = $_POST['playlistId'];

    $userPlaylistDelete = mysqli_query($dbConnection, "DELETE FROM playlists WHERE id='$userPlaylistId'");
    $songsDelete = mysqli_query($dbConnection, "DELETE FROM playlistSongs WHERE playlistId='$userPlaylistId'");
}
else {
    echo "playlistId was not passed into deletePlaylist.php";
}
?>