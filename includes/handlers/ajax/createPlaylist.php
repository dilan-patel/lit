<?php
include("../../config.php");

if(isset($_POST['name']) && isset($_POST['name'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $date = date('Y-m-d H:i:s');
    $query = mysqli_query($dbConnection, "INSERT INTO playlists VALUES('', '$name', '$username', '$date')");
}
else {
    echo "'Name' and 'Username' parameters not passed into file.";
}

?>