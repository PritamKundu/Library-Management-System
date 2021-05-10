<?php

$itemHeader = $itemQuery = "";

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $itemHeader = $_GET["header"];
  $itemQuery = $_GET["query"];
}

?>
<style media="screen">
  fieldset{
    border: none;
    margin-left: 10px;
    margin-right: 10px;
  }
  .box1Header {
    background-color: #E3F3E4;
    color: #334947;
    font-size: 20px;
    padding: 2px 15px;
  }
  .box1 {
    color: #fff;
    padding: 1% 1%;
    height: 250px;
    width: 300px;
  }
  .box1Item{
    padding: 10px 5px 10px 10px;
    cursor: pointer;
  }
  .box1Item a {
    text-decoration: none;
    color: white;
    padding-top: 1%;
    padding-bottom: 1%;
  }
  .box1Item a:hover {
    font-size: 17px;
    color: #4F504A;
  }
  .box1 hr {
    color: #fff;
  }
</style>
  <fieldset class="box1">
    <legend class="box1Header"> <?php echo $itemHeader; ?> </legend>
    <div >
      <?php
        include 'db-con.php';
        $data = "$itemQuery limit 4";
        $result = mysqli_query($connection, $data);
        while ($obj = mysqli_fetch_assoc($result)) {
          echo "<div class='box1Item'>";
          echo '<a href="book.php?id=' . $obj["id"]. '">'. '📖' . ' '. $obj["title"]. '</a>';
          echo "</div>";
          // echo "<hr>";
        }
      ?>
    </div>
  </fieldset>
