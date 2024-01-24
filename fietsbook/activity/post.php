<?php
session_start();

$servername = "localhost";
$username = "r4ybeam";
$password = "Kaprekar-6174";
$dbname = "social_media_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $conn->real_escape_string($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $insertQuery = $conn->prepare("INSERT INTO posts (user_id, content) VALUES (?, ?)");
    $insertQuery->bind_param("is", $user_id, $content);
    
    if ($insertQuery->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $insertQuery->error;
    }
}
?>