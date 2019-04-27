<?php 
include("includes/included.php");
?>

<div class="userDetails">

    <div class="container borderBottom">
        <h2 style="margin-block-start: 0em;">E-mail</h2>
        <input type="text" class="email" name="email" placeholder="Enter a new e-mail address." value="<?php $userLoggedIn->getEmail()?>">
        <span class="message">Update your e-mail address.</span>
        <div class="mainButton" style="padding: 10px;">
            <button class="updateButton" onclick="updateEmail('email')">SAVE</button>
        </div>
    </div>

    <div class="container">
        <h2>Password</h2>
        <input type="password" class="oldPassword" name="oldPassword" placeholder="Enter your current password.">
        <input type="password" class="newPassword1" name="newPassword1" placeholder="Enter your new password.">
        <input type="password" class="newPassword2" name="newPassword2" placeholder="Confirm the new password.">
        <span class="message">Set a new password.</span>
        <div class="mainButton" style="padding: 15px;">
            <button class="updateButton" onclick=" updatePassword('oldPassword', 'newPassword1', 'newPassword2')">SAVE</button>
        </div>
    </div>

</div>