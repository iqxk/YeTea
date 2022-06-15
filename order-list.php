<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YeTea.pl</title>
    <link rel="stylesheet" type="text/css" href="style/index-style.css">
    <link rel="stylesheet" type="text/css" href="style/mobile-index-style.css">
    <link rel="stylesheet" type="text/css" href="style/order-list-style.css">
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
        <a class="btn" href="faq.php">FAQ</a>
        <a class="btn" href="contact.php">Kontakt</a>
    </div>
</div>

<!-- ORDER LIST -->
<div class="order-list col-12">
    <?php
    if($isAdmin)
        echo "<div class='order-list-header'>Panel administratora</div>\n";
    else
        echo "<div class='order-list-header'>Zamówienia użytkownika <b>{$username}</b></div>\n";

    echo "<table>\n";
    echo "\t<tr>\n";
    if($isAdmin) echo "\t\t<th>Użytkownik</th>\n";
    echo "\t\t<th>ID zamówienia</th>\n";
    echo "\t\t<th>Status zamówienia</th>\n";
    echo "\t</tr>\n";

    if($isAdmin)
    {
        $sql = "SELECT o.id, o.order_id, u.login, o.status_id, s.name
            FROM orders o
            JOIN status s ON s.id = o.status_id
            JOIN users u  ON u.id = o.user_id";
    }
    else
    {
        $sql = "SELECT o.id, o.order_id, o.status_id, s.name
            FROM orders o
            JOIN status s ON s.id = o.status_id
            WHERE user_id = {$_SESSION['user-id']}";
    }
    $result = $conn->query($sql);
    if (!$result) trigger_error('Invalid query: ' . $conn->error);

    //echo "user_id: {$_SESSION['user-id']} | sql: {$sql}\n";

    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $orderId = $row['order_id'];
            $statusId = $row['status_id'];
            $statusName = $row['name'];
            if($isAdmin) $login = $row['login'];

            echo "\t<tr>\n";
            if($isAdmin) echo "\t\t<td>{$login}</td>\n";
            echo "\t\t<td><a href='order.php?id={$orderId}'>{$orderId}</a></td>\n";
            if($isAdmin)
            {
                echo "\t\t<td>\n";
                echo "\t\t<form action='php_scripts/change_status.php?order_id={$orderId}' method='POST'>\n";
                echo "\t\t\t<select name='status'>\n";
                if($statusId == 1) echo "\t\t\t\t<option value='1' selected>Oczekiwanie na wpłatę</option>\n";
                else echo "\t\t\t\t<option value='1'>Oczekiwanie na wpłatę</option>\n";
                if($statusId == 2) echo "\t\t\t\t<option value='2' selected>Wpłacono</option>\n";
                else echo "\t\t\t\t<option value='2'>Wpłacono</option>\n";
                if($statusId == 3) echo "\t\t\t\t<option value='3' selected>Anulowano</option>\n";
                else echo "\t\t\t\t<option value='3'>Anulowano</option>\n";
                echo "\t\t\t</select>\n";
                echo "\t\t\t<button type='submit' >Zatwierdź zmiany</button>\n";
                echo "\t\t</form>\n";
            }
            else
                echo "\t\t<td>{$statusName}</td>\n";
            echo "\t</tr>\n";
        }
    }
    else
    {
        echo "<tr>\n";
        echo "\t<td id='list-empty' colspan='3'>Brak zamówień</td>\n";
        echo "</tr>\n";
    }
    echo "</table>\n";
    ?>
</div>

<!-- FOOTER -->
<div class="footer col-12">© 2020 - Igor Kucyk</div>
</body>
<script type="text/javascript" src="js_scripts/mobile-script.js"></script>

</html>
