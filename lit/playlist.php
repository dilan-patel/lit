<?php 

include("includes/included.php"); 

if(isset($_GET['id'])) {
    $playlistId = $_GET['id'];
}
else {
    header("Location: index.php");
}

$playlist = new Playlist($connection, $playlistId);
$owner = new User($connection, $playlist->getOwner());
?>
<!-- Header includes all code from navigation bar up to main content -->


<div class="entityInfo">
    <div class="leftSection">
        <div class='playlistIcon'>
            <img src='assets/images/icons/playlist.png'>
        </div>
    </div>
    <div class="rightSection">
        <h2><?php echo $playlist->getName(); ?></h2>
        <p>By <?php echo $playlist->getOwner(); ?></p>
        <p><?php echo $playlist->getSongTotal(); ?> song(s)</p>
        <p><?php echo $playlist->getDateMade(); ?></p>
        <div class="mainButton deletePlaylist" onclick="deletePlaylist('<?php echo $playlistId; ?>')">
            <button>DELETE</button>
        </div>
    </div>
</div>

<div class="songListContainer">
    <ul class="songList">
        
        <?php 
        $songIdArray = $playlist->getSongIds();
        $x = 1;
        
        foreach($songIdArray as $songId) {
            $playlistTrack = new Song($connection, $songId);
            $songArtist = $playlistTrack->getArtist();
            echo "<li class='songListRow'>
                    <div class ='songCount'>
                        <img class='play' src='assets/images/icons/play.png' onclick='setTrack(\"" . $playlistTrack->getId() . "\", tempPlaylist, true)'>
                        <span class='songNumber'>$x</span>
                    </div>

                    <div class='songInfo'>
                        <span class='songName'>" . $playlistTrack->getTitle() . "</span>
                        <span class='songArtist'>" . $songArtist->getName() . "</span>
                    </div>

                    <div class='songOptions'>
                        <input type='hidden' class='songId' value='" . $playlistTrack->getId() . "'>
                        <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptions(this)'>
                    </div>

                    <div class='songDuration'>
                        <span class='duration'>" . $playlistTrack->getDuration() . "</span>
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
        <div class="item" onclick="deleteFromPlaylist(this, '<?php echo $playlistId; ?>')">Remove from playlist</div>
</nav>