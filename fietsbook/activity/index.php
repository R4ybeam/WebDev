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
    header("Location: ./login/");
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
    <link rel="stylesheet" href="https://unpkg.com/@csstools/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/activity.css">
</head>

<body class="show-nav">
    <input type="checkbox" id="menu-toggle" style="display: none;">
    <header>
        <img src="../images/logo.png" alt="Fietsbook logo">
        <h1>Fietsbook</h1>
        <label for="menu-toggle" id="menu-icon">&#9776;</label>
        <div class="language-toggle">
            <div class="dropdown">
                <button class="dropbtn" id="color-scheme-btn">Scheme</button>
                <div class="dropdown-content">
                    <a href="" id="color-scheme-btn-light" onclick="setColorScheme('default')">Light Mode</a>
                    <a href="" id="color-scheme-btn-dark" onclick="setColorScheme('alternate')">Dark Mode</a>
                </div>
            </div>  
        </div>
        <nav>
            <a href="../">Home</a>
            <a href="../tools/">Tools</a>
            <a href="../hotspots/">Hotspots</a>
            <a href="../about/">About</a>
            <a href="./">Activity</a>
            <a href="../contact/">Contact Us</a>
            
        </nav>
    </header>

    <main>
        <section class="container">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <button><a href="logout.php">Logout</a></button>

            <form action="post.php" method="post">
                <textarea name="content" placeholder="What's on your mind?"></textarea>
                <button type="submit">Post</button>
            </form>

            <h2>Recent Posts</h2>

            <?php
            while ($row = $result->fetch_assoc()) {
                $postId = $row['id'];
                $authorUsername = htmlspecialchars($row['author_username']);
                $content = htmlspecialchars($row['content']);
                $createdAt = htmlspecialchars($row['created_at']);

                echo "<p><strong>{$authorUsername}</strong> posted on {$createdAt}:<br>{$content}</p>";
            }
            ?>
        </section>
    </main>

    <footer>
        <section>
            <div class="bottom-nav">
                <ul>
                    <li><a href="../privacy/">Privacy Policy</a></li>
                    <li><a href="../about/">About</a></li>
                    <li><a href="../contact/">Contact</a></li>
                    <li><a href="../links/">Useful links</a></li>
                    <li><a href="../service/">Terms of Service</a></li>
                </ul>
            </div>
        </section>
        <p>&copy; 2023 Fietsbook. All rights reserved.</p>
    </footer>
<script src="../js/lang_color.js"></script>
<script>
    function setColorScheme(scheme) {
        document.body.classList.remove('dark-mode', 'light-mode');

        if (scheme === 'default') {
            document.body.classList.add('light-mode');
        } else if (scheme === 'alternate') {
            document.body.classList.add('dark-mode');
        }

        applyDarkModeToElements(scheme);

        localStorage.setItem('colorScheme', scheme);
    }

    function applyDarkModeToElements(scheme) {
        const elementsToStyle = ['.funwelcome', '.product-title'];
        elementsToStyle.forEach((selector) => {
            const elements = document.querySelectorAll(selector);
            elements.forEach((element) => {
                element.classList.toggle('dark-mode', scheme === 'alternate');
            });
        });
    }

    function loadColorScheme() {
        const savedScheme = localStorage.getItem('colorScheme');
        setColorScheme(savedScheme || 'default');
    }

    document.addEventListener('DOMContentLoaded', loadColorScheme);
</script>
</body>

</html>
