<?php

include("../../config.php");

if(isset($_POST['playlistId']) && isset($_POST['songId'])) {
    $playlistId = $_POST['playlistId'];
    $songId = $_POST['songId'];
    $orderId = mysqli_query($connection, "SELECT MAX(songOrder) + 1 AS songOrder FROM playlistSongs WHERE playlistId='$playlistId'");
    $row = mysqli_fetch_array($orderId);
    $order = $row['songOrder'];
    $query = mysqli_query($connection, "INSERT INTO playlistSongs VALUE('', '$songId', '$playlistId', '$order')");
}
else {
    echo "playlistId or songId was not passed into addToPlaylist.php";
}


?>