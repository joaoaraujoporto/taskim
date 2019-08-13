<?php

function openConn() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "admin";
    $db = "taskim_db";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or
        die("Connect failed: %s\n". $conn -> error);

    return $conn;
}

function closeConn($conn) {
    $conn -> close();
}

?>
