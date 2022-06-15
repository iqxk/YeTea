<?php
session_start();
include "../db_connection.php";
$conn = openCon();

$userId = $_SESSION['user-id'];
$orderId = $_GET['id'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$city = $_POST['city'];
$postcodeLeft = $_POST['postcode-left'];
$postcodeRight = $_POST['postcode-right'];
$supplierId = $_POST['suppliers'];
$supplierPrice = 0;

$sql = "SELECT price FROM supplier WHERE id = {$supplierId}";
$result = $conn->query($sql);
if (!$result) trigger_error('Invalid query: ' . $conn->error);
if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    $supplierPrice = $row['price'];
}

$totalPrice = $_SESSION['total_price'] + $supplierPrice;
$cart = serialize($_SESSION['cart']);
$sql = "INSERT INTO orders (user_id, order_id, name, lastname, address, city, postcode_left, postcode_right, supplier_id, price, status_id, cart) 
        VALUES             ('{$userId}', '{$orderId}', '{$name}', '{$lastname}', '{$address}', '{$city}', '{$postcodeLeft}', '{$postcodeRight}', '{$supplierId}', '{$totalPrice}', '1', '{$cart}')";
if ($conn->query($sql) === TRUE)
    echo "New record created successfully";
else
    echo "Error: " . $sql . "<br>" . $conn->error;

unset($_SESSION['items_amount']);
unset($_SESSION['total_price']);
unset($_SESSION['cart']);
header('Location: ../../order.php?id='.$orderId);
?>