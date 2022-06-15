<?php
session_start();
$id = $_POST['id'];
//echo "<script> alert('amount: {$_SESSION['cart'][$id]['amount']} | price: {$_SESSION['cart'][$id]['price']}') </script>\n";
$_SESSION['items_amount'] -= $_SESSION['cart'][$id]['amount'];
$_SESSION['total_price'] -= $_SESSION['cart'][$id]['price'];
//echo "<script> alert('total_price: {$_SESSION['total_price']} | items_amount: {$_SESSION['items_amount']}'); </script>\n";
unset($_SESSION['cart'][$id]);
?>