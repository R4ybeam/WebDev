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

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Insert new post into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO posts (user_id, content) VALUES ($user_id, '$content')";
    $conn->query($query);

    header("Location: index.php");
    exit();
}
?>
