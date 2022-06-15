<?php
global $filterString;
global $checked;
if(isset($_POST["categories"]))
{
    $filterString = " WHERE ";
    foreach($_POST["categories"] as $category)
    {
        if(!$firstFilter) $filterString .= " OR";
        $filterString .= " p.category_id = $category";
        $firstFilter = false;
        $checked[$category-1] = "checked";
    }
}
?>