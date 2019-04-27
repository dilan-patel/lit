<div id="navContainer">
    <nav class="navBar">
        <span role="link" tabindex="0" onclick="changePage('index.php')" class="logo">
            LIT🔥
        </span>
        <div class="groups">
            <div class="navContent">
                <img class="icon" src="assets/images/icons/search.png" alt="Search">
                <span role="link" tabindex="0" onclick="changePage('search.php')"  class="navContentLink">Search</span>
            </div>
        </div>
        <div class="groups">
            <div class="navContent">
                <img src="assets/images/icons/cd-collection.png" alt="Browse">
                <span role="link" tabindex="0" onclick="changePage('browse.php')" class="navContentLink">Browse</span>
            </div>
            <div class="navContent">
                <img src="assets/images/icons/playlist.png" alt="Playlists">
                <span role="link" tabindex="0" onclick="changePage('playlists.php')" class="navContentLink">Playlists</span>
            </div>
            <div class="navContent">
                <img src="assets/images/icons/user.png" alt="User" style="margin-top:9px;">
                <span role="link" tabindex="0" onclick="changePage('profile.php')" class="navContentLink"><?php echo $userLoggedIn->getFullName();?></span>
            </div>
        </div>
    </nav>
</div>