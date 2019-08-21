 <?php
	include_once 'php/user.php';
	include_once 'php/task.php';
	session_start();

	if (!array_key_exists("loggedin", $_SESSION) || !$_SESSION["loggedin"]) // TODO - move up
		header("location: index.php");

	$user = $_SESSION["user"];
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
		<div id="header"><h1><a href="index.php">Taskim</a></h1></div><br>
		<div id="session-info">
		<?php echo $user->get_name() ?><br>
		<a href="logout.php">log out </a>
		</div>
		<div id="task_list">
			<select id="sel_task_list" multiple>
			<?php foreach($user->get_tasks() as $task) { ?>
				<option value=<? echo $task->get_id() ?>><? echo $task->get_name() ?></option> <?php }?>
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
				<td name="scheduled_time_cell">no task selected</td>
			</tr>
			<tr>
				<td>Spent time</td> 
				<td name="spent_time_cell">no task selected</td> 
			</tr>
			<tr>
				<td>Done</td>
				<td name="done_cell">no task selected</td>
			</tr>
			<tr>
				<td>Deadline</td>
				<td name="deadline_cell">no task selected</td>
			</tr>
			<tr>
			</table>
		</div>
		<div id="task_action">
			<button type="button" name="change_task_work">start</button>
			<button type="button" name="done_task">done</button>
			<button type="button" name="edit_task">edit</button>
		</div>

		<script src="js/jquery-3.4.1.js"></script>
		<script src="js/tasks.js"></script>
	</body>
</html>