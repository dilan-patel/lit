<?php 

include("includes/included.php"); 

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
}
else {
    header("Location: index.php");
}

$album = new Album($connection, $albumId);
$artist = $album->getArtist();
$artistId = $artist->getId();
?>
<!-- Header includes all code from navigation bar up to main content -->


<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>">
    </div>
    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getSongTotal(); ?> song(s)</p>
    </div>
</div>

<div class="songListContainer">
    <ul class="songList">
        
        <?php 
        $songIdArray = $album->getSongIds();
        $x = 1;
        
        foreach($songIdArray as $songId) {
            $albumTrack = new Song($connection, $songId);
            $albumArtist = $albumTrack->getArtist();
            echo "<li class='songListRow'>
                    <div class ='songCount'>
                        <img class='play' src='assets/images/icons/play.png' onclick='setTrack(\"" . $albumTrack->getId() . "\", tempPlaylist, true)'>
                        <span class='songNumber'>$x</span>
                    </div>

                    <div class='songInfo'>
                        <span class='songName'>" . $albumTrack->getTitle() . "</span>
                        <span class='songArtist'>" . $albumArtist->getName() . "</span>
                    </div>
    
                    <div class='songOptions'>
                        <input type='hidden' class='songId' value='" . $albumTrack->getId() . "'>
                        <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptions(this)'>
                    </div>

                    <div class='songDuration'>
                        <span class='duration'>" . $albumTrack->getDuration() . "</span>
                    </div>
                </li>";
                $x++;
        }

        ?>

        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>

<nav class="optionsMenu">
        <input type="hidden" class="songId">
        <?php echo Playlist::getPlaylistDropdown($connection, $userLoggedIn->getUsername());?>
</nav>