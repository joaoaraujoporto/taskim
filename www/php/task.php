<?php

class task {
    var $id;
    var $scheduled_time;
    var $spent_time;
    var $done;
    var $name;
    var $working;
    var $deadline;
    var $last_play;

    function __construct($id, $scheduled_time, $name, $deadline) {
        $this->id = $id;
        $this->scheduled_time = $scheduled_time;
        $this->name = $name;
        $this->deadline = $deadline;
        $this->spent_time = 0;
        $this->done = false;
        $this->working = false;
        $this->last_play = null;
    }

    function get_id() {
        return $this->id;
    }
    
    function set_scheduled_time($scheduled_time) {
        $this->scheduled_time = $scheduled_time;
    }

    function get_scheduled_time() {
        return $this->scheduled_time;
    }

    function set_spent_time($spent_time) {
        $this->spent_time = $spent_time;
    }
    
    function get_spent_time() {
        return gmdate("H:i:s", round($this->spent_time/1000));
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

    function set_last_play($last_play) {
        $this->last_play = $last_play;
    }

    function get_last_play() {
        return $this->last_play;
    }

    function update_work($timestamp) {
        if (!$this->working) {
            $this->set_last_play($timestamp);
        } else {
            $time_diff = $timestamp - $this->last_play;
            $spent_time = $this->spent_time + $time_diff;
            $this->set_spent_time($spent_time);
        }
        
        $this->set_working(!$this->working);
    }
}

?>