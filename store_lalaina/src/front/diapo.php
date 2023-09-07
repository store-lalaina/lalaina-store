<?php


function generate_diapo($title, $sql): void
{

	try {
		$dbh = new PDO('mysql:host=localhost;dbname=store_lalaina', "root", "@BDJMTC10+");
        //var_dump($dbh);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

	echo "<section class='diapo_section'>";
		echo "<div class='section_title'>";
			echo "<h2>$title</h2>";
		echo "</div>";
		echo "<div class='content_diapo_section'>";
			echo "<div class='div_fleche fleche_gauche'>";
				echo "<img src='../../img/fleche-gauche.png' alt='Fleche gauche'>";
			echo "</div>";
			echo "<div class='content_diapo'>";

    $stmt = $dbh->query($sql);
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $row) {

		/*echo "<pre>";
	    var_dump($row);
	    echo "</pre>";*/

        $href = "product.php?id_product=" . $row['id_product'];
		echo "<a class='a_content_diapo' href=$href>";
			echo "<div class='product'>";
				echo "<div class='div_img_product'>";
				$sql = "SELECT * FROM image WHERE id_product = ? ORDER BY id_product LIMIT 1";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$row['id_product']]);
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $path_img = '../../img_store/' . $res[0]["path"];
					echo "<img class='img_product_diapo' src=$path_img>";
				echo "</div>";
                echo "<div class='info_product'>";
                    echo "<p class='product_title'>Robe beige</p>";
                    echo "<p class='product_price'>150 €</p>";
                echo "</div>";
            echo "</div>";
        echo "</a>";
	}

	echo "</div>";

	echo "<div class='div_fleche fleche_droite'>";
		echo "<img src='../../img/fleche-droite.png' alt='Fleche droite'>";
	echo "</div>";

	echo "<span class='indice_clic' style='display: none'>0</span>";

	echo "</div>";
	echo "</section>";

}

