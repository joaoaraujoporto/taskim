<?php

include_once 'task.php';

class user {
    var $id;
    var $name;
    var $email;
    var $password;
    var $tasks;

    function __construct($id, $name, $email, $password, $tasks) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->tasks = $tasks;
    }
    
    function get_id() {
        return $this->id;
    }
    
    function set_name($name) {
        $this->name = $name;
    }

    function get_name() {
        return $this->name;
    }

    function set_email($email) {
        $this->email = $email;
    }

    function get_email() {
        return $this->email;
    }

    function set_password($password) {
        $this->password = $password;
    }

    function get_password() {
        return $this->password;
    }
    
    function set_tasks($tasks) {
        $this->tasks = $tasks;
    }

    function get_tasks() {
        return $this->tasks;
    }

    function add_task($task) {
        //$this->tasks[] = $task;
        array_push($this->tasks, $task);
    }

    function delete_task($task) {
        $index_task = array_search($task, $this->tasks);
        array_splice($this->tasks, $index_task, 1);
    }

    function get_task($id_task) {
        foreach ($this->tasks as $task)
            if ($task->id == $id_task)
                return $task;

        return null;
    }
}

?>