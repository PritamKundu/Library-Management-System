<?php
$postInput = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $postInput = $_POST["postIn"];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Search Book | XYZ Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style media="screen">
      #searchFieldContainer {
        display: flex;
        flex-direction: column;
        margin: 5% 5% 1% 5%;
      }
      .searchField {
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
      }
      .searchField input[type=text] {
        padding: 6px;
        font-size: 17px;
        width: 100%;
        background-color: white;
        border: 2px solid #ccc;
      }
      .searchField input[type=button] {
        padding: 6px;
        cursor: pointer;
        font-size: 17px;
        border:none;
        color: white;
        background-color: #4CAF50;
      }
      .searchField input[type=text]:hover {
        border: 2px solid #8DB6FF;
      }
      .searchField input[type=button]:hover {
        background-color: #008CBA;
      }
      #searchFilter {
        display: none;
        grid-template-columns: auto auto auto auto;
        grid-column-gap: 20px;
      }
      #FSopContainer {
        display: none;
        align-items: baseline;
        width: auto;
        justify-content: flex-end;
      }
      #clearFilter {
        cursor: pointer;
        margin-left: 5%;
        margin-right: 77%;
        margin-bottom: 1%;
        display: none;
        color: blue;
      }
      a {
        text-decoration: none !important;
        color: #3D3E42 !important;
      }
      #sortResult {
        display: flex;
        align-items: baseline;
        padding: 19px 12px;
        cursor: pointer;
        margin-right: 5%;
        margin-bottom: 1%;
        width: 50px;
      }
      #sortResult:hover {
        color: gray;
      }
      /* #sortResult:focus {
        color: yellow;
      } */
      #searchResultContainer {
        margin: 0% 5% 10% 5%;
      }
      .searchResult {
        padding: 2% 3%;
        margin: 1% 0%;
        cursor: pointer;
        width: 83.5vw;
        display: flex;
        justify-content: center;
        align-content: space-around;
        box-shadow: -webkit-box-shadow: 0px 1px 6px 0px rgba(50, 50, 50, 0.75);
                    -moz-box-shadow:    0px 1px 6px 0px rgba(50, 50, 50, 0.75);
                    box-shadow:         0px 2px 6px 0px rgba(50, 50, 50, 0.75);
      }
      .searchResult:hover {
        box-shadow: -webkit-box-shadow: 0px 2px 11px 0px rgba(50, 50, 50, 0.75);
                    -moz-box-shadow:    0px 2px 11px 0px rgba(50, 50, 50, 0.75);
                    box-shadow:         0px 2px 11px 0px rgba(50, 50, 50, 0.75);
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
      }
      .bookDetailsS #keywords {
        color: #2196F3;
      }
      #bookAuthor {
        margin-top: 0;
      }
    </style>
  </head>
  <body onload="searchBooks()">
    <?php include 'header.php'; ?>

    <div id="searchFieldContainer">
      <div class="searchField">
        <input type="text" value="<?php echo $postInput; ?>" id="input" placeholder="Enter book title or author name or keyword or genre or ISBN">
        <input type="button" id="searchBtn" onclick="searchBooks()" value="Search">
      </div>

      <div id="searchFilter">
        <?php
          include 'database-controls/get-books.php';
        ?>
        <div class="">
          <fieldset>
            <legend>Filter By Author</legend>
            <select id="selectAuthor" onchange="disableSelection('selectAuthor')">
              <option value="" selected disabled>Select</option>
              <?php while ($authorResult && $bookAuthors = mysqli_fetch_assoc($authorResult)) {
                ?>
                  <option value="<?php echo $bookAuthors['author']; ?>"><?php echo $bookAuthors['author']; ?></option>
                <?php
              } ?>
            </select>
          </fieldset>
        </div>
        <div class="">
          <fieldset>
            <legend>Filter By Genre</legend>
            <select id="selectGenre" onchange="disableSelection('selectGenre')">
              <option value="" selected disabled>Select</option>
              <?php while ($genreResult && $bookGernes = mysqli_fetch_assoc($genreResult)) {
                ?>
                  <option value="<?php echo $bookGernes['genre']; ?>"><?php echo $bookGernes['genre']; ?></option>
                <?php
              } ?>
            </select>
          </fieldset>
        </div>
        <div class="">
          <fieldset>
            <legend>Filter By Publisher</legend>
            <select id="selectPublisher" onchange="disableSelection('selectPublisher')">
              <option value="" selected disabled>Select</option>
              <?php while ($publisherResult && $bookPublishers = mysqli_fetch_assoc($publisherResult)) {
                ?>
                  <option value="<?php echo $bookPublishers['publisher']; ?>"><?php echo $bookPublishers['publisher']; ?></option>
                <?php
              } ?>
            </select>
          </fieldset>
        </div>
        <div class="">
          <fieldset>
            <legend>Filter By Year</legend>
            <select id="selectYear" onchange="disableSelection('selectYear')">
              <option value="" selected disabled>Select</option>
              <?php while ($pyResult && $bookPY = mysqli_fetch_assoc($pyResult)) {
                ?>
                  <option value="<?php echo $bookPY['publishedYear']; ?>"><?php echo $bookPY['publishedYear']; ?></option>
                <?php
              } ?>
            </select>
          </fieldset>
        </div>
      </div>
    </div>

    <div id="FSopContainer">
      <div id="clearFilter" align="left">
        <p onclick="clearFilters()">❌ Clear filter</p>
      </div>
      <div id="sortResult" onclick="sortResults()" align="right">
          <img src="assets/img/sortby.png" height="15px" width="15px"> <b>Title</b>
      </div>
    </div>

    <div id="searchResultContainer"></div>

    <?php include 'footer.php'; ?>
  </body>
  <script type="text/javascript">
    var inputField = document.getElementById("input");
    inputField.addEventListener("keyup", function(e){
      if (e.keyCode === 13) {
        document.getElementById("searchBtn").click();
      }
    });

    var queryLMS5498;
    function searchBooks() {
     if (document.getElementById("input").value !="") {
       document.getElementById("searchResultContainer").style.display = "block";
       var xhttp = new XMLHttpRequest();
       xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
           if (document.getElementById("input") && document.getElementById("input").value) {
             document.getElementById("searchResultContainer").innerHTML = this.responseText;
             if (!this.responseText.includes('<h1 align="center">Nothing found!</h1>')) {
               document.getElementById("searchFilter").style.display = "grid";
               document.getElementById("FSopContainer").style.display = "flex";
               document.getElementById("sortResult").style.display = "flex";
             } else {
               document.getElementById("searchFilter").style.display = "none";
               document.getElementById("FSopContainer").style.display = "none";
             }
           }
         }
       };
       if (document.getElementById("selectAuthor").options[selectAuthor.selectedIndex].value) {
           xhttp.open("GET", "database-controls/book-search.php?input="+document.getElementById("input").value+'&type=author&filter='+document.getElementById("selectAuthor").options[selectAuthor.selectedIndex].value, true);
         queryLMS5498 = "database-controls/book-search.php?input="+document.getElementById("input").value+'&type=author&filter='+document.getElementById("selectAuthor").options[selectAuthor.selectedIndex].value;
         // console.log("database-controls/book-search.php?input="+document.getElementById("input").value+'&type=author&filter='+document.getElementById("selectAuthor").options[selectAuthor.selectedIndex].value);
       }
       else if (document.getElementById("selectGenre").options[selectGenre.selectedIndex].value) {
         xhttp.open("GET", "database-controls/book-search.php?input="+document.getElementById("input").value+'&type=genre&filter='+document.getElementById("selectGenre").options[selectGenre.selectedIndex].value, true);
         queryLMS5498 = "database-controls/book-search.php?input="+document.getElementById("input").value+'&type=genre&filter='+document.getElementById("selectGenre").options[selectGenre.selectedIndex].value;
       }
       else if (document.getElementById("selectYear").options[selectYear.selectedIndex].value) {
         xhttp.open("GET", "database-controls/book-search.php?input="+document.getElementById("input").value+'&type=publishedYear&filter='+document.getElementById("selectYear").options[selectYear.selectedIndex].value, true);
         queryLMS5498 = "database-controls/book-search.php?input="+document.getElementById("input").value+'&type=publishedYear&filter='+document.getElementById("selectYear").options[selectYear.selectedIndex].value;
       }
       else if (document.getElementById("selectPublisher").options[selectPublisher.selectedIndex].value) {
         xhttp.open("GET", "database-controls/book-search.php?input="+document.getElementById("input").value+'&type=publisher&filter='+document.getElementById("selectPublisher").options[selectPublisher.selectedIndex].value, true);
         queryLMS5498 = "database-controls/book-search.php?input="+document.getElementById("input").value+'&type=publisher&filter='+document.getElementById("selectPublisher").options[selectPublisher.selectedIndex].value;
       } else {
         xhttp.open("GET", "database-controls/book-search.php?input="+document.getElementById("input").value, true);
         // queryLMS54  98 = "database-controls/book-search.php?input="+document.getElementById("input").value;
         // console.log("database-controls/book-search.php?input="+document.getElementById("input").value)
       }
       // console.log("from 1 "+ query);
       xhttp.send();
     } else {
       document.getElementById("searchResultContainer").style.display = "none";
       document.getElementById("selectAuthor").value="";
       document.getElementById("selectAuthor").disabled = !true;
       document.getElementById("selectGenre").value="";
       document.getElementById("selectGenre").disabled = !true;
       document.getElementById("selectYear").value="";
       document.getElementById("selectYear").disabled = !true;
       document.getElementById("selectPublisher").value="";
       document.getElementById("selectPublisher").disabled = !true;
       document.getElementById("searchFilter").style.display = "none";
       document.getElementById("clearFilter").style.display = "none";
       document.getElementById("sortResult").style.display = "none";
     }
    }

    function disableSelection(slefPa) {
      var cs = document.getElementById(slefPa);
      if ((cs.options[cs.selectedIndex].value) != 'default'){
        if (document.getElementById("selectGenre") != document.getElementById(slefPa)) {
          document.getElementById("selectGenre").disabled = true;
        }
        if (document.getElementById("selectYear") != document.getElementById(slefPa)) {
          document.getElementById("selectYear").disabled = true;
        }
        if (document.getElementById("selectPublisher") != document.getElementById(slefPa)) {
          document.getElementById("selectPublisher").disabled = true;
        }
        if (document.getElementById("selectAuthor") != document.getElementById(slefPa)) {
          document.getElementById("selectAuthor").disabled = true;
        }
        document.getElementById("clearFilter").style.display = "block";
      }
      searchBooks();
    }
    function clearFilters() {
      document.getElementById("selectAuthor").value="";
      document.getElementById("selectAuthor").disabled = !true;
      document.getElementById("selectGenre").value="";
      document.getElementById("selectGenre").disabled = !true;
      document.getElementById("selectYear").value="";
      document.getElementById("selectYear").disabled = !true;
      document.getElementById("selectPublisher").value="";
      document.getElementById("selectPublisher").disabled = !true;
      document.getElementById("clearFilter").style.display = "none";
      searchBooks();
    }
    function sortResults() {
      // console.log(window.query);
      var xhttp2 = new XMLHttpRequest();
      xhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (document.getElementById("input") && document.getElementById("input").value) {
            document.getElementById("searchResultContainer").innerHTML = this.responseText;
            // document.getElementById("sortResult").disabled = true;
          }
        }
      };
      xhttp2.open("GET", window.queryLMS5498+'&sort=title', true);
      // console.log(window.query+'&sort=title');
      xhttp2.send();
    }

    function checkResponse() {
      if (!document.getElementById("searchResultContainer").innerHTML.includes('<h1 align="center">Nothing found!</h1>')) {
        document.getElementById("searchFilter").style.display = "grid";
        document.getElementById("FSopContainer").style.display = "flex";
      // } else {
      //   document.getElementById("searchResultContainer").innerHTML="<div  align="center">
      //     <p onclick="clearFilters()">❌ Clear filter</p>
      //   </div>";
      }
    }
  </script>
</html>
