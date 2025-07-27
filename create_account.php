
<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (`name`, `username`, `email` ,`password`) VALUES ('$name','$username', '$email','$password')";
    mysqli_query($conn, $sql);

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
    }
}
?>