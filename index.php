<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    session_start();
    if (isset($_SESSION['nick'])) {
        echo ("<meta http-equiv='refresh' content='30; URL='index.php'>");
        echo ('<title>Chat | ' . $_SESSION['nick'] . '</title>');
    } else {
        echo ('<title>Chat</title>');
    }
    ?>
    <style>
        * {
            background-color: black;
            color: white;
        }

        @import url('https://fonts.googleapis.com/css?family=Montserrat:200,300,400,600');

        .box {
            background-image: linear-gradient(to bottom right, #eb01a5, #d13531);
            width: 100%;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            background-size: cover;
            color: white;
            font-family: sans-serif;
            font-weight: 200;
            z-index: 1;
        }

        .box * {
            z-index: 2;
        }

        h1 {
            font-family: Montserrat, sans-serif;
            color: white;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .background-shapes {
            content: "";
            position: absolute;
            z-index: 2;
            left: 0;
            top: 0;
            width: 100%;
            height: 5076px;
            background-size: 100%;
            animation: 120s infiniteScroll linear infinite;
            background-repeat-x: repeat;
            background-image: url(https://cdn2.hubspot.net/hubfs/53/Pricing%202017%20Assets/marketing/Header_Circles-1.svg);
        }

        @-webkit-keyframes infiniteScroll {
            0% {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }

            100% {
                -webkit-transform: translate3d(0, -1692px, 0);
                transform: translate3d(0, -1692px, 0);
            }
        }

        @keyframes infiniteScroll {
            0% {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }

            100% {
                -webkit-transform: translate3d(0, -1692px, 0);
                transform: translate3d(0, -1692px, 0);
            }
        }
    </style>
</head>

<body>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "k0aziu_chat";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_SESSION['nick']) and strpos($_SESSION['nick'], "<") === false) {
        echo <<<END
<div style="overflow: hidden;">
<form action="sendMessage.php" method="post" style="display: inline-block; width: 70%;">
<input type='text' name='message' id='message' placeholder='Type here your message or paste link do image...' style='padding: 10px; width: 100%; border: none; background-color: #111;'>
</form>
<form action=".php" method="post" style="float: right; width: 26%;">
<input type='text' name=''" id="'' placeholder=''" style="padding: 10px; border: none; background-color: #111; width: 100%;">
</form>
</div>

<div id="menu" style="background-color: #111; float: right; display: inline-block; width: 20%; height: 700px; margin-top: 10px;">
<div style="width: 100%; height: 20px; background-color: #333; text-align: center;">
MENU
</div>
Last seen users:
END;
        $lastSeen = $conn->query('SELECT nick, lastSeen FROM user ORDER BY lastSeen DESC LIMIT 10');
        while ($row = $lastSeen->fetch_assoc()) { {
                echo ('<br> &nbsp; &#187; ' . $row['nick'] . ' was seen at  ' . $row['lastSeen']);
            }
        }

        echo <<<END
<a href="logout.php" style="text-align: center; width: 100%; display: inline-block; background-color: transparent;"> LOGOUT </a> <br><br>
<div style="width: 100%; height: 20px; background-color: #333; text-align: center;">
ACCOUNT
</div>
END;
        echo ("Name: " . $_SESSION['nick'] . "<br>");
        echo ("Admin: ");
        echo <<<END
</div>
<br>


END;

        $messages = $conn->query('SELECT user, content, sentTime, id FROM chat ORDER BY id DESC LIMIT 45');
        while ($row = $messages->fetch_assoc()) {
            if (substr($row["content"], -4) === ".png" or substr($row["content"], -4) === ".jpg" or substr($row["content"], -4) === ".gif") {
                $row["content"] = '<a href="' . $row["content"] . '"><img style="background-color: #fff;" src ="' . $row["content"] . '" height="200px"></a>';
            }
            echo ($row["user"] . ": " . $row["content"] . '<span style="color: gray; font-size: 10px; margin-left: 8px;">' . $row["sentTime"] . "</span>");

            $admin = $conn->query('SELECT admin FROM user WHERE nick = "' . $_SESSION['nick'] . '"');
            $rowAdmin = $admin->fetch_assoc();
            if ($rowAdmin['admin'] == 1 or $row["user"] === $_SESSION['nick']) {

                echo ('<div style="display: inline-block;">');
                echo ('<form action="removeMessage.php" method="post">');
                echo ('<input readonly name="remove" id="remove" value="' . $row['id'] . '" type="text" style="margin-left: 10px; height: 0; width: 0; border: none; user-select: none;">');
                echo ('<input value="' . $row['id'] . '" type="image" src="remove.png" style="margin-left: -10px; height: 12px;">');
                echo ('</input></form></div>');
            }

            echo ("<br>");
        }
    } else {
        #login
        echo <<<END
<div class="box">
<div class="background-shapes"></div>
<h1>K0aziu PHP Chat</h1>
<form action="login.php" method="post">
<input type="text" name="nick" id="nick" placeholder="Nick...">
<input type="password" name="passwd" id="passwd" placeholder="Password...">
<input type="submit" value="Im go in">
</form>
</div> 
END;
    }
    ?>

</body>

</html>