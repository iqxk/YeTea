<?php
session_start();
include "../db_connection.php";
$conn = openCon();

$login = $_POST['login'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE login = '{$login}' AND password = '{$password}'";
$result = $conn->query($sql);
if (!$result) trigger_error('Invalid query: ' . $conn->error);

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    $_SESSION['user-id'] = $row['id'];
    header('Location: ../../index.php');
}
else
    header('Location: ../../wrong_user.php');
?>