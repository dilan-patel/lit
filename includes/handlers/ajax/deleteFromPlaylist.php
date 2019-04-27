<?php
include("../../config.php");

if(isset($_POST['playlistId']) && isset($_POST['songId'])) {
    $userPlaylistId = $_POST['playlistId'];
    $songId = $_POST['songId'];
    $query = mysqli_query($dbConnection, "DELETE FROM playlistSongs WHERE playlistId='$userPlaylistId' AND songId='$songId'");
}
else {
    echo "playlistId or songId was not passed into deletePlaylist.php";
}
?>