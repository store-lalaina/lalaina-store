<?php
$past = time() - 3600;
foreach ( $_COOKIE as $key => $value )
{
    setcookie( $key, $value, $past);
}
?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Ajouter un produit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../header.css">
        <link rel="stylesheet" href="add_product.css">
        <link rel="stylesheet" href="../footer.css">

        <script src="add_img.js"></script>

    </head>

    <body>

        <?php
        include '../header.php';
        ?>

        <main>

            <form id="form_add_product" action="add_product_action.php" method="post" enctype="multipart/form-data">
	            <?php
	            if (isset($_COOKIE['validate_add'])) {
                    echo "<span class='span_validate'>" . $_COOKIE['validate_add'] . "</span>";
                }
                ?>
                <label for="input_title">Intitulé du produit</label>
                <input id="input_title" name="input_title" type="text">
                <?php
                if (isset($_COOKIE['error_title'])) {
                    echo "<span class='span_error'>" . $_COOKIE['error_title'] . "</span>";
                }
                ?>
                <label for="input_type">Type</label>
                <select name="input_type" id="input_type">
                    <option value="Vetement">Vêtement</option>
                    <option value="Epice">Epice</option>
                </select>
                <label for="input_sex">Sexe</label>
                <select name="input_sex" id="input_sex">
                    <option value="Femme">Femme</option>
                    <option value="Homme">Homme</option>
                    <option value="Enfant">Enfant</option>
                </select>
                <label for="input_price">Prix</label>
                <input id="input_price" name="input_price" type="number">
	            <?php
                if (isset($_COOKIE['error_price'])) {
                    echo "<span class='span_error'>" . $_COOKIE['error_price'] . "</span>";
                }
                ?>
                <label for="field_size">Taille disponible</label>
                <fieldset id="field_size">
                    <label for="size_S">S</label>
                    <input id="size_S" name="size_S" type="checkbox">
                    <label for="size_M">M</label>
                    <input id="size_M" name="size_M" type="checkbox">
                    <label for="size_L">L</label>
                    <input id="size_L" name="size_L" type="checkbox">
                </fieldset>
	            <?php
                if (isset($_COOKIE['error_size'])) {
                    echo "<span class='span_error'>" . $_COOKIE['error_size'] . "</span>";
                }
                ?>
                <label for="input_img1">Ajouter des images</label>
                <input id="input_img1" name="input_img1" accept=".jpg, .jpeg, .png" type="file">
                <p id="button_add_img">+</p>
                <input id="input_submit" name="input_submit" type="submit" value="Ajouter le produit" required>
            </form>

        </main>

        <?php
        include '../footer.php';
        ?>

    </body>

</html>
