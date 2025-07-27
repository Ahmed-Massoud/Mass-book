<?php

session_start();
if ((isset($_SESSION['userType']) && $_SESSION['userType'] == "admin")) {
} else {
    header("Location: login.php");
}

include 'conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    session_start();
    $userId = $_SESSION["userId"];
    //$commentUserId = 4;

    $insertQuery = "INSERT INTO `books` (`name`,`userId`) VALUES ('$name','$userId')";
    mysqli_query($conn, $insertQuery);
    header("Location: index.php");
    exit();
}

?>


<head>
    <title>Mass.Books | Upload Book</title>
    <link rel="styleSheet" href="main/main.css">

    <link rel="styleSheet" href="main/Upload.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    </style>

</head>

<body>

    <script src="main/loader.js"></script>
    <?php
    include "main/header.php";
    ?>







    <div id="container">

        <div class="main" id="main">
            <form class="signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label class="sig">Upload Book</label>
                <div class="grid">

                    <div class="user-box">
                        <input type="text" id="name" name="name" required autocomplete="off">

                        <label id="usernameLabel">Name</label>

                    </div>
                </div>

                <input type="submit" id="button">

        </div>

    </div>












    <script src="main/main.js"></script>
    <script>
        loader = document.querySelector(".loader");

        window.addEventListener("load", function() {
            loader.style.display = "none";
        });
    </script>
</body>