<?php
session_start();
?>

<!DOCTYPE html>

<html lang="fr">

	<head>
		<meta charset="utf-8">
		<title>Lalaina Creation</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../header.css">
		<link rel="stylesheet" href="product.css">
		<link rel="stylesheet" href="../footer.css">

		<script src="change_img.js"></script>
        <script src="navbar.js"></script>
        <script src="zoom_img.js"></script>


	</head>

	<body>

		<?php
        include '../header.php';
        ?>

		<main>

			<section id="resume_product">

				<div id="img_product">

					<?php

					try {
				        $dbh = new PDO('mysql:host=localhost;dbname=store_lalaina', "root", "@BDJMTC10+");
				        //var_dump($dbh);
				    } catch (PDOException $e) {
				        print "Erreur !: " . $e->getMessage() . "<br/>";
				        die();
				    }

					$sql = "SELECT * FROM product, image WHERE product.id_product=image.id_product AND product.id_product = ? ORDER BY product.id_product LIMIT 1";
				    $stmt = $dbh->prepare($sql);
				    $stmt->execute([$_GET['id_product']]);
					$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

					?>

					<div id="show_img_product">
                        <div class="div_fleche fleche_gauche">
                            <img src="../../img/fleche-gauche.png" alt="Fleche gauche">
                        </div>
						<?php
						echo "<img class='show_img' src='../../img_store/" . $res[0]['path'] . "' alt=''>"
						?>
                        <div class="div_fleche fleche_droite">
                            <img src="../../img/fleche-droite.png" alt="Fleche droite">
                        </div>
					</div>
					<div id="all_img_product">
						<?php
						$sql = "SELECT * FROM product, image WHERE product.id_product=image.id_product AND product.id_product = ? ORDER BY product.id_product";
					    $stmt = $dbh->prepare($sql);
					    $stmt->execute([$_GET['id_product']]);
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($res as $img) {
							$path_img = "../../img_store/" . $img["path"];
	                        echo "<img class='all_img' src=$path_img alt=''>";
						}
						?>
						<!--<img class="all_img" src="../img/pantalon_1.jpg" alt="">
						<img class="all_img" src="../img/pantalon_2.jpg" alt="">
						<img class="all_img" src="../img/pantalon_3.jpg" alt="">
						<img class="all_img" src="../img/pantalon_1.jpg" alt="">
						<img class="all_img" src="../img/pantalon_2.jpg" alt="">
						<img class="all_img" src="../img/pantalon_3.jpg" alt="">
						<img class="all_img" src="../img/pantalon_1.jpg" alt="">
						<img class="all_img" src="../img/pantalon_2.jpg" alt="">
						<img class="all_img" src="../img/pantalon_3.jpg" alt="">-->
					</div>
				</div>

				<?php
				$sql = "SELECT * FROM product WHERE product.id_product = ?";
			    $stmt = $dbh->prepare($sql);
			    $stmt->execute([$_GET['id_product']]);
				$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				?>

				<div id="info_product">
					<div id="div_product_title">
						<?php
                        echo "<h1 id='product_title'>" . $res[0]['title'] . "</h1>";
						?>
					</div>
					<div id="div_product_price">
						<?php
                        echo "<h2>" . $res[0]['price'] . ",00 €</h2>";
						?>
					</div>
					<div id="div_product_size">
						<?php
						$sql = "SELECT size FROM product, size WHERE product.id_product=size.id_product AND size.id_product = ?";
					    $stmt = $dbh->prepare($sql);
					    $stmt->execute([$_GET['id_product']]);
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						foreach ($res as $size) {

							echo "<h2 class='size'>" . $size['size'] . "</h2>";

						}
						?>
					</div>
				</div>

                <div id="zoom_img_product" class="zoom_img_hide">
	                <div id="div_close_zoom">
                        <img id="img_close_zoom" src="../../img/signe-de-la-croix.png" alt="Close">
                    </div>
	                <div id="div_img_zoom">
                        <div class="div_fleche fleche_gauche">
                            <img src="../../img/fleche-gauche.png" alt="Fleche gauche">
                        </div>
                        <div id="div_zoom"></div>
                        <div class="div_fleche fleche_droite">
                            <img src="../../img/fleche-droite.png" alt="Fleche droite">
                        </div>
                    </div>
                </div>

			</section>

			<section id="add_basket">
				<form action="add_basket.php" method="post" id="form_add_basket">
                    <label id="label_input_qte" for="input_qte">Quantité</label>
					<select name="qte" id="input_qte">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
                    <?php
                    $value_id_product = $_GET['id_product'];
                    echo "<input type='hidden' name='input_id_product' value=$value_id_product>";
                    ?>
					<input id="input_add_basket" type="submit" value="Ajouter au panier">
				</form>
			</section>



		</main>

		<?php
        include '../footer.php';
        ?>

	</body>

</html>