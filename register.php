<?php
// if ((session_status() == PHP_SESSION_ACTIVE) || (session_status() == PHP_SESSION_NONE)) {
//     session_start();
// }
if (isset($_SESSION["username"])) {
  header("Location: index.php");
}

$firstName = $lastName = $userType = $fine = $username = $password1 = $password2 = $message = $ui_d = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["first_name"];
  $lastName = $_POST["last_name"];
  $userType = $_POST["user_type"];
  $username = $_POST["user_name"];
  $password1 = $_POST["pass_word"];
  $password2 = $_POST["pass_word_c"];

  if (!empty($firstName) && !empty($lastName) && !empty($userType) && !empty($password1) && !empty($password2)) {
    if ($password1 === $password2) {
      include 'database-controls/db-con.php';
      $todaysDate = date("Y-m-d");
      $insertUserQuery1 = "insert into userlogin(username, password) values('$username', '$password1')";
      mysqli_query($connection, $insertUserQuery1);

      $ui_d = mysqli_insert_id($connection);

      $insertUserQuery2 = "insert into userdetails(uid, firstname, lastname, userType, fine, registered) values($ui_d, '$firstName', '$lastName', '$userType', 0, '$todaysDate')";

      if (mysqli_query($connection, $insertUserQuery2)) {
          $message = "Registration successful, you may log in now using your credential.";
      }
      else {
          $message = "Couldn't register user, please try again later.";
      }

    } else {
      $message = "Passwords doesn't match!";
    }
  }

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Memeber Registration | XYZ Library</title>
    <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative:900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style media="screen">
      .regform{
        margin: 3% 8% 5% 8% !important;
      }
    </style>
  </head>
  <body>
    <?php include "header.php" ?>

    <div class="regform">

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="POST">
        <div class="form-row">
            <div class="col-md-4 mb-3">
              <label>First name</label>
              <input name="first_name" type="text" class="form-control" placeholder="Please enter your first name" value="<?php echo $firstName ?>" required>
            </div>

            <div class="col-md-4 mb-3">
              <label>Last name</label>
              <input name="last_name" type="text" class="form-control" placeholder="Please enter your last name" value="<?php echo $lastName ?>" required>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-4 mb-3">
              <label>Username</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input name="user_name" type="text" class="form-control" placeholder="Username" aria-describedby="inputGroupPrepend" value="<?php echo $username ?>" required>
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <label>User Type</label>
              <select class="form-control" name="user_type">
                <option value="" selected disabled>Select</option>
                <option value="Admin">Admin</option>
                <option value="Factulty">Factulty</option>
                <option value="Student">Student</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-3 mb-3">
              <label>Password</label>
              <input name="pass_word" type="password" class="form-control" value="" placeholder="Password" required>
            </div>
            <div class="col-md-3 mb-3">
              <label>Confirm Password</label>
              <input name="pass_word_c" type="password" class="form-control" value="" placeholder="Confirm Password" required>
            </div>

          </div>

        <button class="btn btn-primary" type="submit">Register</button>
      </form>
      <span style="color: red"> <?php echo $message; ?></span>
    </div>


    <?php include "footer.php"; ?>
  </body>
  <style media="screen">
    .footer-item2 {
      margin-right: 0% !important;
    }
  </style>
</html>
