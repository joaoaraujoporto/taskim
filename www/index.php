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
	<input type="email" name="email"></input><br>
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
include_once 'db_connection.php';
include_once 'php/userDAO.php';

if (array_key_exists("loggedin", $_SESSION))
    if ($_SESSION["loggedin"])
        header("location: tasks.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = open_conn();
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE email = \"" . $email . "\";";

    $result = mysqli_query($conn, $query);
    $result_grid = mysqli_fetch_array($result);
    
    $pw_hashed = $result_grid[3];

    $is_right_pw = md5($password) == $pw_hashed;
    
    if (mysqli_num_rows($result) == 0 || !$is_right_pw) { ?>
        <div id="login-error">Invalid e-mail or password</div>
<?php
        close_conn($conn);
    } else {
        $id_user = $result_grid[0];
        
        $_SESSION["user"] = userDAO::find($conn, $id_user);
        $_SESSION["loggedin"] = true;

        close_conn($conn);
        header("location: tasks.php");
    }

    close_conn($conn);
}

?>
    
  </body>
</html>