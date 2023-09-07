<?php


function generate_section_all_products($title, $sql): void
{

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=store_lalaina', "root", "@BDJMTC10+");
        //var_dump($dbh);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    echo "<section class='section_all_products'>";
    echo "<div class='section_title'>";
    echo "<h2>$title</h2>";
    echo "</div>";
    echo "<div class='content_all_section'>";

    $stmt = $dbh->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {

        echo "<a href='product.php?id_product=" . $row['id_product'] . "'>";
        echo "<div class='product'>";
        echo "<div class='div_img_product'>";
        $sql = "SELECT * FROM image WHERE id_product = ? ORDER BY id_product LIMIT 1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$row['id_product']]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $path_img = '../../img_store/' . $res[0]["path"];
        echo "<img class='img_product' src=$path_img alt='" . 'img_' . $row['title'] . "'>";
        echo "</div>";
        echo "<div class='info_product'>";
        echo "<p class='product_title'>" . $row['title'] . "</p>";
        echo "<p class='product_price'>" . $row['price'] . " €</p>";
        echo "</div>";
        echo "</div>";
        echo "</a>";


    }

    echo "</div>";
    echo "</section>";

}