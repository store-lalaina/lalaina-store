<?php

$past = time() - 3600;
foreach ( $_COOKIE as $key => $value )
{
    setcookie( $key, $value, $past, '/' );
}

function get_id_news($news_product) {

	$id_news = array();

	foreach ($news_product as $data) {

		$id_news[] = $data['id_product'];

	}

	return $id_news;

}

?>

<!doctype html>

<html lang="fr">

	<head>
		<meta charset="utf-8">
		<title>Lalaina Creation</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../header.css">
        <link rel="stylesheet" href="logistic.css">
		<link rel="stylesheet" href="../footer.css">
	</head>

	<body>

		<?php
        //include '../header.php';
        ?>

		<main>

			<form action="save_table.php" method="post" id="form_apercu">

				<?php
                if (isset($_COOKIE['validate_save'])) {
                    echo "<span class='span_validate'>" . $_COOKIE['validate_save'] . "</span>";
                }
				if (isset($_COOKIE['validate_update'])) {
                    echo "<span class='span_validate'>" . $_COOKIE['validate_update'] . "</span>";
                }
                ?>

				<table id="table_apercu">

	                <thead>

	                    <tr>

	                        <?php

	                        try {
	                            $dbh = new PDO('mysql:host=localhost;dbname=store_lalaina', "root", "@BDJMTC10+");
	                            //var_dump($dbh);
	                        } catch (PDOException $e) {
	                            print "Erreur !: " . $e->getMessage() . "<br/>";
	                            die();
	                        }

	                        $sql = "SELECT column_name FROM information_schema.columns WHERE table_name = 'product' ";
	                        $stmt = $dbh->query($sql);

							$columns_name = $stmt->fetchAll(PDO::FETCH_ASSOC);

							/*echo "<pre>";
							print_r($columns_name);
							echo "</pre>";*/

							foreach ($columns_name as $name) {
								echo "<th>" . $name['column_name'] . "</th>";
							}

							echo "<th>Size avalaible</th>";

							echo "<th>Nouveautés</th>";

	                        ?>

	                    </tr>

	                </thead>

					<tbody>

						<?php

						$sql = "SELECT * FROM product";
					    $stmt = $dbh->query($sql);
						$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

						$sql = "SELECT * FROM nouveautes";
						$stmt = $dbh->query($sql);
						$news_product = $stmt->fetchAll(PDO::FETCH_ASSOC);

						/*echo "<pre>";
						print_r($news_product);
						echo "</pre>";*/

						foreach ($rows as $row) {

							echo "<tr>";
							echo "<a>";

							/*echo "<pre>";
							print_r($row);
							echo "</pre>";*/

							/*foreach ($row as $data) {

								echo "<td>" . $data . "</td>";

							}*/

							$a_path = "edit_product.php?id_product=" . $row['id_product'];
							echo "<td><a href=$a_path>" . $row['id_product'] . "</a></td>";
							echo "<td>" . $row['title'] . "</td>";
							echo "<td>" . $row['type'] . "</td>";
							echo "<td>" . $row['sex'] . "</td>";
							echo "<td>" . $row['price'] . "</td>";


							$sql = "SELECT size FROM product, size WHERE product.id_product=size.id_product AND size.id_product = ?";
						    $stmt = $dbh->prepare($sql);
						    $stmt->execute([$row['id_product']]);
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

							$content_td = "";
							foreach ($res as $size) {
								$content_td .= $size['size'] . ", ";
							}
							echo "<td>$content_td</td>";


							$name_input = 'input_checkbox_' . $row['id_product'];

							if (in_array($row['id_product'], get_id_news($news_product))) {
								echo "<td><input name='$name_input' type='checkbox' checked></td>";
                            } else {
								echo "<td><input name='$name_input' type='checkbox'></td>";
							}

							echo "</a>";
							echo "</tr>";

						}

						?>

					</tbody>

	            </table>

				<input id="input_submit" name="input_submit" type="submit" value="Sauvegarder">

			</form>

		</main>

		<?php
        //include '../footer.php';
        ?>

	</body>

</html>