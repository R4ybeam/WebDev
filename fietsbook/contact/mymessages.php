<?php

// Constanten (connectie-instellingen databank)
define ('DB_HOST', 'localhost');
define ('DB_USER', 'r4ybeam');
define ('DB_PASS', 'Kaprekar-6174');
define ('DB_NAME', 'fietsbook');


date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST .';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' .  $e->getMessage();
    exit;
}

// Opvragen van alle taken uit de tabel tasks
$stmt = $db->prepare('SELECT * FROM messages ORDER BY added_on DESC');
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);


?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Mijn berichten</title>
</head>
<body>
    <?php if (sizeof($items) > 0) { ?>
    <ul>
        <?php foreach ($items as $item) { ?>
        <li><?php echo $item['sender']; ?> : <?php echo $item['email']; ?> : <?php echo $item['message']; ?> (<?php echo (new Datetime($item['added_on']))->format('d-m-Y H:i:s'); ?>)</li>
        <?php } ?>
    </ul>
    <?php
    } else {
        echo '<p>Nog geen berichten ontvangen.</p>' . PHP_EOL;
    }
    ?>


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
