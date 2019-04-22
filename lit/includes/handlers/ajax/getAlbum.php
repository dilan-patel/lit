<?php 
include("../../config.php");

if(isset($_POST['albumId'])) {
    $albumId = $_POST['albumId'];

    $albumQuery = mysqli_query($connection, "SELECT * FROM albums WHERE id='$albumId'");

    $albumArray = mysqli_fetch_array($albumQuery);
    //converts result query to an array

    echo json_encode($albumArray);

}

?>