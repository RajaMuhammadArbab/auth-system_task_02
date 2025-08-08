<?php

session_start();
require 'db.php';


if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    $password = $_POST['password'];

    if(!$email || !$username || !$password ){
        echo "Invalid Input!";
        exit;
    }

    $stmt = $conn -> prepare("SELECT id FROM users WHERE email = ?");
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    $stmt -> store_result();

if($stmt->num_rows > 0){
    echo "Email already registered!";
}else{
    $hashed_password = password_hash($password,PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email , password) VALUES (?,?,?)");
    $stmt -> bind_param("sss" , $username , $email , $hashed_password);
    if ($stmt->execute()) {
    header("Location: login.html");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
    }
        }
?>