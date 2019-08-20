 <?php
include_once 'php/user.php';
include_once 'php/task.php';
session_start();
?>

<!DOCTYPE html>
<html>
  <xbhead>
    <title>Taskim</title>
<!-- Bootstrap CSS file -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='css/tasks.css' type='text/css' />
  </head>
  <body>
    
<?php
if (!array_key_exists("loggedin", $_SESSION) || !$_SESSION["loggedin"])
    header("location: index.php");

$user = $_SESSION["user"];
?>
    
    <div id="header"><h1><a href="index.php">Taskim</a></h1></div><br>
    <div id="session-info">
<?php echo $user->get_name() ?><br>
<a href="logout.php">log out </a>
    </div>
    <div id="task_list">
       	<select id="sel_task_list" multiple>
<?php
    function update_list($user) {
        foreach($user->get_tasks() as $task) { ?>
             <option value=<? echo $task->get_id() ?>><? echo $task->get_name() ?></option> <?php
        }
    }

    update_list($user);
?>
		</select>
	</div>
    <div id="task_list_action">
<button type="button" name="new_task">new task</button>
<button type="button" name="delete_task">delete task</button>
</div>
	<div id="task_info">
		<table style="width:100%">
		  <tr>
			<td>Scheduled time</td>
			<td name="scheduled_time_cell">2</td>
		  </tr>
		  <tr>
			<td>Spent time</td> 
			<td name="spent_time_cell">1</td> 
		  </tr>
		  <tr>
			<td>Done</td>
			<td name="done_cell">no</td>
		  </tr>
		  <tr>
			<td>Deadline</td>
			<td name="deadline_cell">04/03/2034</td>
		  </tr>
		  <tr>
		</table>
	</div>
	<div id="task_action">
		<button type="button" name="start_task">start</button>
		<button type="button" name="done_task">done</button>
		<button type="button" name="edit_task">edit</button>
	</div>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/tasks.js"></script>

    <?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);

        $user = $_SESSION['user'];
        $task = $user->get_task($_POST['id_task']);

        update_list($user);
        
        echo json_encode(
            array(
                'scheduled_time' => $task->get_scheduled_time(),
                'spent_time' => $task->get_spent_time(),
                'done_time' => $task->get_done(),
                'deadline_time' => $task->get_deadline()            
            )
        );
    }
    ?>
}
  </body>
</html>