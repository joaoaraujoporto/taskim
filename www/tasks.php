<!DOCTYPE html>
<html>
  <head>
    <title>Taskim</title>
    <link rel='stylesheet' href='css/index.css' type='text/css' />
  </head>
  <body>
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