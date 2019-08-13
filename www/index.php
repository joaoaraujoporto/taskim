<!DOCTYPE html>
<html>
  <head>
    <title>Taskim</title>
    <link rel='stylesheet' href='css/index.css' type='text/css' />
  </head>
  <body>
    <div id="header"><h1>Taskim</h1></div><br>
    <div id="login-fields">
      <form name="login-form" action="index.php" method="post">
	E-mail<br>
	<input type="text" name="email"></input><br>
	Password<br>
	<input type="password" name="password"></input><br>
	<input type="submit" name="login" value="login"></input>
      </form>
    </div>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/script.js"></script>
    <?php
      include 'db_connection.php';

echo "sd";

$conn = openConn();

echo "Connect Successfully";

closeConn($conn);
?>


  </body>
</html>
