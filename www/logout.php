<?php
include 'db_connection.php';

session_start();

$conn = $_SESSION["conn"];
close_conn($conn);

unset($_SESSION["user"]);
unset($_SESSION["conn"]);
unset($_SESSION["loggedin"]);

session_destroy();

header("Location: index.php");
?>