<?php
function openCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "yetea";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("Connect failed: %s\n". $conn -> error);

    return $conn;
}

function closeCon($conn)
{
    $conn -> close();
}


