<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YeTea.pl</title>
    <link rel="stylesheet" type="text/css" href="style/index-style.css">
    <link rel="stylesheet" type="text/css" href="style/mobile-index-style.css">
    <link rel="stylesheet" type="text/css" href="style/cart-style.css">
    <link rel="stylesheet" type="text/css" href="style/order-info-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php
    session_start();

    if(!isset($_SESSION['items_amount'])) $_SESSION['items_amount'] = 0;
    if(!isset($_SESSION['total_price'])) $_SESSION['total_price'] = 0;
    if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    include "php_scripts/db_connection.php";
    include "php_scripts/product/load_product.php";
    $conn = openCon();
    $orderId = bin2hex(openssl_random_pseudo_bytes(5));

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
            $(document).on("click", ".remove", function()
            {
                var product = $(this).parent().parent();
                product.load("php_scripts/cart/remove_product.php", {id: product.data('value')});
                product.remove();
                $(".cart").load(window.location.href + " .cart > *");
                $(".cart-table").load(window.location.href + " .cart-table > *");
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
        <a class="btn" href="faq.php">FAQ</a>
        <a class="btn" href="contact.php">Kontakt</a>
    </div>
</div>

<!-- CART -->
<div class='cart-table col-12'>
    <div class="c-up">
<?php
//echo "<script> alert('price: {$_SESSION['cart'][2]['price']} | amount: {$_SESSION['cart'][2]['amount']}') </script>\n";
//echo "<script> alert('total_price: {$_SESSION['total_price']} | items_amount: {$_SESSION['items_amount']}'); </script>\n";
//echo "<form action='php_scripts/cart/remove_product.php' method='POST'><button type='submit' name='id' value='1'></button></form>\n";
echo "\t<table>\n";
echo "\t\t<tr>\n";
echo "\t\t\t<th id='t-img'></th>\n";
echo "\t\t\t<th id='t-name'>Nazwa</th>\n";
echo "\t\t\t<th id='t-price'>Cena</th>\n";
echo "\t\t\t<th id='t-amount'>Ilość</th>\n";
echo "\t\t\t<th id='t-remove'></th>\n";
echo "\t\t</tr>\n";
if(!empty($_SESSION['cart']))
{
    foreach($_SESSION['cart'] as $key => $value)
    {
        $sql = "SELECT * FROM product WHERE id = {$key}";
        $result = $conn->query($sql);
        if (!$result) trigger_error('Invalid query: ' . $conn->error);

        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            echo "\t\t<tr data-value='{$key}'>\n";
            echo "\t\t\t<td class='cart-img-container'><img class='cart-img' src='{$value['img_path']}'></td>\n";
            echo "\t\t\t<td class='cart-name'>{$value['name']}</td>\n";
            echo "\t\t\t<td class='cart-price'>{$value['price']}</td>\n";
            echo "\t\t\t<td class='cart-amount'>{$value['amount']}</td>\n";
            echo "\t\t\t<td class='cart-remove'><span class='material-icons remove'>close</span></td>\n";
            echo "\t\t</tr>\n";
        }
    }
}
else
{
    echo "\t\t<tr>\n";
    echo "<td id='empty-cart' colspan='5'>Koszyk jest pusty</td>\n";
    echo "\t\t</tr>\n";
}
echo "\t</table>\n";
?>
    </div>
    <form action="php_scripts/order/add_order.php?id=<?php echo $orderId ?>" method="POST">
        <div class="order-info">
            <div class="order-header">Dane do zamówienia</div>
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
                <input type="text" name="name"     placeholder="Imię"     required>
                <input type="text" name="lastname" placeholder="Nazwisko" required>
            </div>
            <div class="address">
                <input id="address" type="text" name="address" placeholder="Adres rozliczeniowy" required>
            </div>
            <div class="city-postcode">
                <input     id="city"           type="text"   name="city"           placeholder="Miasto"                required>
                <div class="postcode">
                    <input id="postcode-left"  type="number" name="postcode-left"  placeholder="XX"  min="0" max="99"  required>
                    <span>-</span>
                    <input id="postcode-right" type="number" name="postcode-right" placeholder="YYY" min="0" max="999" required>
                </div>
            </div>
        </div>
        <div class="c-down">
            <button type="submit" class="make-order">Złóż zamówienie</button>
        </div>
    </form>
</div>
<!-- FOOTER -->
<div class="footer col-12">© 2020 - Igor Kucyk</div>
</body>
<script type="text/javascript" src="js_scripts/mobile-script.js"></script>
</html>