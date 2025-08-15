<?php
session_start();
if (!(isset($_SESSION['userType']) && $_SESSION['userType'] == "admin")) {
    header("Location: login.php");
    exit();
}

include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $userId = $_SESSION["userId"];

    // Create a folder for the book
    $dir = "books/$name/";
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    // --- Upload Cover ---
    $coverName = null;
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
        $coverExt = strtolower(pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION));
        $coverName = uniqid("cover_") . "." . $coverExt;
        move_uploaded_file($_FILES['cover']['tmp_name'], $dir . $coverName);
    }

    // --- Upload File ---
    $fileName = null;
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $fileExt = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        $fileName = uniqid("file_") . "." . $fileExt;
        move_uploaded_file($_FILES['file']['tmp_name'], $dir . $fileName);
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO `books` (`name`, `userId`, `description`, `coverName`, `fileName`) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("SQL Error: " . $conn->error); // Show SQL error if prepare fails
    }
    $stmt->bind_param("sisss", $name, $userId, $description, $coverName, $fileName);
    $stmt->execute();

    // Create the book page
    $templatePath = 'games.php';
    if (file_exists($templatePath)) {
        $template = file_get_contents($templatePath);
        $updated = str_replace(['{{name}}', '{{description}}', '{{fileName}}'], [$name, $description, $fileName], $template);
        file_put_contents("Books/$name/index.php", $updated);
    }

    header("Location: Books/$name/");
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
            <form class="signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
                enctype="multipart/form-data">
                <label class="sig">Upload Book</label>
                <div class="grid">

                    <div class="user-box">
                        <input type="text" id="name" name="name" autocomplete="off">

                        <label id="usernameLabel">Name</label>

                    </div>

                    <div class="user-box">
                        <input type="text" id="description" name="description" autocomplete="off">

                        <label id="usernameLabel">description</label>

                    </div>
                    <div class="user-box">
                        <input type="file" id="cover" name="cover" accept="image/*" autocomplete="off">
                        <input type="button" class="fileBtn" id="coverBtn" value="Upload Cover">
                    </div>
                    <div class="user-box">
                        <input type="file" id="file" name="file" accept=".pdf" autocomplete="off">
                        <input type="button" class="fileBtn" id="fileBtn" value="Upload book">
                    </div>
                </div>

                <input type="submit" id="button">
            </form>
        </div>

    </div>
    <script src="main/sweetalert.js"></script>
    <script>
        const form = document.querySelector(".signup");
        nameInput = document.getElementById("name");
        descriptionInput = document.getElementById("description");
        const coverInput = document.getElementById("cover");
        const coverBtn = document.getElementById("coverBtn");
        const fileInput = document.getElementById("file");
        const fileBtn = document.getElementById("fileBtn");

        form.addEventListener("submit", function (e) {
            if (nameInput.value.trim() === "") {
                swal("Name is required", "", "error");
                e.preventDefault();
            }
            else if (descriptionInput.value.trim() === "") {
                swal("Description is required", "", "error");
                e.preventDefault();
            }
            else if (coverInput.files.length === 0) {
                swal("Cover is required", "", "error");
                e.preventDefault();
            }
            else if (fileInput.files.length === 0) {
                swal("File is required", "", "error");
                e.preventDefault();
            }
        });

        fileBtn.addEventListener("click", () => {
            fileInput.click()

        })

        coverBtn.addEventListener("click", () => {
            coverInput.click()

        })
    </script>











    <script src="main/main.js"></script>
    <script>
        loader = document.querySelector(".loader");

        window.addEventListener("load", function () {
            loader.style.display = "none";
        });
    </script>


</body>

<?php


?>