 <?php
include("php/class_lib.php");
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
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
		<select multiple>
			<option value="task1">task 1</option>
		</select>
	</div>
	<div id="task_info">
		<table style="width:100%">
		  <tr>
			<td>Scheduled time</td>
			<td>2</td>
		  </tr>
		  <tr>
			<td>Spent time</td> 
			<td>1</td> 
		  </tr>
		  <tr>
			<td>Done</td>
			<td>no</td>
		  </tr>
		  <tr>
			<td>Deadline</td>
			<td>04/03/2034</td>
		  </tr>
		  <tr>
		</table>
	</div>
	<div id="task_action">
		<button type="button">start</button>
		<button type="button">done</button>
		<button type="button">edit</button>
	</div>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/script.js"></script>      
  </body>
</html>