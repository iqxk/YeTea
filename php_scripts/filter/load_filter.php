<?php
function loadFilter()
{
    global $conn;
    global $checked;

    $sql = "SELECT * FROM category";
    $result = $conn->query($sql);
    if(!$result) trigger_error('Invalid query: ' . $conn->error);
    if($result->num_rows > 0)
    {
        $self = htmlspecialchars($_SERVER['PHP_SELF']);
        echo "<form action='{$self}?page=1' method='post'>\n";
        echo "<p>Filtr:</p>\n";
        //echo "\t<div class='price-range'>\n";
        //echo "\t\t<p>Cena:</p>\n";
        //echo "\t\t<input type='number' name='price_from' placeholder='od'> - <input type='number' name='price_to' placeholder='do'>\n";
        //echo "\t</div>\n";
        echo "\t<hr><br>\n";
        echo "\t<div class='tags'>\n";
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            if(!isset($checked[$i])) $checked[$i] = null;
            $category_id = $row["id"];
            $category_name = $row["name"];
            echo "\t\t<label class='tag-container'>{$category_name}\n";
            echo "\t\t\t<input type='checkbox' name='categories[]' value='{$category_id}' {$checked[$i]}>\n";
            echo "\t\t\t<span class='checkmark'></span>\n";
            echo "\t\t</label>\n";
            $i++;
        }
        echo "\t</div>\n";
        echo "\t<br><hr><br>\n";
        echo "\t<div class='submit-container'><button type='submit' class='submit-btn' name='filter-submit'>Zatwierdź</button></div>\n";
        echo "\t</form>\n";
    }
}
?>