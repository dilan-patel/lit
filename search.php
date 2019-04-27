<?php 
include("includes/included.php");

if(isset($_GET['query'])) {
    $query= urldecode($_GET['query']);
    //decodes query from url to allow spaces etc.
}
else {
    $query= "";
}
?>

<div class="entityInfo">
    <div class="searchContainer">
        <h4>Find your favourite songs, artist or albums.</h4>
        <input type="text" class="searchBar" autofocus value="<?php echo $query; ?>" onfocus="this.value = this.value;" placeholder="Enter your search here">
    </div>
</div>

<script>
    $(document).ready(function(){
        // moves the cursor to the end of the users last input before refresh
        $(".searchBar").focus();
        var newInput = $(".searchBar").val();
        $(".searchBar").val('');
        $(".searchBar").val(newInput);
    })

    $(function() {
        // refreshes page on each time user types a word after 500ms (2s)
        
        $(".searchBar").keyup(function() {
            clearTimeout(refresh);
            //restarts refresher to wait for user to finish typing
            refresh = setTimeout(function() {
                var value = $(".searchBar").val();
                changePage('search.php?query=' + value);
            }, 500);
        })
    })

</script>


<div class="songListContainer borderBottom">
    <ul class="songList">

        <?php 

        $songSearch = mysqli_query($dbConnection, "SELECT id FROM songs WHERE title LIKE '$query%' LIMIT 15");
        $songIdArray = array();
        $x = 1;

        if(mysqli_num_rows($songSearch) == 0) {
            echo '<span class="noResult" style="margin-left:430px;">No songs were found.</span>';
        }
        
        while($songRow = mysqli_fetch_array($songSearch)) {

            if($x > 15) {
                //only shows 15 , can be increased/decreased to show as many as specified
                break;
            }

            array_push($songIdArray, $songRow['id']);

            $albumTrack = new Song($dbConnection, $songRow['id']);
            $albumArtist = $albumTrack->getMusicArtist();
            echo "<li class='songListRow'>
                    <div class ='songCount'>
                        <img class='play' src='assets/images/icons/play.png' onclick='setTrack(\"" . $albumTrack->getId() . "\", temporaryPlaylist, true)'>
                        <span class='songNumber'>$x</span>
                    </div>

                    <div class='songInfo'>
                        <a class='popularSong'>🎵</a>
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

<div class="artistContainer borderBottom">
        <h2>Artists</h2>
        

        <?php 
        $artistSearch = mysqli_query($dbConnection,  "SELECT id FROM artists WHERE artist LIKE '%$query%' LIMIT 15");

        if(mysqli_num_rows($artistSearch) == 0) {
            echo '<span class="noResult" style="margin-left: 430px;">No artists were found.</span>';
        }

        while($songRow = mysqli_fetch_array($artistSearch)) {
            $artistResult = new Artist($dbConnection, $songRow['id']);
            echo "<div class='resultRow'>
                    <div class='artistName .artistSearch'>
                        <a class='popularSong'>🎤</a>
                        <span class='artistText' role='link' tabindex='0' onclick='changePage(\"artist.php?id=" . $artistResult->getId() ."\")'>
                        "
                            . $artistResult->getTheName() .
                        "
                        </span>
                        
                    </div> 
                </div>";
        }
        ?>
</div>

<div class="gridViewContainer">
    <h2>Albums</h2>
    <?php 
    $albumSearch = mysqli_query($dbConnection, "SELECT * FROM albums WHERE title LIKE '%$query%' LIMIT 3");
    
    if(mysqli_num_rows($albumSearch) == 0) {
        echo '<span class="noResult" style="margin-left: 430px;">No albums were found.</span>';
    }
    
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
