<?php

function setSelect($arrayOptions, $optionSelected) {


	foreach ($arrayOptions as $options) {


		if ($optionSelected == $options) {
			echo "<option value=$options selected>$options</option>";
		} else {
			echo "<option value=$options>$options</option>";
		}

	}

}

function setCheckbox($arrayOptions, $optionSelected) {


	foreach ($arrayOptions as $options) {


		$for = "size_" . $options;
		echo "<label for=$for>$options</label>";

		if (in_array($options, $optionSelected)) {
			echo "<input id=$for name=$for type='checkbox' checked>";
		} else {
			echo "<input id=$for name=$for type='checkbox'>";
		}

	}

}

?>

<!doctype html>

<html lang="fr">

	<head>
		<meta charset="utf-8">
		<title>Lalaina Creation</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../header.css">
		<link rel="stylesheet" href="edit_product.css">
		<link rel="stylesheet" href="../footer.css">

		<script src="remove_img.js"></script>

	</head>

	<body>

		<?php
        include '../header.php';
        ?>

        <?php

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=store_lalaina', "root", "@BDJMTC10+");
            //var_dump($dbh);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

        ?>

		<main>

            <form action="edit_product_save.php" method="post" enctype="multipart/form-data">

	            <?php
	            $value = $_GET['id_product'];
	            echo "<input type='hidden' name='input_id_product' value=$value>"
	            ?>


                <label for="input_title">Intitulé du produit</label>
                <?php
                $sql = "SELECT * FROM product WHERE id_product=?";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$_GET['id_product']]);
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $value_input_title = $res[0]["title"];
                //echo "<input id='input_title' name='input_title' value=$value_input_title type='text'>"
                echo "<input id='input_title' name='input_title' value='" . $value_input_title . "' type='text'>"
                ?>
                <?php
                if (isset($_COOKIE['error_title'])) {
                    echo "<span class='span_error'>" . $_COOKIE['error_title'] . "</span>";
                }
                ?>
                <label for="input_type">Type</label>
                <select name="input_type" id="input_type">
                    <!--<option value="vetement">Vêtement</option>
                    <option value="epice">Epice</option>-->
	                <?php
	                $sql = "SELECT type FROM product WHERE id_product=?";
	                $stmt = $dbh->prepare($sql);
	                $stmt->execute([$_GET['id_product']]);
	                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
	                $value_type = $res[0]["type"];
	                setSelect(["Vetement", "Epice"], $value_type);
	                ?>
                </select>


                <label for="input_sex">Sexe</label>
                <select name="input_sex" id="input_sexe">
                    <!--<option value="femme">Femme</option>
                    <option value="homme">Homme</option>
                    <option value="enfant">Enfant</option>-->
	                <?php
	                $sql = "SELECT sex FROM product WHERE id_product=?";
	                $stmt = $dbh->prepare($sql);
	                $stmt->execute([$_GET['id_product']]);
	                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
	                $value_sex = $res[0]["sex"];
	                setSelect(["Femme", "Homme", "Enfant"], $value_sex);
	                ?>
                </select>


                <label for="input_price">Prix</label>
	            <?php
                $sql = "SELECT * FROM product WHERE id_product=?";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$_GET['id_product']]);
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $value_input_title = $res[0]["price"];
                echo "<input id='input_price' name='input_price' value=$value_input_title type='number'>"
                ?>
	            <?php
                if (isset($_COOKIE['error_price'])) {
                    echo "<span class='span_error'>" . $_COOKIE['error_price'] . "</span>";
                }
                ?>
                <label for="field_size">Taille disponible</label>
                <fieldset id="field_size">
                    <!--<label for="size_s">S</label>
                    <input id="size_s" name="size_s" type="checkbox">
                    <label for="size_m">M</label>
                    <input id="size_m" name="size_m" type="checkbox">
                    <label for="size_l">L</label>
                    <input id="size_l" name="size_l" type="checkbox">-->
	                <?php
	                $sql = "SELECT size FROM product, size WHERE product.id_product=size.id_product AND size.id_product = ?";
	                $stmt = $dbh->prepare($sql);
	                $stmt->execute([$_GET['id_product']]);
	                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
	                $value_size = array();
					foreach ($res as $size) {
						$value_size[] = $size['size'];
					}
	                setCheckbox(["S", "M", "L"], $value_size);
	                ?>
                </fieldset>

	            <div id="div_imgs_product">

		            <!--<div class='div_img_product'>
			            <div class="div_img">
				            <img class='img_product' src="../img_store/short-eliaz.jpg" alt='pantalon'>
			            </div>
			            <div class="div_img_other">
				            <p class="button_remove_img">X</p>
			                <input type="hidden" value="short-eliaz.jpg">
			            </div>
					</div>

		            <div class='div_img_product'>
			            <div class="div_img">
				            <img class='img_product' src="../img_store/short-eliaz.jpg" alt='pantalon'>
			            </div>
			            <div class="div_img_other">
				            <p class="button_remove_img">X</p>
			                <input type="hidden" value="short-eliaz.jpg">
			            </div>
					</div>

		            <div class='div_img_product'>
			            <div class="div_img">
				            <img class='img_product' src="../img_store/short-eliaz.jpg" alt='pantalon'>
			            </div>
			            <div class="div_img_other">
				            <p class="button_remove_img">X</p>
			                <input type="hidden" value="short-eliaz.jpg">
			            </div>
					</div>-->

		            <?php

		            $sql = "SELECT path FROM product, image WHERE product.id_product=image.id_product AND image.id_product = ?";
	                $stmt = $dbh->prepare($sql);
	                $stmt->execute([$_GET['id_product']]);
	                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

					foreach ($res as $img) {
						echo "<div class='div_img_product'>";
						echo "<div class='div_img'>";
						$path = "../../img_store/" . $img['path'];
			            echo "<img class='img_product' src=$path>";
						echo "</div>";
						echo "<div class='div_img_other'>";
			            echo "<p class='button_remove_img'>X</p>";
						$name = "input_img_" . $img['path'];
						echo "<input type='hidden' name=$name value='" . $img['path'] . "'>";
						echo "</div>";
						echo "</div>";
					}

		            ?>

	            </div>

	            <div id="div_add_img">
		            <p id="button_add_img">+ Ajouter une image</p>
	            </div>

	            <input id="input_submit" name="input_submit" type="submit" value="Sauvegarder">

            </form>

		</main>

		<?php
        include '../footer.php';
        ?>

	</body>

</html>