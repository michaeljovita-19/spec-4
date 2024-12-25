<?php
$id = $_POST['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h1 {
            font-size: 1.3rem;
            color: #333;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
            border: none;
        }
        button[type="submit"] {
            background-color: #e74c3c;
            color: white;
        }
        button[type="button"] {
            background-color: #3498db;
            color: white;
        }
        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Are you sure you want to delete this student?</h1>
        
        <form action="deleteprocess.php" method="post">
            <input type="hidden" name="studid" value="<?php echo htmlspecialchars($id); ?>">
            <button type="submit">Yes</button>
        </form>

        <form action="home.php" method="post">
            <button type="submit">No</button>
        </form>
    </div>

</body>
</html>

