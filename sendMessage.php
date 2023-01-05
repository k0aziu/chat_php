<?php

if (isset($_POST['message']) and $_POST['message'] !== "" and $_POST['message'] !== " ") {
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "k0aziu_chat";

    $conn = new mysqli($servername, $username, $password, $database);

    $nick = $_SESSION['nick'];

    if (isset($_POST['message']) and strpos($_POST['message'], "<") === false and strpos($_POST['message'], '"') === false) {
    $conn->query('INSERT INTO chat (content, user, sentTime) VALUES ("'.$_POST['message'].'", "'.$nick.'", "'.date("h:i:s").'")');
    $conn->query('UPDATE user SET lastSeen = "'.date("h:i:s").'" WHERE nick = "'.$_SESSION["nick"].'"');
    }
    unset($_POST['message']);
}
header('Location: index.php');
?>