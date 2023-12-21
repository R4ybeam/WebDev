<?php

	$name = isset($_GET['name']) ? $_GET['name'] : false;
	$age = isset($_GET['age']) ? $_GET['age'] : false;

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8"/>
    <title>Bedankt</title>
	<link rel="stylesheet" type="text/css" href="styles.css" />
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
				<?php

			// Name sent in
			if ($name) {
				echo '<p class="formmessage">Dankjewel voor je bericht ' . htmlentities($name). '</p>';
			}

			// Age sent in
			else if ($age) {
				echo '<p>Thank you, ' . htmlentities($age). ' year old stranger</p>';
			}

			// Nothing sent in
			else {
				echo '<p>Thank you, stranger</p>';
			}

			?>
		</section>
    </main>
    <footer>
        <p>Copyright &copy; 2023 Miguel Ringoot</p>
    </footer>
</body>

</html>