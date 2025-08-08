<?php
session_start();
require 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;

            
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "❌ Incorrect password.";
        }
    } else {
        $message = "❌ Email not found.";
    }

    $stmt->close();
}
?>