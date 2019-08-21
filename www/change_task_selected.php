<?php
    include_once 'php/user.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = $_SESSION['user'];
        $task = $user->get_task($_POST['id_task']);

        $data["scheduled_time"] = $task->get_scheduled_time();
        $data["spent_time"] = $task->get_spent_time();
        $data["done"] = $task->get_done();
        $data["deadline"] = $task->get_deadline();
        $data["working"] = $task->get_working();

        echo json_encode($data);
    }
?>