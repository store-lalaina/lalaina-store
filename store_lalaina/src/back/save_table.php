<?php

function get_id_product_new() {

    $array_id = array();

    foreach ($_POST as $key => $value) {


        if (str_starts_with($key, 'input_checkbox_')) {

            $array_id[] = str_replace('input_checkbox_', '', $key);

        }

    }

    echo "<pre>";
    print_r($array_id);
    echo "</pre>";

    return $array_id;

}

if (isset($_POST['input_submit']) && $_POST['input_submit'] == "Sauvegarder") {

    get_id_product_new();

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=store_lalaina', "root", "@BDJMTC10+");
        //var_dump($dbh);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    $sql = "TRUNCATE TABLE nouveautes";
    $stmt = $dbh->query($sql);

    $sql = "INSERT INTO nouveautes (id_product) VALUES (?)";
    $stmt = $dbh->prepare($sql);

    foreach (get_id_product_new() as $id_product) {
        $res = $stmt->execute([$id_product]);
    }

    setcookie("validate_save", "Sauvegarde effectuée", time() + 60 * 60);

    header("Location: logistic.php");
    exit();


} else {

    header("Location: logistic.php");
    exit();

}