<?php
$backgroundImage = "bubble.png"; // background image 

// check login errors
$errors = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="indexS.css">
    <title>Quick Thoughts</title>
    <style>
        body {
            background-image: url('<?php echo $backgroundImage; ?>');
            background-size: auto;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const body = document.body;
            let positionX = 0;
            let positionY = 0;

            function moveBackground() {
                positionX += 0.2; // speed
                positionY += 0.1;
                body.style.backgroundPosition = positionX + "px " + positionY + "px";
                requestAnimationFrame(moveBackground);
            }

            moveBackground();
        });
    </script>
</head>

<body>
    <div id="container">
        <div id="header">
            Share a Quick Thoughts!
        </div>
        <div id="loginContainer" class="indexcontainer">
            <form id="loginForm" method="post" action="DB.php">
                <label for="username" class="label">Username</label>
                <input type="text" id="username" name="username" class="input-field" required>
                <br>
                <label for="password" class="label">Password</label>
                <input type="password" id="password" name="password" class="input-field" required>
                <br>
                
                <?php
                // error messages
                if ($errors === 'IncorrectPassword') {
                    echo '<div style="color: red;">Incorrect password</div>';
                } elseif ($errors === 'UserNotFound') {
                    echo '<div style="color: red;">User not found</div>';
                }
                ?>
                <button type="submit" id="loginBtn" class="indexbutton in-btn">LOG IN</button>
            </form>
        </div>
    </div>
</body>

</html>
