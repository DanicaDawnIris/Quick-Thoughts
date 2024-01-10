<!DOCTYPE html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        #header {
            font-size: 38px;
            margin-bottom: 10px;
            text-align: center;
            color: #fff;
            background-color: #3498db;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            max-width: 100px; 
            margin-right: 10px; 
        }

        #logoutForm {
            display: flex;
            align-items: center;
            margin-left: auto; 
        }

        .logout-btn {
            padding: 8px 12px;
            background-color: #e74c3c; /* red */
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #c0392b; /* dark red */
        }
    </style>

</head>

<body>

    <?php
    session_start();

    if (isset($_POST['logoutButton'])) {
        // unset session
        $_SESSION = array();

        // destroy session
        session_destroy();

        header('Location: index.php');
        exit();
    }
    ?>

    <div id="header">
        <div class="logo-container">
            <img class="logo" src="bubble.png" alt="Logo">
            <div id="title">Quick Thoughts!</div>
        </div>
        <form id="logoutForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <button type="submit" name="logoutButton" class="button logout-btn">LOG OUT</button>
        </form>
    </div>

</body>

</html>
