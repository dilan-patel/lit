<?php 
$songs = mysqli_query($dbConnection, "SELECT id FROM songs ORDER BY RAND() LIMIT 107");

$userPlaylistArray = array();

while ($songRow = mysqli_fetch_array($songs)){
    array_push($userPlaylistArray, $songRow['id']);
}
// Creates array of 7 random songs as a playlist.

$jsonPlaylistArray = json_encode($userPlaylistArray);
?>

<script>
    
$(document).ready(function() {
    
    var newUserPlaylist = <?php echo $jsonPlaylistArray; ?>;
    audioElement = new Audio();
    setTrack(newUserPlaylist[0], newUserPlaylist, false);
    volumeProgressBarUpdate(audioElement.audio);

    $("#bottomMusicPlayer.php").on("mousedown touchstart mousemove touchmove", function(event) {
        event.preventDefault();
    });

    $(".playingBar .progressBar").mousedown(function() {
        mouseClicked = true;
	});

	$(".playingBar .progressBar").mousemove(function(event) {
		if(mouseClicked == true) {
			//Set time of song, depending on position of mouse
			timeFromPosition(event, this);
		}
	});

	$(".playingBar .progressBar").mouseup(function(e) {
		timeFromPosition(e, this);
	});
    
    $(".volumeBar .progressBar").mousedown(function() {
		mouseClicked = true;
	});

	$(".volumeBar .progressBar").mousemove(function(event) {
		if(mouseClicked == true) {

			var volumePercentage = event.offsetX / $(this).width();

			if(volumePercentage >= 0 && volumePercentage <= 1) {
				audioElement.audio.volume = volumePercentage;
			}
		}
	});

	$(".volumeBar .progressBar").mouseup(function(event) {
		var volumePercentage = event.offsetX / $(this).width();

		if(volumePercentage >= 0 && volumePercentage <= 1) {
			audioElement.audio.volume = volumePercentage;
		}
    });
    
    $(document).mouseup(function() {
        mouseClicked = false;
    });
});

function timeFromPosition(event, progressBar) {
    var progressPercentage = event.offsetX/$(progressBar).width()*100;
    var dragTime = audioElement.audio.duration*progressPercentage/99;
    audioElement.setTime(dragTime);
}

function nextSong() {
    if (repeat == true) {
        audioElement.setTime(0);
        playAudio();
        return;
    }

    if (currentSong == currentSong.length - 1) {
        currentSong = 0;
    }
    else {
        currentSong++;
    }

    var songToPlay = shuffle ? randomPlaylist[currentSong] : currentPlaylist[currentSong];
    setTrack(songToPlay, currentPlaylist, true);
}

function previousSong() {
    if (audioElement.audio.currentTime >= 4 || currentSong == 0 ) {
        audioElement.setTime(0);
    }
    else {
        currentSong = currentSong - 1;
        setTrack(currentPlaylist[currentSong], currentPlaylist, true);
    }
}

function setRepeat() {
    repeat = !repeat;
    // shorter if stay to figure out if repeat is true or false.
    var imageName = repeat ? "repeat-on.png" : "repeat.png";
    $(".controlButtons.repeat img").attr("src", "assets/images/icons/" + imageName);
}

function setMute() {
    audioElement.audio.muted = !audioElement.audio.muted;
    var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume-loud.png";
    $(".controlButtons.volume img").attr("src", "assets/images/icons/" + imageName);
    
}

function setShuffle() {
    shuffle = !shuffle;
    var imageName = shuffle ? "shuffle-on.png" : "shuffle.png";
    $(".controlButtons.shuffle img").attr("src", "assets/images/icons/" + imageName);

    if (shuffle == true) {
        //Randomize Playlist
        randomizeArray(randomPlaylist);
        currentSong = randomPlaylist.indexOf(audioElement.currentlyPlaying.id);
    }
    else { 
        //Shuffle deactivated = reg playlist;
        currentSong = currentPlaylist.indexOf(AudioElement.currentlyPlaying.id);
    }
}

function randomizeArray(a) {
    //code algorithm Fisher-Yates for random shuffle.
    var x, y, i;
    for (i = a.length - 1; i > 0; i--) {
        x = Math.floor(Math.random() * (i + 1));
        y = a[i];
        a[i] = a[x];
        a[x] = y;
    }
    return a;
}

