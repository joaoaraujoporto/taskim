<?php
include_once 'php/user.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);

    $user = $_SESSION['user'];

    $task = $user->get_task($_POST['id_task']);
    $user->delete_task($task);

    if (isset($_POST['id_task'])) { // TODO
        echo json_encode(array('code' => 200));
    } else {
        echo json_encode(array('code' => 404));
    }
}
?>