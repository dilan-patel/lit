<?php
include("includes/included.php");
?>

<div class="entityInfo">
    <div class="middleSection" style="text-align: center;">
        <h2 style="padding: 10px; color: white;"><?php echo $userLoggedIn->getFullName();?></h2>
        <div class="mainButton" style="padding: 15px;">
            <button class="buttonItem" onclick="changePage('update.php')">USER DETAILS</button>
        </div>
        <div class="mainButton" style="padding: 15px;">
            <button class="buttonItem" onclick="logout()">LOG OUT</button>
        </div>
    </div>
        
</div>