<?php
function getTrueReferrer($url) {
    if (strpos($url, '?') !== false) {
        $parts = explode('?', $url);
        return $parts[0];
    }
    return $url;
}

function getCurrentUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];

    return $protocol . $host . $uri;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        
        h1 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        button:hover {
            background-color: #45a049;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
            font-size: 14px;
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .error, .success {
            text-align: center;
            margin-top: 20px;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }
        
        .button-container button {
            width: 48%;
        }

    </style>
</head>
<body>
    <form action="processlogin.php" method="post">
        <h1>Log In</h1>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required>

        <a href="userReg.php">Register here.</a>

        <div class="button-container">
            <button type="submit">Log In</button>
            <button type="reset">Reset</button>
        </div>
        <?php
    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'invalid':
                echo "<div class='error'>Invalid username or password!</div>";
                break;
            case 'empty':
                echo "<div class='error'>Please fill in all fields!</div>";
                break;
            case 'success':
                echo "<div class='success'>Login successful!</div>";
                header("Refresh:1; url=home.php");
                break;
        }
    }
    $res = getTrueReferrer(getCurrentUrl());
    echo "<button><a href='" . htmlspecialchars($res) . "'>Back</a></button>";
    ?>
    </form>

    
</body>
</html>
