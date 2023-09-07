<?php
session_start();

require "diapo.php";
require "section_all_products.php";


?>

<!doctype html>

<html lang="fr">

	<head>
		<meta charset="utf-8">
		<title>Lalaina Creation</title>
        <link rel="icon" type="image/x-icon" href="../../img/logo_2.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="index.css">
		<link rel="stylesheet" href="section_all_products.css">
		<link rel="stylesheet" href="diapo.css">
		<link rel="stylesheet" href="../footer.css">
        <link rel="stylesheet" href="../header.css">

        <script src="navbar.js"></script>
        <script src="move_diapo.js"></script>


    </head>

	<body>

		<?php
        include '../header.php';
        ?>

		<main>

			<?php
			generate_diapo("Femme", "SELECT * FROM product WHERE sex = 'Femme' LIMIT 4");
			?>

			<?php
			generate_section_all_products("Homme", "SELECT * FROM product WHERE sex = 'Homme'");
			?>

			<?php
			generate_diapo("Nouveautés", "SELECT * FROM product p, nouveautes n  WHERE p.id_product=n.id_product");
			?>

			<?php
			generate_section_all_products("Femme", "SELECT * FROM product WHERE sex = 'Femme'");
			?>




		</main>

		<?php
        include '../footer.php';
        ?>

	</body>

</html>