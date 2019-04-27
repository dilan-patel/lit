<?php 

    ob_start(); //Output buffering, waits until all data is available before sending to the server.
    session_start(); //Enables use of sessions.

    $timezone = date_default_timezone_set("Europe/London"); //Timezone used for database.
    $dbConnection = mysqli_connect("localhost", "root", "", "lit"); //Server name, Username, Password, Database Name

    if(mysqli_connect_errno()) {
        //Error message if there was an error in connecting to the database.
        echo "Failed to connect: " . mysqli_connect_errno();
    }



?>