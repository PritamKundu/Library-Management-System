<?php
session_start();
if(!isset($_SESSION["username"])) {
  header("Location: 403.php");
} else {
  include './database-controls/get-book.php';
  // echo $_GET['id'];
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $book["title"] ?> | XYZ Library</title>

    <style media="screen">
      .bookActions {
        padding: 10px 10px;
        float:right;
        /* margin-right: 5% */
      }
      .bookActions a {
        text-decoration: none;
        color: white;
      }
      .bookActions #editB {
        background: #89DC89;
        border-radius: 3px;
        padding: 4px 8px;
      }
      .bookActions #editB:hover {
        background: #679B75;
      }
      .bookActions #borB {
        background: #678BAB;
        border-radius: 3px;
        padding: 4px 8px;
      }
      .bookActions #borB:hover {
        background: #4A647B;
      }
      .bookActions #rerB {
        background: #678BAB;
        border-radius: 3px;
        padding: 4px 8px;
      }
      .bookActions #rerB:hover {
        background: #4A647B;
      }
      .bookContainer {
        margin: 1% 9%;
        padding-bottom: 10%;
        display: grid;
        grid-template-columns: auto auto;
      }
      .bookDetails {
        cursor: default;
        margin: 2% 4%;
      }
      .bookHeader{
        font-size: 25px;
        font-weight: bold;
        font-family: arial;
        padding-bottom: 1%;
      }
      .bookAuthor {
        color: #5E7876;
        padding-bottom: 0.3%;
      }
      .bookKeywords {
        color: #2196F3;
        padding-bottom: 2%;
      }
      .bookEdition {
        color: #5E7876;
        padding-bottom: 1%;
      }
      .bookDesc {
        padding-bottom: 3%;
        text-align: justify;
      }
      .innerContainer {
        display: grid;
        grid-template-columns: auto auto;
      }
      .bookInnerDetails{
        width: 300px;
        display: grid;
        grid-template-columns: auto auto;
      }
      .bookImage {
        margin-top: 9%;
        margin-left: 10% !important;
        align-items: center;
        width: 250px;
      }
      .bookImage img {
        width: 240px;
        height: 320px;
      }
      /* .bookImage img:hover {
        width: 250px;
        height: 330px;
      } */
    </style>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <div class="bookActions">
        <?php
            include './database-controls/get-user.php';
            if ($user["userType"] == "Admin") {
                ?>
                  <a id="editB" href="/library-ms/admin/edit-book.php?id=<?php echo $book['id']; ?>">Edit Book</a>
                <?php
            }
            if ($book['status'] == 0) {
                ?>
                  <a id="borB" href="/library-ms/book/borrow.php?id=<?php echo $book['id']; ?>">Borrow Book</a>
                <?php
            }
            if ($book['status'] == 1) {
                ?>
                  <a id="rerB" href="/library-ms/book/return.php?id=<?php echo $book['id']; ?>">Return Book</a>
                <?php
            }
        ?>
    </div>
    <div class="bookContainer">
      <div class="bookImage">
        <?php
            if ($book['image'] != null) {
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $book['image'] ).'"/>';
            } else {
              ?>
                  <div align="center">
                      <p style="color: red; margin-top: 50%">Not Found!</p>
                  </div>
              <?php
            }
        ?>
      </div>

      <div class="bookDetails">
        <div class="bookHeader">
          <?php echo $book["title"]; ?>
        </div>
        <div class="bookKeywords">
          <?php
            if(!empty($book["keywords"])){
              $keywords = explode(',',$book["keywords"]);
              foreach ($keywords as $keyword) {
                $hashtag = trim($keyword);
                echo '#' . str_replace(" ", "_", $hashtag) . ' ';
              }
            }
          ?>
        </div>
        <div class="bookAuthor">
          <?php echo $book["author"]; ?>
        </div>
        <div class="bookEdition">
          <?php echo $book["edition"]; ?>
        </div>

        <div class="bookDesc">
          <?php echo $book["description"]; ?>
        </div>

        <div class="innerContainer">
          <div class="bookInnerDetails">
            <div class="">
              <b>ISBN:</b>
            </div>
            <div class="">
              <?php echo $book["isbn"]; ?>
            </div>

            <div class="">
              <b>Copy type:</b>
            </div>
            <div class="">
              <?php echo $book["copyType"]; ?>
            </div>
            <div class="">
              <b>Published:</b>
            </div>
            <div class="">
              <?php echo $book["publishedYear"]; ?>
            </div>
          </div>
          <div class="bookInnerDetails">
            <div class="">
              <b>Genre:</b>
            </div>
            <div class="">
              <?php echo $book["genre"]; ?>
            </div>
            <div class="">
              <b>Publisher:</b>
            </div>
            <div class="">
              <?php echo $book["publisher"]; ?>
            </div>
          </div>
        </div>
    </div>
    </div>

    <?php include 'footer.php'; ?>
  </body>
</html>
