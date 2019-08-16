<?php

include_once 'user.php';
include 'taskDAO.php';
    
class userDAO {
    static function insert($conn, $user) {
        $stmt = $conn->prepare("INSERT INTO user (id_user, name, email, password) VALUES (?, ?, ?, ?)");

        $id = $user->get_id();
        $name = $user->get_name();
        $email = $user->get_email();
        $password = $user->get_password();

        $stmt->bind_param("isss", $id, $name, $email, $password);
        $stmt->execute();

        userDAO::insert_tasks($user->get_tasks(), $user);
    }

    static function insert_tasks($tasks, $user) {
        foreach ($tasks as $task)
            taskDAO::insert($task, $user);
    }

    static function edit($conn, $user) {
        $id = $user->get_id();
        $name = $user->get_name();
        $email = $user->get_email();
        $password = $user->get_password();
        
        $stmt = $conn->prepare("UPDATE user SET name = ? WHERE id_user = ?");
        $stmt->bind_param("si", $name, $id);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE user SET email = ? WHERE id_user = ?");
        $stmt->bind_param("si", $email, $id);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE id_user = ?");
        $stmt->bind_param("si", $password, $id);
        $stmt->execute();

        userDAO::edit_tasks($conn, $user->get_tasks(), $user->get_id());
    }

    static function edit_tasks($conn, $tasks, $id_user) {
        foreach ($tasks as $task) {
            if (taskDAO::find($conn, $task->get_id()) == null) {
                taskDAO::insert($conn, $task, $id_user);
                echo "evfp";
            }
            else {
                taskDAO::edit($conn, $task, $id_user);
                echo "cabd";
            }
        }
    }
    
    static function delete($conn, $user) {
        $id = $user->get_id();
        $stmt = $conn->prepare("DELETE FROM user WHERE id_user = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    static function list($conn) {
        $stmt = $conn->prepare("SELECT * FROM user");
        $stmt->execute();
        $result = $stmt->get_result();

        $list = array();
        
        if ($result->num_rows == 0) return $list;

        while($row = $result->fetch_assoc())
            $list[] = get_user($row);

        return $list;
    }

    static function find($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        
        if ($result->num_rows == 0) return null;
        
        return userDAO::get_user($conn, $row);
    }

    static function get_user($conn, $row) {
        $id = $row['id_user'];
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];
        $tasks = taskDAO::list_by_user($conn, $id);

        if ($tasks == null)
            echo "null";

        return new user($id, $name, $email, $password, $tasks);
    }

    static function next_id($conn) {
        $stmt = "SET SQL_SAFE_UPDATES = 0";
        mysqli_query($conn, $stmt);

        $stmt = "UPDATE seq_user SET id=LAST_INSERT_ID(id+1)";
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