<?php
if (isset($_POST['nick']) and isset($_POST['passwd']) and strpos($_POST['nick'], "<") === false and strpos($_POST['nick'], '"') === false and strpos($_POST['passwd'], "<") === false and strpos($_POST['passwd'], '"') === false) {
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "k0aziu_chat";

    $conn = new mysqli($servername, $username, $password, $database);

    $passwd = $conn->query('SELECT password FROM user WHERE nick = "'.$_POST['nick'].'"');
    $row = $passwd->fetch_assoc();
    if ($_POST['passwd'] === $row['password']) {
        $_SESSION['nick'] = $_POST['nick'];
        $conn->query('UPDATE user SET lastSeen = "'.date("h:i:s").'" WHERE nick = "'.$_SESSION["nick"].'"');
        unset($_POST['nick']);
        unset($_POST['passwd']);
    }
}
header('Location: index.php');
?>