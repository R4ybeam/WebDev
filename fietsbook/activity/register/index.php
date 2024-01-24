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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $checkQuery = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $checkQuery->bind_param("s", $username);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();

    if ($checkResult->num_rows > 0) {
        $error = "Sorry, this username is already in use. Please choose another.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insertQuery->bind_param("ss", $username, $hashedPassword);
        $insertQuery->execute();

        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['username'] = $username;
        $_SESSION['success_message'] = "Registration successful! You can now log in.";
        header("Location: ../login/");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            <h2>Register</h2>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="./" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <button type="submit">Register</button>
            </form>

            <p>Already have an account? <a href="../login/">Login here</a></p>
        </section>
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
    <script src="../../js/lang_color.js"></script> 
</body>
</html>