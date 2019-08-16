<?php

function open_conn() {
    $dbhost = "localhost:3306";
    $dbuser = "root";
    $dbpass = "";
    $db = "taskim_db";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or
         die("Connect failed: %s\n". $conn -> error);

    return $conn;
}

function close_conn($conn) {
    $conn -> close();
}

?>
