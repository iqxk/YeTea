<?php
function loadItems()
{
    global $conn;
    global $filterString;
    global $numberOfRecords;

    global $currentPage; // 1
    $tempPage = 12 * ($currentPage - 1); // 12 * 0 = 0

    $sql = "SELECT p.id as product_id, 
                   p.img_path as img_path,
                   p.name as product_name,
                   p.category_id as product_category, 
                   p.price as product_price,
                   p.amount as product_amount,
                   c.name as category_name
            FROM product p
            JOIN category c ON c.id = p.category_id";
    $sql .= $filterString;
    $sql .= " ORDER BY p.id";
    $sql .= " LIMIT 12 OFFSET $tempPage";

    $result = $conn->query($sql);
    if (!$result) trigger_error('Invalid query: ' . $conn->error);

    $rowsArray = array();
    $index = 0;
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $rowsArray[$index] = $row;
            $index++;
        }
    }

    for ($i = 0; $i < $index; $i++)
    {
        $numberOfRecords++;
        $product_id = $rowsArray[$i]["product_id"];
        $product_img_path = $rowsArray[$i]["img_path"];
        $product_name = $rowsArray[$i]["product_name"];
        //$product_category = $rowsArray[$i]["product_category"];
        $product_price = $rowsArray[$i]["product_price"];
        $product_amount = $rowsArray[$i]["product_amount"];

        $self = htmlspecialchars($_SERVER['PHP_SELF']);
        echo "<form action='product.php' method='GET'>\n";
        echo "<div class='item'>\n";
        echo "\t<img class='tea-img' src='{$product_img_path}'>\n";
        echo "\t<p class='tea-name'>{$product_name}</p>\n";
        echo "\t<p class='tea-desc' id='product_id_{$product_id}'></p>\n";
        echo "\t<p class='tea-price'>{$product_price} zł <span class='tea-gram'>/ 50g</span></p>\n";
        echo "\t<button type='submit' class='add-to-cart' name='id' value='$product_id'>Wybierz</button>\n";
        //echo "\t<p class='amount-available'>Dostępna ilość: {$product_amount}</p>\n";
        echo "</div>\n";
        echo "</form>\n";
    }

    //echo "<script> alert('{$filterString}') </script>\n";


    $product_ingredients_sql = 12 * $currentPage;
    $sql = "SELECT p.id as product_id,
                   p.name as product_name, 
                   i.id as ingredient_id,
                   i.name as ingredient_name
            FROM product p
            JOIN product_ingredients pi ON pi.product_id = p.id
            JOIN ingredient i ON i.id = pi.ingredient_id";

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

    $id = 0;
    for($i = 0; $i < $ingredientsIndex;)
    {
        $ingredients_amount = 0;
        if($id < $index)
        {
            foreach ($ingredientsArray as $temp)
            {
                echo "<script> console.log('składnik-product: {$temp["product_id"]} | product: {$rowsArray[$id]["product_id"]}') </script>\n";
                if ($temp["product_id"] == $rowsArray[$id]["product_id"])
                {
                    echo "<script> console.log('ILOŚĆ SKŁADNIKÓW++ DLA {$rowsArray[$id]['product_id']}') </script>\n";
                    $ingredients_amount++;
                }

            }
        }

        $firstIngredient = true;
        $ingredientsString = "";
        for($j = 0; $j < $ingredients_amount; $j++)
        {
            $ingredient_name = $ingredientsArray[$i]["ingredient_name"];
            if(!$firstIngredient) $ingredientsString .= ", ";
            $ingredientsString .= $ingredient_name;
            $firstIngredient = false;
            $i++;
        }
        echo "<script> document.getElementById('product_id_{$rowsArray[$id]['product_id']}').innerText = '{$ingredientsString}'; </script>";
        if($id < $index-1) $id++;
    }
}
?>