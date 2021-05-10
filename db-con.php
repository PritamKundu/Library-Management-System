<?php
$servername = "localhost";
$dbuser = "lms";
$dbpass = "lms9854";
$dbname = "libary-ms";

$connection = mysqli_connect($servername, $dbuser, $dbpass, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
