<?php

include("../../config.php");

if(isset($_POST['playlistId'])) {
    $playlistId = $_POST['playlistId'];

    $playlistDelete = mysqli_query($connection, "DELETE FROM playlists WHERE id='$playlistId'");
    $songsDelete = mysqli_query($connection, "DELETE FROM playlistSongs WHERE playlistId='$playlistId'");
}
else {
    echo "playlistId was not passed into deletePlaylist.php";
}
?>