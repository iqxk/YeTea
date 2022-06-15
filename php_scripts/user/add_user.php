<?php
include "../db_connection.php";
$conn = openCon();

$login = $_POST['login'];
$password = $_POST['password'];

$sql = "SELECT login FROM users WHERE login = '{$login}'";
$result = $conn->query($sql);
if (!$result) trigger_error('Invalid query: ' . $conn->error);
if ($result->num_rows > 0) header('Location: ../../wrong_register.php');
else
{
    $sql = "INSERT INTO users (login, password)
        VALUES            ('{$login}', '{$password}')";

    if ($conn->query($sql) === TRUE)
        echo "New record created successfully";
    else
        echo "Error: " . $sql . "<br>" . $conn->error;
    header('Location: ../../index.php');
}


?>