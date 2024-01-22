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

// Display posts
$query = "SELECT posts.*, users.username AS author_username
          FROM posts
          INNER JOIN users ON posts.user_id = users.id
          ORDER BY posts.created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>activity</title>
    <link rel="stylesheet" href="https://unkpg.com/@csstools/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/activity.css">
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <header>
        <img src="../images/logo.png" alt="Fietsbook logo">
        <h1>Fietsbook</h1>
        <label for="menu-toggle" id="menu-icon">&#9776;</label>
        <nav>
            <a href="../">Home</a>
			<a href="../products/">Products</a>
            <a href="../tools/">Tools</a>
            <a href="../hotspots/">Hotspots</a>
            <a href="../about/">About</a>
            <a href="./">Activity</a>
            <a href="../contact/">Contact Us</a>
        </nav>
    </header>

    <main>
        
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

    <form action="post.php" method="post">
        <textarea name="content" placeholder="What's on your mind?"></textarea>
        <button type="submit">Post</button>
    </form>

    <h2>Recent Posts</h2>

    <?php
    while ($row = $result->fetch_assoc()) {
        $postId = $row['id'];
        $authorUsername = $row['author_username'];
        $content = $row['content'];
        $createdAt = $row['created_at'];

        echo "<p><strong>{$authorUsername}</strong> posted on {$createdAt}:<br>{$content}</p>";
    }
    ?>

    </main>

    <footer>
        <section>
            <div class="bottom-nav">
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Useful links</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
        </section>
        <p>&copy; 2023 Fietsbook. All rights reserved.</p>
    </footer>
    <script src="../js/lang_color.js"></script> 
</body>

</html>