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

    function __destruct() {
        ;
    }
}

?>