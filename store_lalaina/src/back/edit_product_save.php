<?php

function get_img_upload() {

    $array_img_upload = array();

    foreach (array_keys($_FILES) as $img) {
        if (empty($_FILES[$img]["name"])) {
            break;
        } else {
            $array_img_upload[] = $img;
        }
    }

    return $array_img_upload;

}


function get_size() {

    $array_size = array();

    foreach ($_POST as $key => $value) {


        if (str_starts_with($key, 'size_')) {

            $array_size[] = str_replace('size_', '', $key);

        }

    }

    return $array_size;

}

function remove_imgs_uploaded() {

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=store_lalaina', "root", "@BDJMTC10+");
        //var_dump($dbh);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    $sql = "SELECT path FROM product, image WHERE product.id_product=image.id_product AND image.id_product = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$_POST['input_id_product']]);

    $array_img = array();
    foreach ($stmt as $path) {
        $array_img[] = $path['path'];
    }

    echo "<pre>";
    var_dump($array_img);
    echo "</pre>";

    $array_img_remove = array();
    foreach ($_POST as $key => $value) {
        if (str_starts_with($key, 'input_img_')) {
            $array_img_remove[] = $value;
        }
    }
    echo "<pre>";
    var_dump($array_img_remove);
    echo "</pre>";

    foreach ($array_img as $img) {
        if (!in_array($img, $array_img_remove)){
            $sql = "DELETE FROM image WHERE path = ?";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$img]);
        }
    }

}

$trns = array(
 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a',
 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A',
 'ß'=>'B', 'ç'=>'c', 'Ç'=>'C',
 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e',
 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E',
 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I',
 'ñ'=>'n', 'Ñ'=>'N',
 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o',
 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O',
 'š'=>'s', 'Š'=>'S',
 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'u',
 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U',
 'ý'=>'y', 'Ý'=>'Y', 'ž'=>'z', 'Ž'=>'Z'
 );


if (isset($_POST['input_submit']) && $_POST['input_submit'] == "Sauvegarder") {


    ////////    VERIFICATION DES VALEURS ENTREES    ////////

    if (empty($_POST['input_title'])) {
        setcookie("error_title", "Veuillez indiquez un titre à votre produit", time() + 60 * 60);
        header("Location: add_product.php");
        exit;
    }
    if (empty($_POST['input_price'])) {
        setcookie("error_price", "Veuillez indiquez un prix à votre produit", time() + 60 * 60);
        header("Location: add_product.php");
        exit;
    }

    //print_r($_POST);

    $verif_size = false;
    if (isset($_POST['size_S'])) {
        $verif_size = true;
    }
    if (isset($_POST['size_M'])) {
        $verif_size = true;
    }
    if (isset($_POST['size_L'])) {
        $verif_size = true;
    }
    if ($verif_size == false) {
        $location = "edit_product.php?id_product=" . $_POST['input_id_product'];
        header("Location: " . $location);
        exit;
    }

    # print_r(get_img_upload());

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    foreach (get_img_upload() as $img) {
        echo "<p>" . $_FILES[$img]["name"] . "</p>";
        $name_file = str_replace(" ", "_", $_FILES[$img]['name']);
        $name_file = str_replace("-", "_", $name_file);
        $name_file = strtr($name_file, $trns);
        if (isset($_FILES[$img]) && is_uploaded_file($_FILES[$img]['tmp_name'])) {
            $origine = $_FILES[$img]['tmp_name'];
            $destination = '../../img_store/' . $name_file;
            move_uploaded_file($origine, $destination);
        }
    }

    /////////////////////////////////////////////////////////


    ////////    CONNEXION BASE DE DONNES    ////////

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=store_lalaina', "root", "@BDJMTC10+");
        //var_dump($dbh);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    /////////////////////////////////////////////////////////


    ////////    INSERTION BASE DE DONNEES    ////////

    remove_imgs_uploaded();

    $sql = "UPDATE product SET title = ?, type = ?, sex = ?, price = ? WHERE id_product = ?";
    $stmt = $dbh->prepare($sql);
    $res = $stmt->execute([$_POST['input_title'], $_POST['input_type'], $_POST['input_sex'], $_POST['input_price'], $_POST['input_id_product']]);

    $sql = "INSERT INTO image (path, id_product) VALUES (?, ?)";
    $stmt = $dbh->prepare($sql);

    foreach (get_img_upload() as $img) {
        $name_file = str_replace(" ", "_", $_FILES[$img]['name']);
        $name_file = str_replace("-", "_", $name_file);
        $name_file = strtr($name_file, $trns);
        $res = $stmt->execute([$name_file, $_POST['input_id_product']]);
    }


    $sql = "DELETE FROM size WHERE id_product = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$_POST['input_id_product']]);

    $sql = "INSERT INTO size (size, id_product) VALUES (?, ?)";
    $stmt = $dbh->prepare($sql);

    foreach (get_size() as $size) {
        echo $size;
        $stmt->execute([$size, $_POST['input_id_product']]);
    }

    $dbh = null;
    $stmt = null;

    setcookie("validate_update", "Produit modifié", time() + 60 * 60);

    header("Location: logistic.php");
    exit();


}