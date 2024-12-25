<?php
$servername = "localhost";
$username = "root";  
$dbpassword = "mike";    

try {
    $conn = new PDO("mysql:host=$servername;dbname=usjr", $username, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql1 = $conn->prepare("SELECT * FROM programs");
    $sql1->execute();
    $sql2 = $conn->prepare("SELECT * FROM colleges");
    $sql2->execute();

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fafafa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #fafafa;
        }

        button {
            width: 48%;
            padding: 12px;
            font-size: 14px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
        }

        button[type="reset"] {
            background-color: #f44336;
        }

        button:hover {
            opacity: 0.8;
        }

        .status-message {
            margin-top: 15px;
            text-align: center;
        }

        .status-message p {
            margin: 0;
            font-size: 14px;
        }

        .status-message p.error {
            color: red;
        }

        .status-message p.success {
            color: green;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Add New Student</h1>

    <form action="addprocess.php" method="post" name="form">
        <label for="id">Student ID:</label>
        <input type="number" name="id" required>

        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" pattern="[A-Za-z]+" required>

        <label for="middlename">Middle Name:</label>
        <input type="text" name="middlename" pattern="[A-Za-z]+" required>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" pattern="[A-Za-z]+" required>

        <label for="colleges">College:</label>
        <select name="colleges" id="colleges" required>
            <?php if ($sql2->rowCount() > 0): ?>
                <?php foreach ($sql2->fetchAll() as $row): ?>
                    <option value="<?php echo htmlspecialchars($row['collid']); ?>"><?php echo htmlspecialchars($row['collfullname']); ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <label for="programs">Program:</label>
        <select name="programs" id="programs" required>
            <?php if ($sql1->rowCount() > 0): ?>
                <?php foreach ($sql1->fetchAll() as $row): ?>
                    <option value="<?php echo htmlspecialchars($row['progid']); ?>"><?php echo htmlspecialchars($row['progfullname']); ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <label for="year">Year:</label>
        <select name="year" id="year">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select><br>

        <button type="submit">Add Student</button>
        <button type="reset">Clear Form</button>
    </form>

    <div class="status-message">
        <?php
        if (isset($_GET['status'])) {
            switch ($_GET['status']) {
                case 'exists':
                    echo "<p class='error'>Error: ID already exists!</p>";
                    break;
                case 'success':
                    echo "<p class='success'>Student added successfully!</p>";
                    break;
            }
        }
        ?>
    </div>
</div>

</body>
</html>
