<?php
session_start();
if(!isset($_SESSION["username"])) {
  header("Location: 403.php");
} else {

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard | XYZ Library</title>

    <style media="screen">
      .userContainer {
        margin: 1.5% 4%;
        border: 1px solid gray;
        padding: 1% 1%;
        border-radius: 10px;
        display: grid;
        grid-template-columns: 200px auto 100px;
        grid-column-gap: 10px;
      }
      .userImage {
        max-width: 180px;
      }
      .userDetails {
        cursor: default;
      }
      .userImage img{
        padding: 1% 1%;
        border-radius: 6px;
        max-width: 180px;
        max-height: 180px;
      }
      .userDetails #name {
        margin-top: 0;
        display: inline;
        margin-right: 10px;
      }
      .userDetails #usertyp{
        margin-top: 0;
        display: inline;
        background-color: #39739d;
        color: white;
        border-radius: 1000px;
        padding: 6px 12px;
      }
      .userDetails a {
        color:#814B95 !important;
      }
      #editProfile{
        cursor: pointer;
        font-weight: bold;
        border-radius: 5px;
        color: white;
        background-color: #B98053;
        padding: 6px 12px;
        /* border-bottom: #58a700; */
      }
      #editProfile:hover{
        border: none;
      }
    </style>
  </head>
  <body>
    <?php include 'header.php'; ?>

    <div class="userContainer">

      <div class="userDetails">
        <div class="">
          <h2 id="name"><?php echo $user["lastname"] . ", " . $user["firstname"]; ?></h2> <span id="usertyp"><?php echo $user["userType"]; ?></span>
        </div>
        <h4><?php echo $user["username"]; ?></h4>

        <h4>Member since <?php echo $user["registered"]; ?></h4>
      </div>

    </div>

    <div align="center">
      <?php
          if ($user["userType"] == "Admin") {
              ?>
                <ul>
                  <li> <a href="/library-ms/admin/add-book.php">Add Book</a> </li>
                  <li> <a href="/library-ms/admin/add-user.php">Add User</a> </li>
                  <li> <a href="/library-ms/admin/delete-book.php">Delete Book</a> </li>
                  <li> <a href="/library-ms/admin/delete-user.php">Delete User</a> </li>
                  <li> <a href="/library-ms/admin/fine-user.php">Fin User</a> </li>
                  <li> <a href="/library-ms/admin/edit-book.php">Edit Book</a> </li>
                </ul>
              <?php
          } else {
            
          }
       ?>
    </div>

    <?php include 'footer.php'; ?>
  </body>
</html>
