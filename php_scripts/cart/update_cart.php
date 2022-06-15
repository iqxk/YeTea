<?php
if(isset($_POST))
{
    session_start();
    include "../db_connection.php";
    $conn = openCon();

    $sql = "SELECT * FROM product WHERE id = {$_POST['id']}";
    $result = $conn->query($sql);
    if (!$result) trigger_error('Invalid query: ' . $conn->error);

    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $id = $_POST['id'];

        $name = $row['name'];
        $price = $row['price']*$_POST['amount'];
        $img_path = $row['img_path'];
        $product_info = ["img_path" => "$img_path",
                         "name" => "$name",
                         "price" => "$price",
                         "amount" => $_POST['amount']];
        $_SESSION['cart'][$id] = $product_info;

        $_SESSION['items_amount'] += $_POST['amount'];
        $_SESSION['total_price'] += $row['price']*$_POST['amount'];
        print_r($_SESSION);
    }
    header('Location: ../../cart.php');
}
?>