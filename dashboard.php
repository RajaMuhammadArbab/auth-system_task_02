<?php

session_start();
if (!isset($_SESSION['loggedin'])){
    header("Location: login.php");
        exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']);?>!</h1>
    <a href="profile.php">Update Profile</a> | 
    <a href="change_password.php">Change Password</a> | 
    <a href="logout.php">Logout</a>
</body>
</html>