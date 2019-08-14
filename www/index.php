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
    <div id="alternative-login">
      <a href="register.php">Register</a>
    </div>
            
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/index.js"></script>
<?php
include 'db_connection.php';

$conn = openConn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE email = \"" . $email . "\";";

    $result = mysqli_query($conn, $query);
    $result_grid = mysqli_fetch_array($result);

    $pw_hashed = $result_grid[3];
    
    if (mysqli_num_rows($result) == 0 || !password_verify($password, $pw_hashed)) { ?>
        <div id="login-error">Invalid e-mail or password</div>
<?php
    } else {
        echo "nice";
        header("location: tasks.php");
    }
}

closeConn($conn);
?>
    
  </body>
</html>