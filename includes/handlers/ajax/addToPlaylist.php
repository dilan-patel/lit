<?php

include("../../config.php");

if(isset($_POST['playlistId']) && isset($_POST['songId'])) {
    $userPlaylistId = $_POST['playlistId'];
    $songId = $_POST['songId'];
    $orderId = mysqli_query($dbConnection, "SELECT MAX(songOrder) + 1 AS songOrder FROM playlistSongs WHERE playlistId='$userPlaylistId'");
    $songRow = mysqli_fetch_array($orderId);
    $order = $songRow['songOrder'];
    $query = mysqli_query($dbConnection, "INSERT INTO playlistSongs VALUE('', '$songId', '$userPlaylistId', '$order')");
}
else {
    echo "playlistId or songId was not passed into addToPlaylist.php";
}


?>