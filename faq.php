<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YeTea.pl</title>
    <link rel="stylesheet" type="text/css" href="style/index-style.css">
    <link rel="stylesheet" type="text/css" href="style/mobile-index-style.css">
    <link rel="stylesheet" type="text/css" href="style/faq-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php
    session_start();

    if(!isset($_SESSION['items_amount'])) $_SESSION['items_amount'] = 0;
    if(!isset($_SESSION['total_price'])) $_SESSION['total_price'] = 0;
    if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    include "php_scripts/db_connection.php";
    $conn = openCon();

    if(isset($_SESSION['user-id']) && $_SESSION['user-id'] != 0)
    {
        $sql = "SELECT login, is_admin FROM users WHERE id = {$_SESSION['user-id']}";
        $result = $conn->query($sql);
        if (!$result) trigger_error('Invalid query: ' . $conn->error);
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $username = $row['login'];
            $isAdmin = $row['is_admin'] == 0 ? false : true;
        }
    }
    if(!isset($_SESSION['user-id'])) $_SESSION['user-id'] = 0;
    ?>
    <script>
        $(document).ready(function()
        {
            $('.answer').hide();
            $('.question').click(function()
            {
                $(this).toggleClass('active');
                //$(this).next().toggleClass('show');
                $(this).next().slideToggle();
            });
        });
    </script>
</head>
<body>
<!-- MOBILE -->
<div id="mobile">
    <!-- MOBILE SIDENAV -->
    <div id="mobile-sidenav">
        <a href="javascript:void(0)" id="close-btn" onclick="closeSideNav()">&times;</a>
        <a href="index.php">Herbata</a>
        <a href="faq.php">FAQ</a>
        <a href="contact.php">Kontakt</a>
    </div>
    <!-- MOBILE TOP NAV -->
    <div id="mobile-top-nav">
        <a id="open-sidenav" class="material-icons" onclick="openSideNav()">menu</a> <!-- OPEN SIDENAV -->
        <img class="mobile-logo" src="images/logo.png">                              <!-- MOBILE LOGO -->
        <!-- MOBILE USER PANEL -->
        <div id="user-panel-dropdown" class="dropdown">
            <a onclick="toggleUserPanel()" class="dropdown-btn material-icons">person</a>
            <div id="userPanelDropdown" class="dropdown-content">
                <?php
                if($_SESSION['user-id'] == 0)
                {
                    echo "<a id='login'    href='log_in.php'>Logowanie</a>";
                    echo "<a id='register' href='register.php'>Rejestracja</a>";
                }
                else
                {
                    echo "<a id='login'   href='order-list.php'>Witaj, <b>{$username}</b>!</a>\n";
                    echo "<a id='register' href='php_scripts/user/log_out.php'>Wyloguj</a>\n";
                }
                ?>
                <a id="login" href="login.php">Logowanie</a>
                <a id="register" href="register.php">Rejestracja</a>
            </div>
        </div>
        <!-- MOBILE CART -->
        <div id="cart-dropdown" class="dropdown">
            <a onclick="toggleCart()" class="dropdown-btn material-icons">shopping_cart</a>
            <div id="cartDropdown" class="dropdown-content">
                <a id="cart" href="cart.php">
                    <img class="cart-icon" src="images/cart.png">
                    <p class="items-cost"><?php echo $_SESSION['total_price'] ?> zł <span class="items-amount">(<?php echo $_SESSION['items_amount'] ?> produktów)</span></p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- PC -->
<div id="PC">
    <div class="logo col-6"><img src="images/logo.png"></div> <!-- LOGO -->
    <div class="func col-6">
        <!-- USER PANEL -->
        <div class="user-panel">
            <?php
            if($_SESSION['user-id'] == 0)
            {
                echo "<a class='sign-btn' href='login.php'>Logowanie</a>";
                echo "<a class='sign-btn' href='register.php'>Rejestracja</a>";
            }
            else
            {
                echo "<a class='sign-btn' href='order-list.php'>Witaj, <b>{$username}</b>!</a>\n";
                echo "<a class='sign-btn' href='php_scripts/user/log_out.php'>Wyloguj</a>\n";
            }
            ?>
        </div>
        <!-- CART -->
        <a class="cart" href="cart.php">
            <img src="images/cart.png" class="cart-icon">
            <p class="items-cost"><?php echo $_SESSION['total_price'] ?> zł <span class="items-amount">(<?php echo $_SESSION['items_amount'] ?> produktów)</span></p>
        </a>
    </div>
    <!-- PC NAV -->
    <div class="nav col-12">
        <a class="btn" href="index.php">Herbata</a>
        <a class="btn active" href="faq.php">FAQ</a>
        <a class="btn" href="contact.php">Kontakt</a>
    </div>
</div>

<!-- FAQ -->
<div class="faq col-12">
    <div class="faq-title"><span>FAQ</span></div>
    <div class="question" value="1">Kim jesteśmy?</div>
    <div class="answer"   id="1">
        Jesteśmy parą zafiksowaną na punkcie herbaty.
        Firma YETEA jest spełnieniem naszych marzeń.
        Kto by nie chciał zarabiać na czymś, co kocha?
    </div>
    <div class="question" value="2">Historia firmy</div>
    <div class="answer"   id="2">
        YETEA powstała w roku 2016 dzięki dofinansowaniom ze środków funduszy europejskich.
        Zaczynaliśmy jako sprzedawca na allegro.
        W roku 2019 założyliśmy stronę internetową YeTea.pl.
        Zostaliśmy nagrodzeni Gepardem Biznesu 2019.
    </div>
    <div class="question" value="3">Sposoby dostawy, jej koszta i czas oczekiwania</div>
    <div class="answer"   id="3">
        Nasze produkty starannie pakujemy i wysyłamy na dwa sposoby: paczką lub kurierem.
        <ul>
            <li>kurier OutGet: czas oczekiwania – 24-48h, cena: 14 zł</li>
            <li>kurier Pocztex: czas oczekiwania – 48-72h,  cena: 12 zł</li>
            <li>przesyłka priorytetowa: czas oczekiwania – do 6 dni roboczych, cena: 8 zł</li>
            <li>przesyłka ekonomiczna: czas oczekiwania – do 10 dni roboczych, cena: 6 zł</li>
        </ul>
    </div>
    <div class="question" value="4">Reklamacje i zwroty </div>
    <div class="answer"   id="4">
        Zwrot NIEUŻYWANYCH produktów dokonujemy na adres ul. Krzesełkowa 997, 00-112 Kurkowo.
        W sprawie reklamacji prosimy o kontakt na adres e-mail reklamacje@yetea.pl.
    </div>
    <div class="question" value="5">Nasi dostawcy </div>
    <div class="answer"   id="5">
        Produkty dostępne w ofercie pozyskujemy od renomowanych technologów,
        którzy każdą recepturę wykonują z największą starannością.
    </div>
</div>

<!-- FOOTER -->
<div class="footer col-12">© 2020 - Igor Kucyk</div>
</body>
<script type="text/javascript" src="js_scripts/mobile-script.js"></script>

</html>