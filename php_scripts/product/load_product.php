<?php
function loadProduct()
{
    global $conn;
    global $id;

    $sql = "SELECT p.id as product_id, 
                   p.img_path as img_path,
                   p.name as product_name,
                   p.description as product_desc, 
                   p.category_id as product_category, 
                   p.price as product_price,
                   p.amount as product_amount,
                   c.name as category_name
            FROM product p
            JOIN category c ON c.id = p.category_id
            WHERE p.id = $id";

    $result = $conn->query($sql);
    if (!$result) trigger_error('Invalid query: ' . $conn->error);


    $gram = 50;
    $product_price = 0;

    if ($result->num_rows > 0)
    {
        global $product_price;

        $row = $result->fetch_assoc();
        $product_id = $row["product_id"];
        $product_img_path = $row["img_path"];
        $product_name = $row["product_name"];
        $product_desc = $row["product_desc"];
        $product_category = $row["category_name"];
        $product_price = $row["product_price"];
        $product_amount = $row["product_amount"];

        echo "<div class=p-left>\n";
        echo "\t\t<img class='p-tea-img' src='{$product_img_path}'>\n";
        echo "\t\t<p class='p-tea-name'>{$product_name}</p>\n";
        echo "\t\t<p class='p-tea-category'>{$product_category}</p>\n";
        echo "\t</div>\n";
        echo "\t<div class=p-right>\n";
        echo "\t\t<p class='ingredients-list'>Lista składników:</p>\n";
        echo "\t\t<ul class='ingredients-panel' id='ing-panel'>\n";
        echo "\t\t</ul>\n";
        echo "\t\t<div class='description'><b>Opis: </b>{$product_desc}</div>\n";
        echo "\t\t<div class='price-amount-container'><span class='p-tea-price'>{$product_price} zł</span><span class='p-tea-gram'>/ {$gram}g</span></div>\n";
        echo "\t\t<form class='cart-and-amount' action='php_scripts/cart/update_cart.php' method='POST'>\n";
        echo "\t\t\t<span>Ilość:</span><input type='number' class='amount' min='1' name='amount' value='1' onKeyDown='return false;'>\n";
        echo "\t\t\t<button type='submit' class='add-to-cart' name='id' value='{$product_id}'>Dodaj do koszyka</button>\n";
        echo "\t\t</form>\n";
        //echo "\t\t<p class='p-amount-available'>Dostępna ilość: {$product_amount}</p>\n";
        echo "\t</div>\n";
    }
    else echo "Brak produktu o podanym ID!";

    $sql = "SELECT p.id as product_id,
                   p.name as product_name, 
                   i.id as ingredient_id,
                   i.name as ingredient_name
            FROM product p
            JOIN product_ingredients pi ON pi.product_id = p.id
            JOIN ingredient i ON i.id = pi.ingredient_id
            WHERE p.id = $id";

    $result = $conn->query($sql);
    if (!$result) trigger_error('Invalid query: ' . $conn->error);

    $ingredientsArray = array();
    $ingredientsIndex = 0;
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $ingredientsArray[$ingredientsIndex] = $row;
            $ingredientsIndex++;
        }
    }

    echo "<script>\n";
    echo "\t$(document).ready(function()\n";
    echo "\t{\n";
    echo "\t\tvar ing_panel = document.getElementById('ing-panel');\n";
    echo "\t\tvar ingredient;\n\n";
    for($i = 0; $i < $ingredientsIndex; $i++)
    {
        $ingredientName = $ingredientsArray[$i]["ingredient_name"];
        echo "\t\tingredient = document.createTextNode('{$ingredientName}');\n";
        echo "\t\tvar li = document.createElement('li');\n";
        echo "\t\tli.appendChild(ingredient);\n";
        echo "\t\ting_panel.appendChild(li);\n";
    }
    echo "\t\t$('.amount').change(function()\n";
    echo "\t\t{\n";
    echo "\t\t\t$('.p-tea-price').val(0);\n";
    echo "\t\t\t$('.p-tea-price').load('php_scripts/product/load_price.php', { product_price: {$product_price}, multiplier: $('.amount').val() });\n";
    echo "\t\t\t$('.p-tea-gram').val(0);\n";
    echo "\t\t\t$('.p-tea-gram').load('php_scripts/product/load_gram.php', { gram: {$gram}, multiplier: $('.amount').val() });\n";
    echo "\t\t});\n";
    echo "\t});\n";
    echo "\tfunction price()\n";
    echo "\t{\n";
    echo "\t\tload('php_scripts/product/load_gram.php', { gram: {$gram}, multiplier: $('.amount').val() });\n";
    echo "\t}\n";
    echo "</script>\n";
}
?>
