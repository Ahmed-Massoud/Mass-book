<?php
include "conn.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name']     ?? '';
    $username = $_POST['username'] ?? '';
    $email    = $_POST['email']    ?? '';
    $password = $_POST['password'] ?? '';

    // التحقق من ملء البيانات
    if (empty($name) || empty($username) || empty($email) || empty($password)) {
        die("يرجى ملء جميع الحقول");
    }

    // تشفير كلمة المرور (اختياري لكن موصى به)
    // $password = password_hash($password, PASSWORD_DEFAULT);

    // استخدام prepared statement للإدخال
    $stmt = $conn->prepare("INSERT INTO users (`name`, `username`, `email`, `password`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $username, $email, $password);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // تسجيل الدخول بعد التسجيل
        $stmt2 = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt2->bind_param("ss", $username, $password);
        $stmt2->execute();
        $result = $stmt2->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $_SESSION["userUname"] = $row["username"];
            $_SESSION["userName"]  = $row["name"];
            $_SESSION["userFName"] = $row["first name"] ?? '';
            $_SESSION["userLName"] = $row["last name"] ?? '';
            $_SESSION["userEmail"] = $row["email"];
            $_SESSION["userId"]    = $row["id"];
            $_SESSION["userType"]  = $row["type"] ?? '';

            // ✨ إنشاء صفحة البروفايل
            $templatePath = 'profile/profile.htm';
            if (file_exists($templatePath)) {
                $template = file_get_contents($templatePath);
                $updated  = str_replace(['{{name}}', '{{email}}'], [$name, $email], $template);
                file_put_contents("profile/$username.html", $updated);
            }

            // إعادة التوجيه لصفحة البروفايل
            header("Location: profile/$username.html");
            exit;
        }
    } else {
        die("فشل في التسجيل. ربما اسم المستخدم مستخدم بالفعل.");
    }
}
?>
