<?php
    include ('../includes/header.php');

    if ($_SESSION['loggedin'])
    {
        session_destroy();
        header ('location: login.php');
        exit();
    }
?>