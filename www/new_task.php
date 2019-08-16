<?php
include 'php/user.php';
session_start();
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Taskim</title>
<!-- Bootstrap CSS file -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='css/new_task.css' type='text/css' />
  </head>
  <body>
    <div id="header"><h1><a href="index.php">Taskim</a></h1></div><br>
    <div id="login-fields">
      <form name="task-form" action="new_task.php" method="post">
	Name<br>
	<input type="text" name="task_name"></input><br>
	Scheduled time<br>
	<input type="text" name="task_scheduled_time"></input><br>
    Deadline<br>
    <input type="date" name="task_deadline"></input><br>
	<input type="submit" name="submit" value="CREATE"></input>
      </form>
    </div>
            
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/new_task.js"></script>
<?php
include 'db_connection.php';
include 'php/taskDAO.php';

if (!array_key_exists("loggedin", $_SESSION) || !$_SESSION["loggedin"])
    header("location: tasks.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = open_conn();
    $user = $_SESSION["user"];
    
    $task_name = $_POST['task_name'];
    $task_scheduled_time = $_POST['task_scheduled_time'];
    $task_deadline = $_POST['task_deadline'];

    $id_task = taskDAO::next_id($conn);
    $task = new task($id_task, $task_scheduled_time, $task_name, $task_deadline);
    $user->add_task($task);

    close_conn($conn);
    header("location: tasks.php");
}

?>
    
  </body>
</html>