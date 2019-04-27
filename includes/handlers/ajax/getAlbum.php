<?php 
include("../../config.php");

if(isset($_POST['albumId'])) {
    $albumId = $_POST['albumId'];

    $albumSearch = mysqli_query($dbConnection, "SELECT * FROM albums WHERE id='$albumId'");

    $albumArray = mysqli_fetch_array($albumSearch);
    //converts result query to an array

    echo json_encode($albumArray);

}

?>