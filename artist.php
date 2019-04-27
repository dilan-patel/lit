<?php
include("includes/included.php");

if(isset($_GET['id'])) {
    //if ID in URL provided, artistId is set to url ID
    $artistId = $_GET['id'];
}
else {
    header("Location: index.php");
}

$artist = new Artist($dbConnection, $artistId);

?>

<div class="entityInfo">

    <div class="middleSection">

        <div class=artistInfo>
            <h1 class="mainHeader artistName"> <?php echo $artist->getTheName(); ?></h1>
            <div class="mainButton">
                <button onclick="playFirstTrack()">PLAY</button>
            </div>
        </div>

    </div>

</div>

<div class="songListContainer borderBottom">
    <ul class="songList">

        <?php 
        $songIdArray = $artist->getSongIds();
        $x = 1;
        
        foreach($songIdArray as $songId) {

            if($x > 2) {
                //only shows two songs, can be increased/decreased to show as many as specified
                break;
            }

            $albumTrack = new Song($dbConnection, $songId);
            $albumArtist = $albumTrack->getMusicArtist();
            echo "<li class='songListRow'>
                    <div class ='songCount'>
                        <img class='play' src='assets/images/icons/play.png' onclick='setTrack(\"" . $albumTrack->getId() . "\", temporaryPlaylist, true)'>
                        <span class='songNumber'>$x</span>
                    </div>

                    <div class='songInfo'>
                        <a class='popularSong'>🔥</a>
                        <span class='songName'>" . $albumTrack->getTitle() . "</span>
                        <span class='songArtist'>" . $albumArtist->getTheName() . "</span>
                    </div>

                    <div class='songOptions'>
                        <input class='songId' type='hidden' value='" . $albumTrack->getId() . "'>
                        <img class='optionsButton' src='assets/images/icons/settings.png' onclick='showOptions(this)'>
                    </div>

                    <div class='songDuration'>
                        <span class='duration'>" . $albumTrack->getDuration() . "</span>
                    </div>
                </li>";
                $x++;
        }

        ?>

        <script>
            var temporarySongIds = '<?php echo json_encode($songIdArray); ?>';
            temporaryPlaylist = JSON.parse(temporarySongIds);
        </script>
    </ul>
</div>

<div class="gridViewContainer">
    <h2>Albums by <?php echo $artist->getTheName(); ?></h2>
    <?php 
    $albumSearch = mysqli_query($dbConnection, "SELECT * FROM albums WHERE artist='$artistId'");
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

<nav class="optionsMenu">
        <input type="hidden" class="songId">
        <?php echo Playlist::getPlaylistDropdown($dbConnection, $userLoggedIn->getAccountUsername());?>
</nav>