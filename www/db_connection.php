<?php

function openConn() {
    $dbhost = "localhost:3306";
    $dbuser = "root";
    $dbpass = "";
    $db = "taskim_db";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or
         die("Connect failed: %s\n". $conn -> error);

    return $conn;
}

function closeConn($conn) {
    $conn -> close();
}

?>
