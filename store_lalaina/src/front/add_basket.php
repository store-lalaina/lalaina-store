<?php

session_start();


if (isset($_SESSION['basket'])) {
    $basket = $_SESSION['basket'];
    $basket[$_POST['input_id_product']] = $_POST['qte'];
    $_SESSION['basket'] = $basket;
} else {
    $basket[$_POST['input_id_product']] = $_POST['qte'];
    $_SESSION['basket'] = $basket;
}


echo "<pre>";
print_r($_SESSION);
echo "</pre>";

$location = "Location: product.php?id_product=" . $_POST['input_id_product'];
header($location);