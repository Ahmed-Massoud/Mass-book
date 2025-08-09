<?php
session_start();
//die($_SESSION["admin"]);
?>
<?php
include "conn.php";
$booksPerPage = 20;
$totalBooks = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `books`"));
$totalPages = ceil($totalBooks / $booksPerPage);
$page = isset($_GET['page']) ? min($_GET['page'], $totalPages) : 1;
$offset = ($page - 1) * $booksPerPage;

$mybooks = mysqli_query($conn, "SELECT * FROM `books` LIMIT $offset, $booksPerPage");

?>
<!DOCTYPE html>
<html>

<head>
  <title>Mass.Books | Home</title>
  <link rel="styleSheet" href="main/main.css">
  <link rel="icon" href="main/logo.png" />
  <link rel="styleSheet" href="home.css">
  <link rel="styleSheet" href="main/book.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    ul {
      display: grid;
      
    grid-template-columns: repeat(auto-fill, minmax(250px, 2fr));
    }
    .align > li{
      width: auto;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>

</head>

<body>
  <script src="main/main.js"></script>
  <script src="main/loader.js"></script>
  <?php
  include "main/header.php";
  ?>
  <section class="sec1">
    <div class="bigDiv">
      <?php
      $bannerNum = 7;

      // Fetch ads data from the table
      $myads = mysqli_query($conn, "SELECT * FROM `ads`");

      for ($i = 1; $i <= $bannerNum; $i++) {
        $adData = mysqli_fetch_assoc($myads);
        $backgroundImagePath = $adData ? $adData["cover"] : "Ads/Defult Ad.jpeg";
        $divId = 'div' . ($adData ? $adData['id'] : 0);

        // Output the div with background image
        echo '
        <div id="' . $divId . '" style="background-image: url(\'' . $backgroundImagePath . '\');">
        </div>
    ';

        // Output CSS styles for ::after
        echo '
        <style>
            #' . $divId . '::after {
                background-image: url(\'' . $backgroundImagePath . '\');
            }
        </style>
    ';
        if ($i == $bannerNum) {
          // Fetch the first ad for the last iteration
          $firstAd = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `ads` LIMIT 1"));
          $backgroundImagePath = $firstAd ? $firstAd['cover'] : "Ads/Defult Ad.jpeg";
          $firstDivId = 'div' . ($firstAd ? $firstAd['id'] : 0);

          // Output the first div with background image
          echo '
    <div id="' . $firstDivId . '" style="background-image: url(\'' . $backgroundImagePath . '\');">
    </div>
';

          // Output CSS styles for ::after of the first div
          echo '
    <style>
        #' . $firstDivId . '::after {
            background-image: url(\'' . $backgroundImagePath . '\');
        }
    </style>
';
        }
      }


      ?>
    </div>
    <?php
    //echo $_SESSION["userName"];
    ?>
  </section>
  <section class="search">
    <form action="search.php" class="container" method="get">
      <?php
        if (isset($_GET['query'])) {
          
    $searchQuery = htmlspecialchars($_GET['query']);
          echo '  <input required type="text" id="search" value="'.($searchQuery).'" name="query" placeholder="Type something..." >';
        }else{
          echo '  <input required type="text" id="search" name="query" placeholder="Type something..." >';
        }
      ?>
      

      <input type="submit" value="Search" id="Sbtn">

    </form>

  </section>

  <section class="sec2">
    <div class="container">
      <h1 class="titel">
        The <span>Popular</span> Books
      </h1>
      <div class="books" id="Pbooks">
        <div class="component" id="books">
          <ul class="align al1">
          <?php while ($data = mysqli_fetch_assoc($mybooks)) { ?>
              <li>
                <?php
                $dataId = $data["id"];
                ?>
                <?php
                echo "<input type='checkbox' id='Pbook$dataId'><label for='Pbook$dataId'>";
                ?>


                <figure class='book'>

                  <!-- Front -->

                  <ul class='hardcover_front'>
                    <li>
                      <div class="coverDesign blue">

                      </div>
                    </li>
                    <li>
                    </li>
                  </ul>

                  <!-- Pages -->

                  <ul class='page'>
                    <li>

                    </li>
                    <li style="color:#000;">

                      <p titel="name:--------.">name: <?= $data["name"]  ?></p>
                      <p>Language:----.</p>
                      <p>rate:5.0.</p>
                      <p>learn:.....</p>
                      <a href="games.php"> <button>
                          <p>download</p>
                        </button>
                      </a>


                    </li>
                    <li>
                    </li>
                    <li>
                    </li>
                    <li>
                    </li>
                  </ul>

                  <!-- Back -->

                  <ul class='hardcover_back'>
                    <li></li>
                    <li></li>
                  </ul>
                  <ul class='book_spine'>
                    <li></li>
                    <li></li>
                  </ul>
                  <?php
                  if ((isset($_SESSION["userId"]) && $_SESSION["userId"] == $data["userId"]) || (isset($_SESSION['userType']) && $_SESSION['userType'] == "admin")) {
                    echo '<a style="right:-25px;top:-25px;" class="delete" href="delete.php?type=books&id=' . htmlspecialchars($data["id"]) . '">-</a> ';
                  }
                  ?>


                </figure>
              </li>
              </label>
              </li>

            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <?php
    // Pagination
    $totalBooks = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `books`"));
    $totalPages = ceil($totalBooks / $booksPerPage);

    echo '<div class="pageBar">';
    if ($page > 1) {
      echo '<a class="caret-a" href="?page=' . $page - 1 . '#books"> <img src="img/caret-left.svg" class="caret-left"> </a> ';
    }
    if ($totalPages > 1) {
      for ($i = 1; $i <= $totalPages; $i++) {


        if ($i == $page) {

          echo '<a class="page" href="?page=' . $i . '#books">' . $i . '</a> ';
        } else {

          echo '<a href="?page=' . $i . '#books">' . $i . '</a> ';
        }
      }
    }
    if ($page < $totalPages) {
      echo '<a class="caret-a" href="?page=' . $page + 1 . '#books"> <img src="img/caret-right.svg" class="caret-right"></a> ';
    }

    echo '</div>';

    // Close the database connection
    mysqli_close($conn);
    ?>
  <section class="footer">
    <p class="tertiary">
      &copy; 2023 Mass.books . All Rights Reserved
    </p>
  </section>

</body>
<script src="main/main2.js"></script>

</html>