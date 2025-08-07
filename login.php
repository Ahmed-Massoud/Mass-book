<?php
$wrong = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "conn.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION["userUname"] = $row["username"];
        $_SESSION["userName"] = $row["name"];

        $_SESSION["userFName"] = $row["first name"];
        $_SESSION["userLName"] = $row["last name"];
        $_SESSION["userEmail"] = $row["email"];

        $_SESSION["userId"] = $row["id"];
        $_SESSION["userType"] = $row["type"];
        header("Location: index.php");
        exit();
    } else {

        $wrong = true;
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Page title</title>
    <link rel="stylesheet" href="main/main.css">
    <link rel="stylesheet" href="main/new.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>


    <script src="main/sweetalert.js"></script>
    <?php
    if ($wrong == true) {
        echo ('
        
        <script>
        swal("wrong username or password","","error");</script>
        ');
    }


    ?>

    <div id="container">
        <div class="main" id="main">
            <input type="checkbox" id="chk">
            <div class="signup">
                <label for="chk" class="sig">Sign up</label>
                <form action="create_account.php" method="POST" onsubmit="return check()">
                    <div class="user-box">
                        <input type="text" name="name" title="Enter your name" id="name" autocomplete="off" />

                        <label id="nameLable">Name</label>
                        <div class="eye">
                            <i class="fa-solid fa-circle-info" id="nameIcon"></i>
                        </div>
                    </div>
                    <div class="user-box">
                        <input type="text" name="username" title="Enter Username" id="username" autocomplete="off">

                        <label id="usernameLabel">Username</label>

                        <div class="eye">

                            <i class="fa-solid fa-circle-info" id="userIcon"></i>
                        </div>


                        <i></i>
                    </div>
                    <div class="user-box">
                        <input type="text" name="email" title="Enter email" id="email" autocomplete="off">
                        <label id="emailLabel">Email</label>
                        <div class="eye">

                            <i class="fa-solid fa-circle-info" id="emailIcon"></i>
                        </div>
                    </div>
                    <div class="user-box">
                        <input type="password" name="password" title="Enter password" id="password" autocomplete="off">

                        <label id="passwordLabel">Password</label>
                        <div class="eye">
                            <i class="fa-solid fa-eye" id="eye1"></i>
                            <i class="fa-solid fa-eye-slash" id="eye2"></i>
                            <i class="fa-solid fa-circle-info" id="passIcon"></i>
                        </div>
                    </div>

                    <input type="submit" class="button" id="button" value="create account">
                </form>
            </div>

            <form action="" method="post" class="login">

                <label for="chk" class="log">Login</label>



                <div class="user-box">

                    <input type="text" title="Enter Username" name="username" id="username2" required>

                    <label>Username</label>

                </div>

                <div class="user-box">

                    <input type="password" name="password" title="Enter password" id="password2" required>

                    <label>Password</label>

                </div>
                <input type="submit" class="button" id="button2" value="login">

            </form>

        </div>
</body>
<script src="main/new.js"></script>
<script src="main/main.js"></script>

</html>