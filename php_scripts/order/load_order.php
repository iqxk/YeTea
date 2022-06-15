<?php
global $conn;

$sql = "SELECT * FROM orders WHERE order_id = '{$_GET['id']}'";
$result = $conn->query($sql);
if (!$result) trigger_error('Invalid query: ' . $conn->error);

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();

    $id = $row['id'];
    $orderId = $row['order_id'];
    $name = $row['name'];
    $lastname = $row['lastname'];
    $address = $row['address'];
    $city = $row['city'];
    $postcodeLeft = $row['postcode_left'];
    $postcodeRight = $row['postcode_right'];
    $supplierId = $row['supplier_id'];
    $price = $row['price'];
    $statusId = $row['status_id'];
    $cart = unserialize($row['cart']);
}

$sql = "SELECT name FROM supplier WHERE id = '{$supplierId}'";
$result = $conn->query($sql);
if (!$result) trigger_error('Invalid query: ' . $conn->error);

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    $supplierName = $row['name'];
}

$sql = "SELECT name FROM status WHERE id = '{$statusId}'";
$result = $conn->query($sql);
if (!$result) trigger_error('Invalid query: ' . $conn->error);

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    $statusName = $row['name'];
}

echo "<div class='order-summary'>\n";
echo "\t<div class='order-id'>ID zamówienia: {$orderId}</div>\n";
echo "\t<div class='delivery-details'>\n";
echo "\t\t<p class='delivery-title'>Dane odbiorcy:</p>\n";
echo "\t\t<p>{$name} {$lastname},</p>\n";
echo "\t\t<p>{$address},</p>\n";
echo "\t\t<p>{$postcodeLeft}-{$postcodeRight} {$city}</p>\n";
echo "\t</div>\n";
echo "\t<div class='supplier'>\n";
echo "\t\t<p class='supplier-title'>Rodzaj dostawy:</p>\n";
echo "\t\t<p>{$supplierName}</p>\n";
echo "\t</div>\n";
echo "\t<div class='price'>Łączna suma: {$price} zł</div>\n";
echo "\t<div class='status'>Status:&nbsp;<span class='code_{$statusId}'>{$statusName}</div>";
echo "\t<div class='product-list'>\n";
echo "\t\t<ul><p class='product-list-title'>Lista produktów:</p>\n";
foreach($cart as $key => $value)
{
    echo "\t\t\t<li><a href='product.php?id={$key}'>{$value['name']} - {$value['price']} zł (Ilość: {$value['amount']})</a></li>\n";
}
echo "\t\t</ul>\n";
echo "\t</div>\n";
echo "\t<div class='payment-info'>\n";
echo "\t\t<p class='payment-info-title'>Dane do przelewu:</p>\n";
echo "\t\t<p><b>Nazwa odbiorcy:</b> Firma YeaTea</p>\n";
echo "\t\t<p><b>Numer rachunku:</b> 65 1020 0000 0000 0000 0000 0000</p>\n";
echo "\t\t<p><b>Adres:</b> ul. Krzesełkowa 997, 00-112 Kurkowo</p>\n";
echo "\t\t<p><b>Tytuł przelewu:</b> {$orderId}</p>\n";
echo "\t\t<p><b>Kwota:</b> {$price} PLN</p>\n";
echo "\t</div>\n";
echo "</div>\n";

/*
echo "<ul class='col-12'>\n";
echo "\t<li>id: {$id}</li>\n";
echo "\t<li>orderId: {$orderId}</li>\n";
echo "\t<li>name: {$name}</li>\n";
echo "\t<li>lastname: {$lastname}</li>\n";
echo "\t<li>address: {$address}</li>\n";
echo "\t<li>city: {$city}</li>\n";
echo "\t<li>postcodeLeft: {$postcodeLeft}</li>\n";
echo "\t<li>postcodeRight: {$postcodeRight}</li>\n";
echo "\t<li>supplierId: {$supplierId}</li>\n";
echo "\t<li>supplierName: {$supplierName}</li>\n";
echo "\t<li>price: {$price}</li>\n";
echo "\t<li>statusId: {$statusId}</li>\n";
echo "\t<li>statusName: {$statusName}</li>\n";
echo "\t<li>cart: {$cartString}</li>\n";
echo "</ul>\n";
*/
?>


