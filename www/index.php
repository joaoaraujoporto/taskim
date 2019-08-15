<?php
session_start();
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Taskim</title>
<!-- Bootstrap CSS file -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='css/index.css' type='text/css' />
  </head>
  <body>
    <div id="header"><h1><a href="index.php">Taskim</a></h1></div><br>
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
include 'php/class_lib.php';

if (array_key_exists("loggedin", $_SESSION))
    if ($_SESSION["loggedin"])
        header("location: tasks.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = openConn();
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE email = \"" . $email . "\";";

    $result = mysqli_query($conn, $query);
    $result_grid = mysqli_fetch_array($result);

    closeConn($conn);
    
    $pw_hashed = $result_grid[3];
    
    if (mysqli_num_rows($result) == 0 || !password_verify($password, $pw_hashed)) { ?>
        <div id="login-error">Invalid e-mail or password</div>
<?php
    } else {
        $name = $result_grid[1];

        $_SESSION["user"] = new user($name, $email, $pw_hashed);
        $_SESSION["loggedin"] = true;
        
        header("location: tasks.php");
    }
}

?>
    
  </body>
</html>