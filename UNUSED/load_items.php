<?php
function loadItems()
{
    global $conn;
    global $filterString;
    //global $numberOfRecords;

    global $currentPage; // 1
    $tempPage = 12*($currentPage-1)+1; // 12 * 0 = 0

    $sql = "SELECT p.id as product_id, 
                   p.img_path as img_path,
                   p.name as product_name,
                   p.category_id as product_category, 
                   p.gram as product_gram, 
                   p.price as product_price,
                   p.amount as product_amount,
                   i.id as ingredient_id,
                   i.name as ingredient_name, 
                   c.name as category_name
            FROM product p
            JOIN product_ingredients pi ON pi.product_id = p.id
            JOIN ingredient i ON i.id = pi.ingredient_id
            JOIN category c ON c.id = p.category_id
            WHERE p.id BETWEEN $tempPage AND $tempPage+11";
    $sql .= $filterString;
    $result = $conn->query($sql);
    if(!$result) trigger_error('Invalid query: ' . $conn->error);
    $rowsArray = array();
    $index = 0;
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $rowsArray[$index] = $row;
            $index++;
        }
    }
    for($i = 0; $i < $index;)
    {
        //$numberOfRecords++;
        $product_id = $rowsArray[$i]["product_id"];
        $product_img_path = $rowsArray[$i]["img_path"];
        $product_name = $rowsArray[$i]["product_name"];
        $product_category = $rowsArray[$i]["product_category"];
        $product_gram = $rowsArray[$i]["product_gram"];
        $product_price = $rowsArray[$i]["product_price"];
        $product_amount = $rowsArray[$i]["product_amount"];

        echo "<div class='item'>\n";
        echo "\t<img class='tea-img' src='{$product_img_path}'>\n";
        echo "\t<p class='tea-name'>{$product_name}</p>\n";

        echo "\t<p class='tea-desc'>";
        $ingredients_amount = 0;
        foreach($rowsArray as $temp)
            if($temp["product_id"] == $product_id)
                $ingredients_amount++;
        $firstIngredient = true;
        for($j = 0; $j < $ingredients_amount; $j++)
        {
            $ingredient_name = $rowsArray[$i]["ingredient_name"];
            if(!$firstIngredient) echo ", ";
            echo $ingredient_name;
            $firstIngredient = false;
            $i++;
        }

        echo "\t<p class='tea-price'>{$product_price} zł <span class='tea-gram'>- {$product_gram}g</span></p>\n";
        echo "\t<a class='add-to-cart'>Dodaj do koszyka</a>\n";
        echo "\t<p class='amount-available'>Dostępna ilość: {$product_amount}</p>\n";
        echo "</div>\n";
    }
}
?>
