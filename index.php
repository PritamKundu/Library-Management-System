<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>XYZ Library</title>
    <style media="screen">
      body{
        margin: 0;
      }
      .slideshow {
        position: relative;
        width: auto;
        height: 100%;
      }
      .bookSlideShow {
        margin: 5% 5%;
        position: absolute;
        top: 25%;
        background: rgb(195,195,195);
        background: linear-gradient(221deg, rgba(195,195,195,1) 7%, rgba(174,196,215,1) 40%, rgba(180,205,124,1) 100%);
        padding: 3% 4%;
        border: none;
        border-radius: 10px;
        /* background-color: white; */
      }
      .bookSlideShow #SlideTop {
        background-color: white;
        margin-bottom: -1%;
        border: none;
        color: gray;
        font-family: Arial;
        padding: 6px 12px 10px 12px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
      }
      .slides {
        width: 100%;
        height: 100%;
        display: none;
      }
      .slideshow img {
        height: 100%;
      }
      /* .bookSlideBg */
      .searchResult {
        padding: 2% 8% 2% 2%;
        /* margin: 0% 0% 1% 0%; */
        border-radius: 10px;
        cursor: pointer;
        background-color: white;
        width: 80vw;
        display: flex;
        justify-content: center;
        align-content: space-around;
      }
      .bookImageS {
        flex-grow: 2;
        margin: 5px;
      }
      .bookImageS img{
        height: 160px;
      }
      .bookDetailsS {
        margin: 5px;
        flex-grow: 8;
        /* background-color: white; */
      }
      .bookSlide {
        /* background-color: white; */
      }
      .bookSlide a {
        text-decoration: none;
        color: #314947;
      }
      .bookDetailsS #keywords {
        color: #2196F3;
      }
      #bookAuthor {
        margin-top: 0;
      }
      .searchOn {
        background: rgb(197,244,243);
        background: linear-gradient(40deg, rgba(197,244,243,1) 7%, rgba(159,148,248,1) 55%, rgba(252,188,69,1) 100%);
        width: 100%;
        display: grid;
        margin: 0% 7%;
        padding: 1% 0%;
        border-radius: 10px;
        grid-template-columns: 510px auto;
        width: 85vw;
        position: absolute;
        top: 87%;
      }
      .searchOn #headerGreeting {
        padding: 5% 10% 5% 10%;
        color: #6B3A46;
      }
      .searchOn #linkingSearch {
        padding: 2% 5% 0% 10%;;
        color: gray;
        background-color: white;
        margin: 6% 0%;
        width: 600px;
        border: none;
        border-radius: 10px;
      }
      .searchOn input[type=text] {
        border: 1px solid white;
        padding: 8px 14px;
        width: 400px;
        font-family: arial;
        background-color: #F0E8EF;

      }
      .searchOn input[type=text]:hover {
        border: 1px solid #F84AF0;
      }
      .searchOn button {
        /* margin-left: 5%; */
        margin-bottom: 5%;

        padding: 8px 14px;
        border: none;
        background-color: indigo;
        color: white;
        cursor: pointer;
        border-radius: 5px;
        font-weight: bold;
        font-family: arial;
      }
      .searchOn button:hover{
        background-color: lightblue;
      }
      .bookGallery {
        position: absolute;
        top: 135%;
        display: grid;
        grid-template-columns: auto auto auto auto;
        padding: 1.2% 1% 10% 3%;
      }
      .galleryItem {
        /* margin: 0% 1%; */
      }
      .galleryItem:hover {
        box-shadow: 0px 20px 40px 0px rgba(0, 0, 0, 0.2);
      }
    </style>
  </head>
  <body>
    <?php include "header.php" ?>

    <div class="slideshow">
      <img class="slides" src="assets/img/slide3.jpg">
      <img class="slides" src="assets/img/slide4.jpg">
      <img class="slides" src="assets/img/slide1.jfif">
      <img class="slides" src="assets/img/slide2.jfif">
    </div>

    <div class="bookSlideShow">
      <h2 id="SlideTop">Our collection../</h2>
      <?php

        $getBooks = "select * from books";
        include 'database-controls/db-con.php';
        $searchedBooks  = mysqli_query($connection, $getBooks);

        while ($searchedBooks && $book = mysqli_fetch_assoc($searchedBooks)) {
          ?>
          <div class="bookSlide">
            <a href="http://localhost/library-ms/book.php?id=<?php echo $book['id']; ?>">
              <div class="searchResult">
                <div class="bookImageS">
                  <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $book['image'] ).'"/>'; ?>
                </div>
                <div class="bookDetailsS">
                  <h3 id="bookAuthor"><?php echo $book["title"] . ' - ' . $book["edition"]; ?></h3>
                  <h5><?php echo $book["author"]; ?> <br>
                  <span id="keywords"><?php
                    if(!empty($book["keywords"])){
                      $keywords = explode(',',$book["keywords"]);
                      foreach ($keywords as $keyword) {
                        $hashtag = trim($keyword);
                        echo '#' . str_replace(" ", "_", $hashtag) . ' ';
                      }
                    }
                  ?></span></h5>
                  <p> <?php echo substr($book["description"], 0, 400) . ' ...'; ?></p>
                </div>
              </div>
            </a>
          </div>
          <?php
        }

      ?>
    </div>

    <div class="searchOn">
      <div id="headerGreeting">
        <h1>“A reader lives a thousand lives before he dies . . . The man who never reads lives only one.”</h1>
        <h3>– George R.R. Martin</h3>
      </div>
      <div  id="linkingSearch">
        <h1> Search our amazing collection of books!</h1>
        <form class="" action="search.php" method="post">
          <input type="text" id="input" name="postIn" placeholder="Enter book title or author name or keyword or genre or ISBN" required>
          <button type="submit" name="button">Search</button>
        </form>
      </div>
    </div>

    <div class="bookGallery">
      <div class="galleryItem" style="background-color: #f58025 !important;">
        <?php
          $_GET["header"] = "New Arrival";
          $_GET["query"] = "select title,id from books order by id desc";
          include 'bookquery.php';
        ?>
      </div>

      <div class="galleryItem" style="background-color: #97a822 !important;">
        <?php
          $_GET["header"] = "Novel";
          $_GET["query"] = "select title,id from books where genre like '%Novel%' order by id";
          include 'bookquery.php';
        ?>
      </div>

      <div class="galleryItem" style="background-color: #5387a1 !important;">
        <?php
          $_GET["header"] = "Fiction";
          $_GET["query"] = "select title,id from books where genre like '%Fiction%' order by id";
          include 'bookquery.php';
        ?>
      </div>

      <div class="galleryItem" style="background-color: #636466 !important;">
        <?php
          $_GET["header"] = "Programming";
          $_GET["query"] = "select title,id from books where genre like '%Programming%' order by id";
          include 'bookquery.php';
        ?>
      </div>
    </div>

    <?php include "footer.php" ?>
  </body>
  <script type="text/javascript">
    var imgIndex = 0;

    function beginShow(){
      var picStack = document.getElementsByClassName("slides");
      console.log(picStack);
      Array.prototype.forEach.call(picStack, function setDisplay(pic) {
        pic.style.display = "none";
      });
      imgIndex++;
      if (imgIndex > picStack.length) {
        imgIndex = 1;
      }
      picStack[imgIndex-1].style.display = "block";
      setTimeout(beginShow, 5500);
    }

    var bookIndex = 0;

    function beginShow2(){
      var bookStack = document.getElementsByClassName("bookSlide");
      // console.log(picStack);
      Array.prototype.forEach.call(bookStack, function setDisplay(book) {
        book.style.display = "none";
      });
      bookIndex++;
      if (bookIndex > bookStack.length) {
        bookIndex = 1;
      }
      bookStack[bookIndex-1].style.display = "block";
      setTimeout(beginShow2, 5500);
    }

    beginShow();
    beginShow2();
  </script>
</html>
