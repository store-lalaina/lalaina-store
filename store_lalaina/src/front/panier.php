<?php
session_start();

function generate_select_qte($qte, $number) {

    $name = 'input_qte_' . $number;
    $id = 'input_qte_' . $number;
    echo "<label class='label_input_qte' for=$id>Quantité</label>";
    echo "<select id=$id name=$name class='input_qte'>";
    for ($i = 1; $i < 11; $i++) {
        if ($i == $qte) {
            echo "<option value=$i selected>$i</option>";
        } else {
            echo "<option value=$i>$i</option>";
        }
    }
    echo "</select>";

}

if (isset($_COOKIE['id_product']) && isset($_COOKIE['qte_change'])) {
    $_SESSION['basket'][$_COOKIE['id_product']] = $_COOKIE['qte_change'];
    $past = time() - 3600;
    setcookie('id_product', '', $past);
    setcookie('qte_change', '', $past);
}

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Lalaina Creation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../header.css">
        <link rel="stylesheet" href="panier.css">
        <link rel="stylesheet" href="../footer.css">

        <script src="navbar.js"></script>

        <!--<script src="change_qte_basket.js"></script>-->

        <script type="text/javascript">

            window.addEventListener('load',() => {

                var change_qte_basket = function () {

                    var id_product = this.getAttribute('name').replace('input_qte_', '');
                    var qte = this.value;

                    console.log(this);
                    console.log(this.value);

                    document.cookie = 'id_product = ' + id_product;
                    document.cookie = 'qte_change = ' + qte;

                    location.reload();

                }

                let selects = document.getElementsByClassName("input_qte");
                for (let i = 0; i < selects.length; i++) {
                    selects[i].addEventListener('change', change_qte_basket);
                }

            });

        </script>


    </head>

    <body>

    <?php
    include '../header.php';
    ?>

    <main>

        <?php

        if (!isset($_SESSION['basket'])) {
            echo "<section id='section_basket_empty'>";
            echo "<h1>Le panier est vide</h1>";
            echo "<a href='index.php' id='a_back_home'>Continuer vos achats</a>";
            echo "</section>";
        } else {

            try {
                $dbh = new PDO('mysql:host=localhost;dbname=store_lalaina', "root", "@BDJMTC10+");
                //var_dump($dbh);
            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }

            $sql = "SELECT * FROM product, image WHERE product.id_product=image.id_product AND image.id_product = ? ORDER BY image.id LIMIT 1";
            $stmt = $dbh->prepare($sql);

			echo "<section id='section_basket_full'>";

            echo "<div id='div_products'>";

            foreach ($_SESSION['basket'] as $id_product => $qte) {

                $stmt->execute([$id_product]);
				$res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];


                echo "<div class='div_product_basket'>";
                echo "<div class='div_img_product_basket'>";
                $path = '../../img_store/' . $res['path'];
                echo "<img class='img_product_basket' src=$path alt='" . 'img_' . $res['title'] . "'>";
                echo "</div>";
                echo "<div class='div_info_product_basket'>";
                echo "<h2>" . $res['title'] . "</h2>";
                echo "<h3>" . $res['price'] . ".00€</h3>";
                generate_select_qte($qte, $id_product);
                echo "</div>";
                echo "<div class='div_remove_product_basket'>";
                echo "<form action='remove_product_basket.php' method='post'>";
                echo "<input id='remove_product' name='remove_product' type='submit' value='X'>";
                echo "<input name='id_product_remove' type='hidden' value=$id_product>";
                echo "</form>";
                echo "</div>";
                echo "</div>";

            }

            echo "</div>";

            ?>

            <div id="div_bill">
                <h1>Mon panier</h1>

                <?php

                $total = 0;

                foreach ($_SESSION['basket'] as $id_product => $qte) {

                    $stmt->execute([$id_product]);
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

                    $total = $total + (int)$res['price'] * (int)$qte;

                    echo "<div class='div_basket_product'>";
                    echo "<h2>" . $res['title'] . " x " . $qte . "</h2>";
                    echo "<h3>" . (int)$res['price'] * (int)$qte . ".00€</h3>";
                    echo "<hr>";
                    echo "</div>";

                }

                ?>

                <h2>Total : <?=$total?>.00€</h2>

                <form action="validate_basket" method="post">
                    <input type="hidden" value=<?=$total?>>
                    <input id="submit_commande" name="submit_commande" type="submit" value="Validez la commande">
                </form>

            </div>

			<?php echo "</section>";}?>



    </main>

    <?php
    include '../footer.php';
    ?>

    </body>

</html>