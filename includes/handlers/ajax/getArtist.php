<?php 
include("../../config.php");

if(isset($_POST['artistId'])) {
    $artistId = $_POST['artistId'];

    $artistQuery = mysqli_query($dbConnection, "SELECT * FROM artists WHERE id='$artistId'");

    $artistArray = mysqli_fetch_array($artistQuery);
    //converts result query to an array

    echo json_encode($artistArray);

}

?>