function setTrack(trackId, newUserPlaylist, play) {
    
    if(newUserPlaylist != currentPlaylist) {
        currentPlaylist = newUserPlaylist;
        randomPlaylist = newUserPlaylist.slice();
        randomizeArray(randomPlaylist);
    }

    if(shuffle == true) {
        currentSong = randomPlaylist.indexOf(trackId);
    }
    else {
        currentSong = currentPlaylist.indexOf(trackId);
    }
    pauseAudio();

    //ajax call = specify page, what values passed in, then what is done with the result.
    $.post("includes/handlers/ajax/getSong.php", {songId: trackId}, function(data) {

        var findSong = JSON.parse(data);
        
        $("span.playerSongName").text(findSong.title);
        //retrieves song(playing) title from database to display

        $.post("includes/handlers/ajax/getArtist.php", {artistId: findSong.artist}, function(data) {
            var findArtist = JSON.parse(data);
            $("span.playerSongArtist").text(findArtist.artist);
            //retrieves artist of song(playing) from database to display
            $(".songInfo span.playerSongArtist").attr("onclick", "changePage('artist.php?id=" + findArtist.id + "')");
            //allows user to click on link to artist page using changing url function and retrieving id from database
            
        });

        $.post("includes/handlers/ajax/getAlbum.php", {albumId: findSong.album}, function(data) {
            var findAlbum = JSON.parse(data);
            $(".contents img.playerAlbumArt").attr("src", findAlbum.artworkPath);
            //retrieves album of song(playing) title from database to display
            $(".contents img.playerAlbumArt").attr("onclick", "changePage('album.php?id=" + findAlbum.id + "')");
            //allows user to click on link to album page using changing url function and retrieving id from database
            $(".songInfo span.playerSongName").attr("onclick", "changePage('album.php?id=" + findAlbum.id + "')");
        });
        

        console.log(audioElement);
        audioElement.setTrack(findSong);

        if(play == true) {
            playAudio();
        }

    });

    
}

function playAudio() {

    if(audioElement.audio.currentTime == 0) {
        $.post("includes/handlers/ajax/updateSongPlays.php",  {songId: audioElement.currentlyPlaying.id});
    }

    $(".controlButtons.play").hide();
    $(".controlButtons.pause").show();
    audioElement.play();
}

function pauseAudio() {
    $(".controlButtons.pause").hide();
    $(".controlButtons.play").show();
    audioElement.pause();
}

</script>

<div id="bottomMusicPlayerContainer">

    <div id="musicPlayerLeft">
        <div class="contents">
            <span class="linkAlbum">
                <img role="link" tabindex="0" class="playerAlbumArt" src="">
            </span>
            <div class="songInfo">
                <span role="link" tabindex="0" class="playerSongName"></span>
                <span role="link" tabindex="0" class="playerSongArtist"></span>
            </div>
        </div>
    </div>

    <div id="musicPlayerMiddle">
        <div class="contents controls">
            <div class="buttons">
                <button class="controlButtons shuffle" title="Shuffle" onclick="setShuffle()">
                    <img src="assets/images/icons/shuffle.png" alt="Shuffle" sy>
                </button>
                <button class="controlButtons previous" title="Previous" onclick="previousSong()">
                    <img src="assets/images/icons/previous.png" alt="Previous">
                </button>
                <button class="controlButtons play" title="Play" onclick="playAudio()">
                    <img src="assets/images/icons/play.png" alt="Play">
                </button>
                <button class="controlButtons pause" title="Pause" style="display: none;" onclick="pauseAudio()">
                    <img src="assets/images/icons/pause.png" alt="Pause">
                </button>
                <button class="controlButtons next" title="Next" onclick="nextSong()">
                    <img src="assets/images/icons/next.png" alt="Next">
                </button>
                <button class="controlButtons repeat" title="Repeat" onclick="setRepeat()">
                    <img src="assets/images/icons/repeat.png" alt="Repeat">
                </button>
            </div>

            <div class="playingBar">
                <span class="progressTimer current">0:00</span>

                <div class="progressBar">
                    <div class="progressBackground">
                        <div class="progress"></div>
                    </div>
                </div>

                <span class="progressTimer remaining">0:00</span>
            </div>
        </div>
    </div>

    <div id="musicPlayerRight">
        <div class="volumeBar">
            <button class="controlButtons volume" title="Volume" onclick="setMute()">
                <img src="assets/images/icons/volume-loud.png" alt="Volume">
            </button>
            <div class="progressBar">
                <div class="progressBackground">
                    <div class="progress"></div>
                </div>
            </div>
        </div>
    </div>

</div>