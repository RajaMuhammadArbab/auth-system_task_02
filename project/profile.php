<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
require 'db.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $new_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    $stmt = $conn->prepare("UPDATE users SET username=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $new_username, $new_email, $user_id);

    if ($stmt->execute()) {
        echo "✅ Profile updated successfully!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
?>

<h2>Update Profile</h2>
<form method="POST">
    Username: <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br>
    <input type="submit" value="Update">
</form>
