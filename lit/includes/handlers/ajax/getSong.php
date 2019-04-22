<?php 
include("../../config.php");

if(isset($_POST['songId'])) {
    $songId = $_POST['songId'];

    $songQuery = mysqli_query($connection, "SELECT * FROM songs WHERE id='$songId'");

    $songArray = mysqli_fetch_array($songQuery);
    //converts result query to an array

    echo json_encode($songArray);

}

?>