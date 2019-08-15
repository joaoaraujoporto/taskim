<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
<!-- Bootstrap CSS file -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='css/register.css' type='text/css' />
  </head>
  <body>
    <div id="header"><h1><a href="index.php">Taskim</a></h1></div><br>
    <div id="register-fields">
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
<?php
include 'db_connection.php';

if (array_key_exists("loggedin", $_SESSION))
    if ($_SESSION["loggedin"])
        header("location: tasks.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = openConn();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE email = \"" . $email . "\"";

    $result = mysqli_query($conn, $query);
    $result_grid = mysqli_fetch_array($result);
    
    if (mysqli_num_rows($result) != 0) { ?>
        <div id="register-result">E-mail already used. Please, register with another e-mail.</div>
<?php
        echo json_encode(['code'=>404]);
    } else {
        $pw_hashed = md5($password);
        
        $query = "INSERT INTO user (name, email, password) VALUES (\"" . $name . "\", \"" . $email . "\", \"" . $pw_hashed . "\");";

        $result = mysqli_query($conn, $query);

        if (!$result) { ?>
            <div id="register-result">Problem in server. Please, try again later.</div>
<?php
            echo json_encode(['code'=>404]);
        } else { ?>
        <div id="register-result">
        Register done!
            <a href=index.php> Click here to login</a>
        </div>
<?php
        echo json_encode(['code'=>200]);
        }
    }

    closeConn($conn);
}
?>

    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/register.js"></script>

  </body>
</html>
