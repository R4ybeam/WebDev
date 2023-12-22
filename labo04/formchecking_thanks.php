<?php

	$name = isset($_GET['name']) ? $_GET['name'] : false;
	$age = isset($_GET['age']) ? $_GET['age'] : false;

?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Testform</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="./style.css" />
</head>
<body>

<?php

	// Name sent in
	if ($name) {
		echo '<p>Thank you ' . htmlentities($name). '</p>';
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

</body>
</html>
