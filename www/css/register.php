<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link rel='stylesheet' href='css/register.css' type='text/css' />
  </head>
  <body>
    <div id="header"><h1>Taskim</h1></div><br>
    <div id="login-fields">
      <form name="register-form" action="register.php" method="post">
    Name<br>
	<input type="name" name="name"></input><br>
	E-mail<br>
	<input type="text" name="email"></input><br>
	Password<br>
	<input type="password" name="password"></input><br>
	<input type="submit" name="register" value="register"></input>
      </form>
    </div>
                
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/register.js"></script>
    <?php
		include 'db_connection.php';

		$conn = openConn();

		echo "Connect Successfully";

		closeConn($conn);
	?>


  </body>
</html>
