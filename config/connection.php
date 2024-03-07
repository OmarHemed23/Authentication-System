<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "otp_database";

    /*  Create Connection 
        Set PDO error mode to exception
    */
    try 
    {
        $conn = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Connection Failed:" .$e->getMessage();
    }
?>