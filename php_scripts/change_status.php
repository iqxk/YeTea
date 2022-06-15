<?php
include "db_connection.php";
$conn = openCon();

$orderId = $_GET['order_id'];
$status = $_POST['status'];

$sql = "UPDATE orders SET status_id = {$status} WHERE order_id = '{$orderId}'";
if ($conn->query($sql) === TRUE)
    echo "Record updated successfully";
else
    echo "Error updating record: " . $conn->error;
header('Location: ../order-list.php');
?>