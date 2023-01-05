<?php
if (isset($_POST['remove'])) {
    session_start();
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "k0aziu_chat";

    $conn = new mysqli($servername, $username, $password, $database);

    $query = 'DELETE FROM chat WHERE id = "'.$_POST['remove'].'"';
    $conn->query('UPDATE user SET lastSeen = "'.date("h:i:s").'" WHERE nick = "'.$_SESSION["nick"].'"');
    
    $conn->query($query);
    echo($_POST["remove"]);
    unset($_POST['remove']);
}
header('Location: index.php');
?>