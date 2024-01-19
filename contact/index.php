<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'r4ybeam');
define('DB_PASS', 'Kaprekar-6174');
define('DB_NAME', 'portofolioform');

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
    if (trim($email) === '') {
        $msgEmail = 'Gelieve je e-mail in te voeren';
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

?><!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacteer mij</title>
    <link rel="stylesheet" href="https://unpkg.com/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <nav>
            <h1>Miguel Ringoot</h1>
            <ul>
                <li>
                    <a href="../">Home</a>
                </li>
                <li>
                    <a href="../projecten/">Projecten</a>
                </li>
                <li>
                    <a href="../cv/">CV</a>
                </li>
                <li>
                    <a href="../blog/">Blog</a>
                </li>
                <li>
                    <a href="./">Contact</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <h2>Conatctform</h2>
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
        <p>Copyright &copy; 2023 Miguel Ringoot</p>
    </footer>
</body>
</html>