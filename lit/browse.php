<?php 
include("includes/included.php");
?>

<h1 class="pageHeading">
    Here's some music you might like.
</h1>

<div class="gridViewContainer">

    <?php 
    $albumQuery = mysqli_query($connection, "SELECT * FROM albums ORDER BY RAND() LIMIT 3");
    while($row = mysqli_fetch_array($albumQuery)) {
        /* Takes the query and converts the result into an array
         so each row contains the row of the album table returned. */
    echo "<div class='gridViewItem'>
        <span role='link' tabindex='0' onclick='changePage(\"album.php?id=" . $row['id'] . "\")'>
        <img src='" . $row['artworkPath'] . "'>

        <div class='gridViewInfo'>"
        . $row['title'] .
        "</div>
        </span>

    </div>";
        
    }
    ?>

<!-- ** DUPLICATED CODE TO SHOW THAT THE PAGE CAN HOLD MORE THAN 3 TRACKS ** -->
    <?php 

    $albumQuery = mysqli_query($connection, "SELECT * FROM albums ORDER BY RAND() LIMIT 3");
    while($row = mysqli_fetch_array($albumQuery)) {
        /* Takes the query and converts the result into an array
         so each row contains the row of the album table returned. */
    echo "<div class='gridViewItem'>
        <span role='link' tabindex='0' onclick='changePage(\"album.php?id=" . $row['id'] . "\")'>
        <img src='" . $row['artworkPath'] . "'>

        <div class='gridViewInfo'>"
        . $row['title'] .
        "</div>
        </span>

    </div>";
        
    }
    ?>

</div>