<?php
function loadPagination()
{
    global $conn;
    global $filterString;

    $sql = "SELECT COUNT(id) AS productCount,
                   category_id
                   FROM product p ";
    $sql .= $filterString;
    $result = $conn->query($sql);
    if(!$result) trigger_error('Invalid query: ' . $conn->error);

    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $productCount = $row['productCount'];                             //echo "<script> alert('productCount: {$row['productCount']}') </script>\n";
        $pageFormula = $productCount < 12 ? 0 : (int)($productCount/12);  // "<script> alert('pageFormula: {$pageFormula}') </script>\n";
        $pages = $pageFormula > 0 ? $pageFormula+1 : $pageFormula;        //echo "<script> alert('pages: {$pages}') </script>\n";

        for($i = 0; $i < $pages; $i++)
        {
            $pageNumber = $i+1;
            $self = htmlspecialchars($_SERVER['PHP_SELF']);
            echo "<form action='{$self}' method='GET'><button type='submit' class='page' name='page' value='{$pageNumber}'>$pageNumber</button></form>\n";
        }
    }

    $sql = "SELECT id FROM product p ";
    $sql .= $filterString;
    $result = $conn->query($sql);
    if(!$result) trigger_error('Invalid query: ' . $conn->error);

}
?>