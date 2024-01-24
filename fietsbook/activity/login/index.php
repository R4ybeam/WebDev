<?php
session_set_cookie_params(['secure' => true, 'httponly' => true]);
session_start();

$servername = "localhost";
$username = "r4ybeam";
$password = "Kaprekar-6174";
$dbname = "social_media_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['logout_message'])) {
    echo '<p class="logout-message">' . htmlspecialchars($_SESSION['logout_message']) . '</p>';
    unset($_SESSION['logout_message']); // Clear the message
}

$error = '';

if (isset($_SESSION['user_id'])) {
    header("Location: ../");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: ../");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://unpkg.com/@csstools/normalize.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/activity.css">
</head>
<body>
    <input type="checkbox" id="menu-toggle">
    <header>
        <img src="../../images/logo.png" alt="Fietsbook logo">
        <h1>Fietsbook</h1>
        <label for="menu-toggle" id="menu-icon">&#9776;</label>
        <div class="language-toggle">
            <div class="dropdown">
                <button class="dropbtn" id="color-scheme-btn">Scheme</button>
                <div class="dropdown-content">
                    <a href="#" id="color-scheme-btn-light" onclick="setColorScheme('default')">Light Mode</a>
                    <a href="#" id="color-scheme-btn-dark" onclick="setColorScheme('alternate')">Dark Mode</a>
                </div>
            </div>  
        </div>
        <nav>
            <a href="../../">Home</a>
			<a href="../../products/">Products</a>
            <a href="../../tools/">Tools</a>
            <a href="../../hotspots/">Hotspots</a>
            <a href="../../about/">About</a>
            <a href="../">Activity</a>
            <a href="../../contact/">Contact Us</a>
        </nav>
    </header>
    
    <main>
        <section class="container">
            <h2>Login</h2>
            
            <?php if (isset($error)): ?>
               <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="./" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <button type="submit">Login</button>
            </form>

            <p>Don't have an account? <a href="../register/">Register here</a></p>
        </section>
    </main>
    <footer>
        <section>
            <div class="bottom-nav">
                <ul>
                    <li><a href="../../privacy/">Privacy Policy</a></li>
                    <li><a href="../../about/">About</a></li>
                    <li><a href="../../contact/">Contact</a></li>
                    <li><a href="../../links">Useful links</a></li>
                    <li><a href="../../service/">Terms of Service</a></li>
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
