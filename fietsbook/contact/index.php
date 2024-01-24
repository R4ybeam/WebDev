<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'r4ybeam');
define('DB_PASS', 'Kaprekar-6174');
define('DB_NAME', 'fietsbook');

date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' . $e->getMessage();
    exit;
}

$name = isset($_POST['name']) ? (string)$_POST['name'] : '';
$email = isset($_POST['email']) ? (string)$_POST['email'] : '';
$message = isset($_POST['message']) ? (string)$_POST['message'] : '';
$msgName = '';
$msgEmail = '';
$msgMessage = '';

// form is sent: perform formchecking!
if (isset($_POST['btnSubmit'])) {

    $allOk = true;

    // name not empty
    if (trim($name) === '') {
        $msgName = 'Gelieve je naam in te voeren';
        $allOk = false;
    }
    if (trim($email) === '') {
        $msgEmail = 'Gelieve je e-mail in te voeren';
        $allOk = false;
    }
    if (str_contains($email, '.') === false or str_contains($email, '@') === false) {
        $msgEmail = 'Gelieve een geldige e-mail in te voeren';
        $allOk = false;
    }
    if (trim($message) === '') {
        $msgMessage = 'Gelieve een boodschap in te voeren';
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        $stmt = $db->exec('INSERT INTO messages (sender, email, message, added_on) VALUES (\'' . $name . '\',\'' . $email . '\',\'' . $message . '\',\'' . (new DateTime())->format('Y-m-d H:i:s') . '\')');

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('Location: formchecking_thanks.php?name=' . urlencode($name));
            exit();
        } // the query failed
        else {
            echo 'Databankfout.';
            exit;
        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
    <link rel="stylesheet" href="https://unkpg.com/@csstools/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/contact.css">
</head>

<body>
    <input type="checkbox" id="menu-toggle" style="display: none;">
    <header>
        <img src="../images/logo.png" alt="Fietsbook logo">
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
            <a href="../">Home</a>
			<a href="../products/">Products</a>
            <a href="../tools/">Tools</a>
            <a href="../hotspots/">Hotspots</a>
            <a href="../about/">About</a>
            <a href="../activity/">Activity</a>
            <a href="./">Contact Us</a>
            
        </nav>
    </header>

    <main>
        <section class="container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <h2>Contactform</h2>
                <p class="message">Alle velden zijn verplicht, tenzij anders aangegeven.</p>
        
                <div>
                    <label for="name">Jouw naam</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="input-text"/>
                    <span class="message error"><?php echo $msgName; ?></span>
                </div>
                <div>
                    <label for="email">Jouw e-mail</label>
                    <input type="text" id="email" name="email" value="<?php echo $email; ?>" class="input-text"/>
                    <span class="message error"><?php echo $msgEmail; ?></span>
                </div>
                <div>
                    <label for="message">Boodschap</label>
                    <textarea name="message" id="message" rows="5" cols="40"><?php echo $message; ?></textarea>
                    <span class="message error"><?php echo $msgMessage; ?></span>
                </div>
        
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Verstuur"/>
            </form>
        </section>
    </main>

    <footer>
        <section>
            <div class="bottom-nav">
                <ul>
                    <li><a href="../privacy/">Privacy Policy</a></li>
                    <li><a href="../about/">About</a></li>
                    <li><a href="./">Contact</a></li>
                    <li><a href="../links">Useful links</a></li>
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
