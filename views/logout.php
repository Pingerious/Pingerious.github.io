<?php
    session_start();

    //REMOVE ALL SESSION VARIABLES
    session_unset();

    //DESTROY THE SESSION
    session_destroy();

    header("location: login.php");
    exit;
?>