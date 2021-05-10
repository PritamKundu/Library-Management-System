<?php
session_start();
include "db-con.php";

$username = $password = "";
$usernameErr = $passwordErr = $loginErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "Username can not be empty";
    $loginErr = "";
  } else {
    $username = test_input($_POST["username"]);
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password can not be empty";
  } else {
    $password = test_input($_POST["password"]);
    $loginErr = "";
  }

  if (!empty($username) && !empty($password)) {
    $usernameEs = mysqli_real_escape_string($connection, $username);
    $passwordEs = mysqli_real_escape_string($connection, $password);
    $loginCheck = "select username from userlogin where password ='" . $passwordEs . "' and username = '". $usernameEs . "'";
    // $loginCheck = mysqli_real_escape_string($connection, $loginCheck);
    $result = mysqli_query($connection, $loginCheck);
    if (mysqli_num_rows($result) < 1) {
      $loginErr = "Incorrect username or password";
    } else {
      $_SESSION["username"] = $username;
      header("Location: index.php");
    }
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Member Log In - XYZ Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative:900|Teko&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="loginContainer" align="center">
      <h3 id="header">XYZ Libary</h3>
      <p id="tagLine">read while you still can</p>
      <form class="" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
        <table>
          <tr>
            </span> <span class="error"><?php echo $loginErr;?></span>
            <td> <label for="username">Username</label> </td>
            <td><input type="text" name="username" value="<?php echo $username;?>" placeholder="Enter your username" required>
            <br> <span class="error"><?php echo $usernameErr;?></span> </td>
          </tr>
          <tr>
            <td> <label for="password">Password</label> </td>
            <td><input type="password" name="password" value="<?php echo $password;?>" placeholder="Enter your password" required>
            <br> <span class="error"><?php echo $passwordErr;?></td>
          </tr>
          <tr>
            <td colspan="2"> <input type="submit" value="Log In"> </td>
          </tr>
          <tr>
            <td colspan="2" align="center"> <br> <a style="text-decoration:none !important; color:#6d745c;" href="register.php">Create account</a> | <a style="text-decoration:none !important; color:#6d745c;" href="recover.php">Forgot Password</a> </td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
