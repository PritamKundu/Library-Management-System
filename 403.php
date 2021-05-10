<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sorry!! You are not allowed to access this page.</title>
    <style media="screen">
      .forbiddenNotice h1 {
        color: red;
      }
      .forbiddenNotice a {
        color: gray;
      }
      .forbiddenNotice a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <?php include 'header.php'; ?>

    <div class="forbiddenNotice" align="center">
      <h1>403</h1>
      <h1>You are not authorized to access the resource!</h1>
      <h3>Please <a href="login.php">Login</a> or <a href="register.php">Register</a>  </h3>
      <p>If you think this was by mistake, we applogize for this experience and encurage you to email at <a href="mailto:support@library.xyz.edu">support@library.xyz.edu</a> .</p>
    </div>

    <?php include 'footer.php'; ?>
  </body>
</html>
