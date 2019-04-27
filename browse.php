<?php 
include("includes/included.php");
?>

<h1 class="pageHeading">
    Here's some music you might like.
</h1>

<div class="gridViewContainer">

    <?php 
    $albumSearch = mysqli_query($dbConnection, "SELECT * FROM albums ORDER BY RAND() LIMIT 3");
    while($songRow = mysqli_fetch_array($albumSearch)) {
        /* Takes the query and converts the result into an array
         so each row contains the row of the album table returned. */
    echo "<div class='gridViewItem'>
        <span role='link' tabindex='0' onclick='changePage(\"album.php?id=" . $songRow['id'] . "\")'>
        <img src='" . $songRow['artworkPath'] . "'>

        <div class='gridViewInfo'>"
        . $songRow['title'] .
        "</div>
        </span>

    </div>";
        
    }
    ?>

<!-- ** DUPLICATED CODE TO SHOW THAT THE PAGE CAN HOLD MORE THAN 3 TRACKS ** -->
    <?php 

    $albumSearch = mysqli_query($dbConnection, "SELECT * FROM albums ORDER BY RAND() LIMIT 3");
    while($songRow = mysqli_fetch_array($albumSearch)) {
        /* Takes the query and converts the result into an array
         so each row contains the row of the album table returned. */
    echo "<div class='gridViewItem'>
        <span role='link' tabindex='0' onclick='changePage(\"album.php?id=" . $songRow['id'] . "\")'>
        <img src='" . $songRow['artworkPath'] . "'>

        <div class='gridViewInfo'>"
        . $songRow['title'] .
        "</div>
        </span>

    </div>";
        
    }
    ?>

</div>