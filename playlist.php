<?php 

include("includes/included.php"); 

if(isset($_GET['id'])) {
    $userPlaylistId = $_GET['id'];
}
else {
    header("Location: index.php");
}

$userPlaylist = new Playlist($dbConnection, $userPlaylistId);
$owner = new User($dbConnection, $userPlaylist->getOwner());
?>
<!-- Header includes all code from navigation bar up to main content -->


<div class="entityInfo">
    <div class="leftSection">
        <div class='playlistIcon'>
            <img src='assets/images/icons/playlist.png'>
        </div>
    </div>
    <div class="rightSection">
        <h2><?php echo $userPlaylist->getTheName(); ?></h2>
        <p>By <?php echo $userPlaylist->getOwner(); ?></p>
        <p><?php echo $userPlaylist->getSongTotal(); ?> song(s)</p>
        <p><?php echo $userPlaylist->getDateMade(); ?></p>
        <div class="mainButton deletePlaylist" onclick="deletePlaylist('<?php echo $userPlaylistId; ?>')">
            <button>DELETE</button>
        </div>
    </div>
</div>

<div class="songListContainer">
    <ul class="songList">
        
        <?php 
        $songIdArray = $userPlaylist->getSongIds();
        $x = 1;
        
        foreach($songIdArray as $songId) {
            $userPlaylistTrack = new Song($dbConnection, $songId);
            $songArtist = $userPlaylistTrack->getMusicArtist();
            echo "<li class='songListRow'>
                    <div class ='songCount'>
                        <img class='play' src='assets/images/icons/play.png' onclick='setTrack(\"" . $userPlaylistTrack->getId() . "\", temporaryPlaylist, true)'>
                        <span class='songNumber'>$x</span>
                    </div>

                    <div class='songInfo'>
                        <span class='songName'>" . $userPlaylistTrack->getTitle() . "</span>
                        <span class='songArtist'>" . $songArtist->getTheName() . "</span>
                    </div>

                    <div class='songOptions'>
                        <input class='songId' type='hidden' value='" . $userPlaylistTrack->getId() . "'>
                        <img class='optionsButton' src='assets/images/icons/settings.png' onclick='showOptions(this)'>
                    </div>

                    <div class='songDuration'>
                        <span class='duration'>" . $userPlaylistTrack->getDuration() . "</span>
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
        <div class="item" onclick="deleteFromPlaylist(this, '<?php echo $userPlaylistId; ?>')">Remove from playlist</div>
</nav>