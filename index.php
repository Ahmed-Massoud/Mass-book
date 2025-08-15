<?php
session_start();
//die($_SESSION["admin"]);
?>
<?php
include "conn.php";

$mybooks = mysqli_query($conn, "SELECT * FROM `books`");
//die($mybooks);
$myads = mysqli_query($conn, "SELECT * FROM `ads`");


$commentsPerPage = 4;
$totalComments = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `comments`"));
$totalPages = ceil($totalComments / $commentsPerPage);
$page = isset($_GET['page']) ? min($_GET['page'], $totalPages) : 1;
$offset = ($page - 1) * $commentsPerPage;

$mycomments = mysqli_query($conn, "SELECT * FROM `comments` LIMIT $offset, $commentsPerPage");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $commentText = $_POST["submit"];

  if (isset($_SESSION["userName"]) && $_SESSION["userName"] != "" && isset($_SESSION["userEmail"]) && $_SESSION["userEmail"] != "") {

    $commentName = $_SESSION["userName"];
    $commentEmail = $_SESSION["userEmail"];
    $commentUserId = $_SESSION["userId"];
  } else {
    $commentName = $_POST["FirstN"] . " " . $_POST["LastN"];
    $commentEmail = $_POST["email"];
    $commentUserId = 0;
  }
  $commentImg = 'user/gast.svg';

  //$commentUserId = 4;

  $insertQuery = "INSERT INTO `comments` (`comment`, `name`, `email`,`img`,`userId`) VALUES ('$commentText', '$commentName','$commentEmail','$commentImg','$commentUserId')";
  mysqli_query($conn, $insertQuery);
  header("Location: index.php");
  exit();
}
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


      for ($i = 1; $i <= $bannerNum; $i++) {
        $adData = mysqli_fetch_assoc($myads);
        $backgroundImagePath = $adData ? $adData["cover"] : "Ads/Defult Ad.jpeg";
        $divId = 'div' . ($adData ? $adData['id'] : 0);
        $link = $adData ? $adData["link"] : "#";
        // Output the div with background image
        echo '
        <div id="' . $divId . '" style="background-image: url(\'' . $backgroundImagePath . '\');">
        
        <a href="' . $link . '">
        </a>
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
      <input required type="text" id="search" name="query" placeholder="Type something...">

      <input type="submit" value="Search" id="Sbtn">

    </form>

  </section>
  <section class="sec2">
    <div class="container">
      <h1 class="titel">
        The <span>Popular</span> Books
      </h1>
      <div class="books" id="Pbooks">
        <div class="component">
          <ul class="align al1">
            <?php foreach ($mybooks as $data) { ?>
              <li>
                <?php
                $dataId = $data["id"];
                $name = $data["name"];
                $coverName = $data["coverName"];
                ?>
                <?php
                echo "<input type='checkbox' id='Pbook$dataId'><label for='Pbook$dataId'>";
                ?>


                <figure class='book'>

                  <!-- Front -->

                  <ul class='hardcover_front'>
                    <li>
                      <div class="coverDesign blue" 
     style="background-image: url('books/<?php echo htmlspecialchars($name); ?>/<?php echo htmlspecialchars($coverName); ?>')">
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

                      <p titel="name:--------.">name: <?= $data["name"] ?></p>
                      <p>Language:----.</p>
                      <p>rate:5.0.</p>
                      <p>learn:.....</p>
                      <a href="Books/<?php echo htmlspecialchars($name); ?>/"> <button>
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
  <section class="sec3">
    <div class="container">
      <h1 class="titel">
        The <span>Recent</span> Books
      </h1>
      <div class="books" id="Rbooks">
        <div class="component">
          <ul class="align al2">
            <?php foreach ($mybooks as $data) { ?>
              <li>
                <?php
                $dataId = $data["id"];
                $name = $data["name"];
                $coverName = $data["coverName"];
                ?>
                <?php
                echo "<input type='checkbox' id='Rbook$dataId'><label for='Rbook$dataId'>";
                ?>


                <figure class='book'>
                  <!-- Front -->

                  <ul class='hardcover_front'>
                    <li>
                       <div class="coverDesign blue" 
     style="background-image: url('books/<?php echo htmlspecialchars($name); ?>/<?php echo htmlspecialchars($coverName); ?>')">
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

                      <p titel="name:--------.">name: <?= $data["name"] ?></p>
                      <p>Language:----.</p>
                      <p>rate:5.0.</p>
                      <p>learn:.....</p>
                      <a href="Books/<?php echo htmlspecialchars($name); ?>/"> <button>
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
  <section id="comments" class="comment">
    <h1 class="titel">
      The <span>Comment</span> Section
    </h1>
    <div class=" commentContainer container">

      <?php while ($row = mysqli_fetch_assoc($mycomments)) { ?>

        <div class="CommentD">


          <?php
          if ((isset($_SESSION["userId"]) && $_SESSION["userId"] == $row["userId"]) || (isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin')) {
            echo '<a class="delete" href="delete.php?type=comments&id=' . htmlspecialchars($row["id"]) . '">-</a> ';
          }
          ?>

          <div class="info">
            <img src="<?php echo htmlspecialchars($row["img"]) ?>">
            <div>
              <h4> <?= $row["name"] ?></h4>
              <p><?= $row["email"] ?></p>
            </div>
          </div>
          <div class="CommentData">
            <p><?= $row["comment"] ?></p>
          </div>
        </div>
      <?php } ?>


    </div>
    <?php
    // Pagination
    $totalComments = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `comments`"));
    $totalPages = ceil($totalComments / $commentsPerPage);

    echo '<div class="pageBar">';
    if ($page > 1) {
      echo '<a class="caret-a" href="?page=' . $page - 1 . '#comments"> <img src="img/caret-left.svg" class="caret-left"> </a> ';
    }
    if ($totalPages > 1) {
      for ($i = 1; $i <= $totalPages; $i++) {


        if ($i == $page) {

          echo '<a class="page" href="?page=' . $i . '#comments">' . $i . '</a> ';
        } else {

          echo '<a href="?page=' . $i . '#comments">' . $i . '</a> ';
        }
      }
    }
    if ($page < $totalPages) {
      echo '<a class="caret-a" href="?page=' . $page + 1 . '#comments"> <img src="img/caret-right.svg" class="caret-right"></a> ';
    }

    echo '</div>';

    // Close the database connection
    mysqli_close($conn);
    ?>
    <div class="container" style="margin-top:30px">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <?php
        if (isset($_SESSION["userName"]) && $_SESSION["userName"] != "" && isset($_SESSION["userEmail"]) && $_SESSION["userEmail"] != "") {
        } else {
          echo '
  <div>
          <label for="FirstN">First Name</label>
          <input required type="text" id="FirstN" name="FirstN" placeholder="Enter your first Name">

        </div>
        <div>
          <label for="LastN">Last Name</label>
          <input required type="text" id="LastN" name="LastN" placeholder="Enter your last Name">
        </div>
        <div>
          <label for="email">Email</label>
          <input required type="email" id="email" name="email" placeholder="Enter your email">
        </div>
        
  
  ';
        }



        ?>

        <div>
          <label for="comment">comment</label>
          <textarea required id="comment" name="submit" placeholder="Enter your massage..."></textarea>
          <input type="submit" id="submit" value="Comment">
        </div>
      </form>
    </div>
  </section>





  <section class="footer">
    <p class="tertiary">
      &copy; 2023 Mass.books . All Rights Reserved
    </p>
  </section>
</body>
<script src="main/main2.js"></script>
<script src="home.js"></script>

</html>