<?php
session_start();

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

if (isset($_POST['id_product_remove'])) {

    echo $_POST['id_product_remove'];

    if (isset($_SESSION['basket'])) {
        $basket = $_SESSION['basket'];
        //$basket[$_POST['id_product_remove']] = $_POST['id_product_remove'];
        unset($basket[$_POST['id_product_remove']]);
        $_SESSION['basket'] = $basket;
    }

    if (empty($_SESSION['basket'])) {
        unset($_SESSION['basket']);
    }

    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";

    header("Location: panier.php");


} else {

    header("Location: panier.php");

}