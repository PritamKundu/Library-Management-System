<?php

if (isset($_SESSION["username"])) {
} else {
  session_start();
}

?>
<style media="screen">
.parentContainer{
  display: grid;
  grid-template-columns: auto auto;
  padding: 2% 5% 2% 5% !important;
  bottom: 0;
  /* border-left: 3px solid red !important; */
  background-color: #663dff !important;
  background-image: linear-gradient(319deg, #663dff 0%, #aa00ff 37%, #cc4499 100%) !important;
}
.outerBorder{
  font-family: 'Cinzel Decorative', cursive;
  color : white;
}
.innerBorder{
  font-family: 'Open Sans', sans-serif;
}
.parentContainer a{
  color: white;
  text-decoration: none;
}
.innerBorder a:hover{
    color: red;
}
.dropdown {
  position: relative;
  display: inline-block;
}
.dropdown img {
  width: 30px;
  cursor: pointer;
}
.dropdown-content {
  margin-right: 10% !important;
  display: none;
  background-color: #F67951;
  width: 110px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 10px 7px;
}
.dropdown-content a:hover{
  text-decoration: underline;
  color: white;
}

.dropdown:hover .dropdown-content {
  display: block;
}

</style>
<div class="parentContainer">
  <div class="outerBorder">
    <h2> <a href="/library-ms/">XYZ Library</a> </h2>
  </div>
  <div class="innerBorder" align="right">
    <?php if(isset($_SESSION["username"])) {
      include 'database-controls/get-user.php';
      echo '<div class="dropdown">';
      echo '<img src="/library-ms/assets/img/layout.png"/>';
      echo '<div class="dropdown-content">';
      if ($_SERVER['REQUEST_URI'] == "/library-ms/dashboard.php") {
        echo '<a href="#">Profile</a>';
        echo ' / ';
        echo '<a href="logout.php">Logout</a>';
      } else {
        echo '<a href="dashboard.php">Profile</a>';
        echo ' / ';
        echo '<a href="logout.php">Logout</a>';
      }
      echo '</div>';
      echo '</div>';
    } elseif ($_SERVER['REQUEST_URI'] == "/library-ms/register.php") {
      echo '<a href="index.php">Home</a> | <a href="login.php">Login</a>';
    } else {
      echo '<a href="login.php">Login</a> | <a href="register.php">Register</a>';
    }
    ?>
  </div>
</div>
<link href="/library-ms/assets/fonts/CinzelDecorative/CinzelDecorative-Black.css" rel="stylesheet">
<?php
if ($_SERVER['REQUEST_URI'] != "/library-ms/register.php") {
  ?>
  <style media="screen">
  .navMenu {
    display: grid;
    grid-template-columns: auto auto auto auto;
    grid-gap: 3px;
    margin: -1.4% 0%;
    text-align: center;
  }
  .navMenu h3 {
    padding: 6.5% 0%;
  }
  .navMenu a{
    text-decoration: none;
    color: white;
  }
  .navMenu #navE1 {
    background-color: #f58025;
  }
  .navMenu #navE2 {
    background-color: #97a822;
  }
  .navMenu #navE3 {
    background-color: #5387a1;
  }
  .navMenu #navE4 {
    background-color: #636466;
  }
  </style>
  <div class="navMenu">
    <h3 id="navE1"><a href="index.php">Home</a></h3>
    <h3 id="navE2"><a href="about.php">About</a></h3>
    <h3 id="navE3"><a href="mission-vission.php">Mission & Vission</a></h3>
    <h3 id="navE4"><a href="search.php">Search</a></h3>
  </div>
  <?php
}
?>
