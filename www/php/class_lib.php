<?php

class task {
    var $scheduled_time;
    var $spent_time;
    var $done;
    var $name;
    var $working;
    var $deadline;
    var $last_play;

    function __construct($scheduled_time, $name, $deadline) {
        $this->scheduled_time = $scheduled_time;
        $this->name = $name;
        $this->deadline = $deadline;
        $this->spent_time = 0;
        $this->done = false;
        $this->working = false;
        $this->last_play = null;
    }

    function set_secheduled_time($scheduled_time) {
        $this->scheduled_time = $scheduled_time;
    }

    function get_secheduled_time() {
        return $this->scheduled_time;
    }

    function get_spent_time() {
        return $this->spent_time;
    }

    function set_done($done) {
        $this->done = $done;
    }

    function get_done() {
        return $this->done;
    }

    function set_name($name) {
        $this->name = $name;
    }

    function get_name() {
        return $this->name;
    }

    function set_working($working) {
        $this->working = $working;
    }

    function get_working() {
        return $this->working;
    }

    function set_deadline($deadline) {
        $this->deadline = $deadline;
    }

    function get_deadline() {
        return $this->deadline;
    }

    function get_last_play() {
        return $this->last_play;
    }
}

class user {
    var $name;
    var $email;
    var $password;
    var $tasks;

    function __construct($name, $email, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->tasks = null;
    }

    function set_name($name) {
        $this->name = $name;
    }

    function get_name() {
        return $this->name;
    }

    function set_tasks($tasks) {
        $this->tasks = $tasks;
    }

    function get_name() {
        return $this->tasks;
    }
}    

?>