<?php
include 'db_connection.php';
include 'php/userDAO.php';

session_start();

$conn = open_conn();
$user = $_SESSION["user"];

foreach ($user->get_tasks() as $task)
    echo $task->get_id();

userDAO::edit($conn, $user);
close_conn($conn);

unset($_SESSION["user"]);
unset($_SESSION["loggedin"]);

session_destroy();

header("Location: index.php");

?>