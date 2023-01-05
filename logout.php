<?php
session_start();

$servername = "localhost";
    $username = "root";
    $password = "";
    $database = "k0aziu_chat";

    $conn = new mysqli($servername, $username, $password, $database);
    $conn->query('UPDATE user SET lastSeen = "'.date("h:i:s").'" WHERE nick = "'.$_SESSION["nick"].'"');
    unset($_SESSION['nick']);
    header('Location: index.php');
?>