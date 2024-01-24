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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<input type="checkbox" id="menu-toggle" style="display: none;">
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
            <a href="../activity/">Activity</a>
            <a href="./">Contact Us</a>
        </nav>
    </header>
    <main>
        <section class="container">
				<?php

			// Name sent in
			if ($name) {
				echo '<p class="formmessage">Dankjewel voor je bericht ' . htmlentities($name). '</p>';
			}


			// Nothing sent in
			else {
				echo '<p>Thank you, stranger</p>';
			}

			?>
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
    <script src="../js/lang_color.js"></script> 
    <script src="../js/lang_color.js"></script>  
</body>

</html>