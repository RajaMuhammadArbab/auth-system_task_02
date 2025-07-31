<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
require 'db.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_pass = $_POST['current_password'];
    $new_pass = $_POST['new_password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($hashed_pass);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($current_pass, $hashed_pass)) {
        $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->bind_param("si", $new_hash, $user_id);
        if ($stmt->execute()) {
            echo "✅ Password changed successfully!";
        } else {
            echo "❌ Failed to change password!";
        }
    } else {
        echo "❌ Current password is incorrect!";
    }
}
?>

<h2>Change Password</h2>
<head><link rel="stylesheet" href="style.css"></head>
<form method="POST">
    Current Password: <input type="password" name="current_password" required><br>
    New Password: <input type="password" name="new_password" required><br>
    <input type="submit" value="Change Password">
</form>
