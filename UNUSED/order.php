<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YeTea.pl</title>
    <link rel="stylesheet" type="text/css" href="../style/index-style.css">
    <link rel="stylesheet" type="text/css" href="../style/mobile-index-style.css">
    <link rel="stylesheet" type="text/css" href="../style/order-info-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php
    session_start();
    include "php_scripts/db_connection.php";
    include "php_scripts/product/load_product.php";
    $conn = openCon();
    ?>
</head>
<body>
<!-- MOBILE -->
<div id="mobile">
    <!-- MOBILE SIDENAV -->
    <div id="mobile-sidenav">
        <a href="javascript:void(0)" id="close-btn" onclick="closeSideNav()">&times;</a>
        <a href="../index.php">Herbata</a>
        <a href="#">Kreator herbaty</a>
        <a href="#">Prezenty</a>
        <a href="#">FAQ</a>
        <a href="#">Kontakt</a>
    </div>
    <!-- MOBILE TOP NAV -->
    <div id="mobile-top-nav">
        <a id="open-sidenav" class="material-icons" onclick="openSideNav()">menu</a> <!-- OPEN SIDENAV -->
        <img class="mobile-logo" src="../images/logo.png">                              <!-- MOBILE LOGO -->
        <!-- MOBILE USER PANEL -->
        <div id="user-panel-dropdown" class="dropdown">
            <a onclick="toggleUserPanel()" class="dropdown-btn material-icons">person</a>
            <div id="userPanelDropdown" class="dropdown-content">
                <a href="#">Logowanie</a>
                <a href="#">Rejestracja</a>
            </div>
        </div>
        <!-- MOBILE CART -->
        <div id="cart-dropdown" class="dropdown">
            <a onclick="toggleCart()" class="dropdown-btn material-icons">shopping_cart</a>
            <div id="cartDropdown" class="dropdown-content">
                <a id="cart" href="../cart.php">
                    <img class="cart-icon" src="../images/cart.png">
                    <p class="items-cost"><?php echo $_SESSION['total_price'] ?> zł <span class="items-amount">(<?php echo $_SESSION['items_amount'] ?> produktów)</span></p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- PC -->
<div id="PC">
    <div class="logo col-6"><img src="../images/logo.png"></div> <!-- LOGO -->
    <div class="func col-6">
        <!-- USER PANEL -->
        <div class="user-panel">
            <div class="sign-btn" id="login">Logowanie</div>
            <div class="sign-btn" id="register">Rejestracja</div>
        </div>
        <!-- CART -->
        <a class="cart" href="../cart.php">
            <img src="../images/cart.png" class="cart-icon">
            <p class="items-cost"><?php echo $_SESSION['total_price'] ?> zł <span class="items-amount">(<?php echo $_SESSION['items_amount'] ?> produktów)</span></p>
        </a>
    </div>
    <!-- PC NAV -->
    <div class="nav col-12">
        <a class="btn" href="../index.php">Herbata</a>
        <a class="btn">Kreator herbaty</a>
        <a class="btn">Prezenty</a>
        <a class="btn">FAQ</a>
        <a class="btn">Kontakt</a>
    </div>
</div>

<div class="order-panel col-12">
    <div class="order-info">
        <div class="supplier-select">
            <label for="suppliers">Wybierz dostawcę:</label>
            <select id="suppliers" name="suppliers">
            <?php
            $sql = "SELECT * FROM supplier";
            $result = $conn->query($sql);
            if (!$result) trigger_error('Invalid query: ' . $conn->error);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $id = $row['id'];
                    $name = $row['name'];
                    $price = $row['price'];
                    echo "\t<option value='{$id}'>{$name} --- {$price} zł</option>\n";
                }
            }
            ?>
            </select>
        </div>
        <div class="name-lastname">
            <input type="text" name="name"     placeholder="Imię">
            <input type="text" name="lastname" placeholder="Nazwisko">
        </div>
        <div class="address">
            <input id="address" type="text" name="address" placeholder="Adres rozliczeniowy">
        </div>
        <div class="city-postcode">
            <input id="city"           type="text"   name="city"           placeholder="Miasto">
            <div class="postcode">
                <input id="postcode-left"  type="number" name="postcode-left"  placeholder="XX"  min="0" max="99">
                <span>-</span>
                <input id="postcode-right" type="number" name="postcode-right" placeholder="YYY" min="0" max="999">
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<div class="footer col-12">© 2020 - Igor Kucyk</div>
</body>
<script type="text/javascript" src="../js_scripts/mobile-script.js"></script>
</html>