<?php

    include_once 'db_connection.php';
    include_once 'task.php';
    include_once 'class_lib.php';

    class taskDAO {
        static function insert($conn, $task, $id_user) {
            // $conn = open_conn(); TODO - move all open_conn to DAO
            
            $stmt = $conn->prepare("INSERT INTO task (id_task, id_user, scheduled_time, spent_time, done, name, working, deadline, last_play) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $id = $task->get_id();
            $scheduled_time = $task->get_scheduled_time();
            $spent_time = $task->get_spent_time();
            $done = $task->get_done();
            $name = $task->get_name();
            $working = $task->get_working();
            $deadline = $task->get_deadline();
            $last_play = $task->get_last_play();
                
            $stmt->bind_param("iiiiisiss", $id, $id_user, $scheduled_time, $spent_time,
            $done, $name, $working, $deadline, $ĺast_play);

            $stmt->execute();

            echo "here";
        }

        static function edit($conn, $task, $id_user) {
            // $conn = open_conn(); TODO

            $id = $task->get_id();
            $scheduled_time = $task->get_scheduled_time();
            $spent_time = $task->get_spent_time();
            $done = $task->get_done();
            $name = $task->get_name();
            $working = $task->get_working();
            $deadline = $task->get_deadline();
            $last_play = $task->get_last_play();

            $stmt = $conn->prepare("UPDATE task SET id_user = ? WHERE id_task = ?");
            $stmt->bind_param("ii", $scheduled_time, $id);
            $stmt->execute();
            
            $stmt = $conn->prepare("UPDATE task SET scheduled_time = ? WHERE id_task = ?");
            $stmt->bind_param("ii", $scheduled_time, $id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE task SET spent_time = ? WHERE id_task = ?");
            $stmt->bind_param("ii", $spent_time, $id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE task SET done = ? WHERE id_task = ?");
            $stmt->bind_param("ii", $done, $id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE task SET name = ? WHERE id_task = ?");
            $stmt->bind_param("si", $name, $id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE task SET working = ? WHERE id_task = ?");
            $stmt->bind_param("ii", $working, $id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE task SET deadline = ? WHERE id_task = ?");
            $stmt->bind_param("si", $deadline, $id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE task SET last_play = ? WHERE id_task = ?");
            $stmt->bind_param("si", $last_play, $id);
            $stmt->execute();
        }

        static function delete($conn, $task) {
            $id = $task->get_id();        
            $stmt = $conn->prepare("DELETE FROM task WHERE id_task = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }

        static function list($conn) {
            $stmt = $conn->prepare("SELECT * FROM task");
            $stmt->execute();
            $result = $stmt->get_result();

            $list = array();
            
            if ($result->num_rows == 0) return $list;

            while($row = $result->fetch_assoc())
                $list[] = get_task($row);

            return $list;
        }

        static function list_by_user($conn, $id_user) {
            $stmt = $conn->prepare("SELECT * FROM task WHERE id_user = ?");
            $stmt->bind_param("i", $id_user);
            $stmt->execute();
            $result = $stmt->get_result();

            $list = array();
            
            if ($result->num_rows == 0) return $list;

            while($row = $result->fetch_assoc())
                $list[] = taskDAO::get_task($row);

            return $list;
        }

        static function find($conn, $id) {
            $stmt = $conn->prepare("SELECT * FROM task WHERE id_task = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            $row = $result->fetch_assoc();

            if ($result->num_rows == 0) return null;
            
            return taskDAO::get_task($row);
        }

        static function get_task($row) {
            $id = $row['id_task'];
            $scheduled_time = $row['scheduled_time'];
            $spent_time = $row['spent_time'];
            $done = $row['done'];
            $name = $row['name'];
            $working = $row['working'];
            $deadline = $row['deadline'];
            $last_play = $row['last_play'];

            $task = new task($id, $scheduled_time, $name, $deadline);

            $task->set_spent_time($spent_time);
            $task->set_done($done);
            $task->set_working($working);
            $task->set_last_play($last_play);

            return $task;
        }

        static function next_id($conn) {
            $stmt = "SET SQL_SAFE_UPDATES = 0";
            mysqli_query($conn, $stmt);

            $stmt = "UPDATE seq_task SET id=LAST_INSERT_ID(id+1)";
            mysqli_query($conn, $stmt);

            $stmt = "SELECT LAST_INSERT_ID()";
            $result = mysqli_query($conn, $stmt);
            $result_grid = mysqli_fetch_array($result);

            if (mysqli_num_rows($result) == 0)
                throw new NoRowsInTableException();
            
            return $result_grid[0];
        }
    }

?>