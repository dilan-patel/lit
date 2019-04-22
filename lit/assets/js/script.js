var currentPlaylist = [];
var randomPlaylist = [];
var tempPlaylist= [];
var audioElement;
var mouseClicked = false;
var currentSong = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var refresh;

$(document).click(function(click) {
	var target = $(click.target);

	if(!target.hasClass("item") && !target.hasClass("optionsButton")) {
		hideOptions();
	}
});

$(window).scroll(function() {
	hideOptions();
});

$(document).on("change", "select.playlist", function() {
	var select = $(this);
	var playlistId = select.val();
	var songId = select.prev(".songId").val();
	//selects dropdown menu thats currently selected
	$.post("includes/handlers/ajax/addToPlaylist.php", { playlistId: playlistId, songId: songId })
	.done(function(error) {

		if (error != "") {
			//checks if user input is empty to display error
			alert(error);
			return;
		}

		hideOptions();
		select.val("");
		//resets dropdown to 'Add to playlist'
	});
});

function playFirstTrack() {
	setTrack(tempPlaylist[0], tempPlaylist, true);
}

function logout() {
	$.post("includes/handlers/ajax/logout.php", function() {
		location.reload();
	});
}

function updateEmail(emailClass) {
	var emailValue = $("." + emailClass).val();

	$.post("includes/handlers/ajax/updateEmail.php", {email: emailValue, username: userLoggedIn})
	.done(function(response) {
		$("." + emailClass).nextAll(".message").text(response);
	});
}

function updatePassword(oldPasswordClass, newPasswordClass1, newPasswordClass2) {
	var oldPassword = $("." + oldPasswordClass).val();
	var newPassword1 = $("." + newPasswordClass1).val();
	var newPassword2 = $("." + newPasswordClass2).val();

	$.post("includes/handlers/ajax/updatePassword.php", 
	{oldPassword: oldPassword, newPassword1: newPassword1, newPassword2: newPassword2, username: userLoggedIn})
	.done(function(response) {
		$("." + oldPasswordClass).nextAll(".message").text(response);
	});
}

function changePage(url) {
	//seamless page transitions
	if (refresh != null) {
		//prevents search from refreshing when moving out the page during search.
		clearTimeout(refresh);
	}
	if (url.indexOf("?") == -1) {
		//-1 is given if '?' isn't found
		//adds '?' for link if it doesnt contain one at the start.
		url = url + "?";
	}
	var urlEncoded = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
	//converts characters to encoded version
	$("#mainContent").load(urlEncoded);
	$("body").scrollTop(0);
	//scrolls to top of page on changing page.
	history.pushState(null, null, url);
	//places url into address bar to look like webpage changed.
}

function deleteFromPlaylist(button, playlistId) {
	var songId = $(button).prevAll(".songId").val();
	$.post("includes/handlers/ajax/deleteFromPlaylist.php", { playlistId: playlistId, songId: songId }).done(function(error) {
		//executes AJAX response to allow SQL querys to work through JS
		if (error != "") {
			//checks if user input is empty to display error
			alert(error);
			return;
		}
		changePage("playlist.php?id="+ playlistId);
	});

}

function createPlaylist() {
	var inputAlert = prompt("Please enter a name for your playlist:");
	//shows alert asking for user input.
	if(inputAlert != null) {
		//checks if input was filled in.
		$.post("includes/handlers/ajax/createPlaylist.php", { name: inputAlert, username: userLoggedIn }).done(function(error) {
			//executes AJAX response to allow SQL querys to work through JS
			if (error != "") {
				//checks if user input is empty to display error
				alert(error);
				return;
			}
			changePage("playlists.php");
		});
	}
}

function deletePlaylist(playlistId) {
	var deleteAlert = confirm("Are you sure you want to delete this playlist?");
	if(deleteAlert == true) {
		$.post("includes/handlers/ajax/deletePlaylist.php", { playlistId: playlistId }).done(function(error) {
			//executes AJAX response to allow SQL querys to work through JS
			if (error != "") {
				//checks if user input is empty to display error
				alert(error);
				return;
			}
			changePage("playlists.php");
		});
	}
}


function showOptions(button) {
	var songId = $(button).prevAll(".songId").val();

	//retrieves optionsMenu element to display on application.
	var menu = $(".optionsMenu");
	//calculation for options menu *correct* position.
	var menuWidth = menu.width();
	//finds songId to put into optionsMenu
	menu.find(".songId").val(songId)
	var scrollTop = $(window).scrollTop();
	//distance from top of window to top of document
	var elementOffset = $(button).offset().top;
	//gets position of button from top of document. Converted into jquery so button can use jquery functions.
	var top = elementOffset - scrollTop;
	//distance from current button to top of document.
	var right = $(button).position().right;
	menu.css({
		"top": top + 8 + "px",
		"right": +menuWidth - 100 + "px",
		"display": "inline"
	  });
}


function hideOptions() {
	var menu = $(".optionsMenu");
	if(menu.css("display") != "none") {
		menu.css("display", "none");
	}
}

function timeFormat(secs) {
    //formats time from seconds to minutes (user friendly)
    var time = Math.round(secs);
    //rounds seconds
    var min = Math.floor(time / 60);
    // figures out whole minutes in total time
    var sec = time - (min * 60)
    //figures out seconds left;
    var add0 = (sec < 10) ? "0" : "";
    //If song has remainder less than 10 seconds, it adds a zero to be displayed.
    //e.g 2 minutes 3 seconds is 2:03, not 2:3
    return min + ":" + add0 + sec;
}

function timeProgressBarUpdate(audio) {
	$(".progressTimer.current").text(timeFormat(audioElement.audio.currentTime));
	$(".progressTimer.remaining").text(timeFormat(audioElement.audio.duration - audioElement.audio.currentTime));
	var progress = audioElement.audio.currentTime / audioElement.audio.duration * 100;
	$(".playingBar .progress").css("width", progress + "%");
}

function volumeProgressBarUpdate(audio) {
	var volume = audioElement.audio.volume * 100;
	$(".volumeBar .progress").css("width", volume + "%");
}

function Audio() {
	this.currentlyPlaying;
	this.audio = document.createElement('audio');
	this.audio.addEventListener("canplay", function() {
		var duration = timeFormat(this.duration);
		$(".progressTime.remaining").text(duration);
	});
	this.audio.addEventListener("timeupdate", function () {
        if (this.duration) {
            timeProgressBarUpdate()
        }
	});
	this.audio.addEventListener("volumechange", function() {
		volumeProgressBarUpdate(this);
	});
	this.setTrack = function(findSong) {
		this.currentlyPlaying = findSong;
		this.audio.src = findSong.path;
	}
	this.play = function() {
		this.audio.play();
	}
	this.pause = function() {
		this.audio.pause();
	}
	this.setTime = function(seconds) {
		this.audio.currentTime = seconds;
	}
}



