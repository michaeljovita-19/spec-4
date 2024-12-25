<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }
        
        form {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
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
            color: white;
            text-decoration: none;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }

        .success {
            color: green;
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
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
    <form action="processReg.php" method="post">
        <h1>Add New User</h1>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required>
        
        <label for="verify">Verify Password:</label>
        <input type="password" id="verify" name="verify" required>
        
        <div class="button-container">
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </div>
        
        <button type="button" onclick="window.location.href='login.php'">Login</button>
        <?php
    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'error':
                echo "<div class='error'>Error: Passwords do not match!</div>";
                header("Refresh: 1; url=userreg.php");
                break;
            case 'exists':
                echo "<div class='error'>Error: Username already exists!</div>";
                header("Refresh: 1; url=userreg.php");
                break;
            case 'success':
                echo "<div class='success'>Registration successful!</div>";
                header("Location: login.php");
                break;
        }
    }
    ?>
    </form>
</body>
</html>
