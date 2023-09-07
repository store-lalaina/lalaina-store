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

if (isset($_POST['input_submit']) && $_POST['input_submit'] == 'Ajouter le produit') {


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
    if (isset($_POST['size_s'])) {
        $verif_size = true;
    }
    if (isset($_POST['size_m'])) {
        $verif_size = true;
    }
    if (isset($_POST['size_l'])) {
        $verif_size = true;
    }
    if ($verif_size == false) {
        setcookie("error_size", "Veuillez indiquez au moins une taille", time() + 60 * 60);
        header("Location: add_product.php");
        exit;
    }

    # print_r(get_img_upload());

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";


    /*if (isset($_FILES)) {
        foreach (get_img_upload() as $key) {
            echo "<p>" . $key . "</p>";
            $name = $_FILES[$key]['name'];
            echo "<p>" . $name . "</p>";
            //echo $_FILES[$img]['name'];
        }
    }*/

    foreach (get_img_upload() as $img) {
        echo "<p>" . $_FILES[$img]["name"] . "</p>";
        //echo "<p>" . str_replace("-", "_", $_FILES[$img]['name']) . "</p>";
        $name_file = str_replace(" ", "_", $_FILES[$img]['name']);
        echo "<p>" . $name_file . "</p>";
        $name_file = str_replace("-", "_", $name_file);
        echo "<p>" . $name_file . "</p>";
        $name_file = strtr($name_file, $trns);
        echo "<p>" . $name_file . "</p>";
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

    $sql = "INSERT INTO product (title, type, sex, price) VALUES (? ,?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $res = $stmt->execute([$_POST['input_title'], $_POST['input_type'], $_POST['input_sex'], $_POST['input_price']]);
    //var_dump($res);

    $last_id = $dbh->lastInsertId();

    $sql = "INSERT INTO image (path, id_product) VALUES (?, ?)";
    $stmt = $dbh->prepare($sql);

    foreach (get_img_upload() as $img) {
        $name_file = str_replace(" ", "_", $_FILES[$img]['name']);
        $name_file = str_replace("-", "_", $name_file);
        $name_file = strtr($name_file, $trns);
        $res = $stmt->execute([$name_file, $last_id]);
    }


    $sql = "INSERT INTO size (size, id_product) VALUES (?, ?)";
    $stmt = $dbh->prepare($sql);

    foreach (get_size() as $size) {
        echo $size;
        $stmt->execute([$size, $last_id]);
    }


    $dbh = null;
    $stmt = null;

    setcookie("validate_add", "Produit ajouté", time() + 60 * 60);

    header("Location: add_product.php");
    exit();

} else {

    header("Location: add_product.php");
    exit();

}