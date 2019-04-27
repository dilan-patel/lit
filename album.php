<?php 

include("includes/included.php"); 

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
}
else {
    header("Location: index.php");
}

$album = new Album($dbConnection, $albumId);
$artist = $album->getMusicArtist();
$artistId = $artist->getId();
?>
<!-- Header includes all code from navigation bar up to main content -->


<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>">
    </div>
    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getTheName(); ?></p>
        <p><?php echo $album->getSongTotal(); ?> song(s)</p>
    </div>
</div>

<div class="songListContainer">
    <ul class="songList">
        
        <?php 
        $songIdArray = $album->getSongIds();
        $x = 1;
        
        foreach($songIdArray as $songId) {
            $albumTrack = new Song($dbConnection, $songId);
            $albumArtist = $albumTrack->getMusicArtist();
            echo "<li class='songListRow'>
                    <div class ='songCount'>
                        <img class='play' src='assets/images/icons/play.png' onclick='setTrack(\"" . $albumTrack->getId() . "\", temporaryPlaylist, true)'>
                        <span class='songNumber'>$x</span>
                    </div>

                    <div class='songInfo'>
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

<nav class="optionsMenu">
        <input type="hidden" class="songId">
        <?php echo Playlist::getPlaylistDropdown($dbConnection, $userLoggedIn->getAccountUsername());?>
</nav>