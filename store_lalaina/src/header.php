<header id="header">

    <nav class="navbar_hide" id="navbar">
        <div id="div_close">
            <img id="img_close" src="../../img/signe-de-la-croix.png" alt="Close">
        </div>
        <ul id="ul_navbar">
            <li class="nav_item nav_item_logo"><a href="">
                    <img class="img_fonction" src="../../img/logo_2.png" alt="Logo Lalaina Creation">
                </a></li>
            <hr>
            <li class="nav_item"><a href="">Nouveautés</a></li>
            <li class="nav_item"><a href="">Femme</a></li>
            <li class="nav_item"><a href="">Homme</a></li>
            <li class="nav_item"><a href="">Enfants</a></li>
            <hr>
            <li class="nav_item nav_item_fonc"><a href="connexion.html">
                    <img class="img_fonction" src="../../img/compte.png" alt="Compte">
                </a></li>
            <li class="nav_item nav_item_fonc"><a href="panier.php">
                    <img class="img_fonction" src="../../img/paniers.png" alt="Panier">
                    <?php
                    if (isset($_SESSION['basket'])) {
                        echo "<span id='count_basket_sidebar'>" . count($_SESSION['basket']) . "</span>";
                    }
                    ?>
                </a></li>
        </ul>
    </nav>

    <div id="header_left">

        <div id="div_logo">
            <a id="a_home" href="index.php">
                <img id="header_img_logo" src="../../img/logo_2.png" alt="Logo Lalaina Creation">
            </a>
        </div>

    </div>

    <div id="header_right">

        <div id="div_menu">
            <nav id="nav_menu">
                <a class="menu_a" href="product_femmes.php">Femmes</a>
                <a class="menu_a" href="#">Hommes</a>
                <a class="menu_a" href="#">Enfants</a>
            </nav>
        </div>

        <div id="div_fonction">
            <a class="a_fonction" href="connexion.html">
                <img class="img_fonction" src="../../img/compte.png" alt="Compte">
            </a>
            <a class="a_fonction" id="a_basket" href="panier.php">
                <img class="img_fonction" src="../../img/paniers.png" alt="Panier">
                <?php
                if (isset($_SESSION['basket'])) {
                    echo "<span id='count_basket'>" . count($_SESSION['basket']) . "</span>";
                }
                ?>
            </a>
            <a class="a_fonction" id="a_sidebar">
                <img class="img_fonction" src='../../img/menu.png' alt="Menu">
            </a>
        </div>

    </div>

</header>