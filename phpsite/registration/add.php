<?php
$servername = "localhost";
$username = "root";  
$dbpassword = "mike";    

try {
    $conn = new PDO("mysql:host=$servername;dbname=usjr", $username, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $department = $conn->prepare("SELECT * FROM colleges");
    $department->execute();

    $program = $conn->prepare("SELECT * FROM programs");
    $program->execute();

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            margin-top: 5rem;
            background-color: #ffffff;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        label {
            font-size: 1rem;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        button[type="reset"] {
            background-color: #f0ad4e;
        }

        button[type="submit"]:hover,
        button[type="reset"]:hover {
            opacity: 0.9;
        }

        button[type="submit"][name="cancel"] {
            background-color: #6c757d;
            color: white;
        }

        button[type="submit"][name="cancel"]:hover {
            background-color: #5a6268;
        }

        .error, .success {
            text-align: center;
            font-size: 1rem;
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        .error {
            color: #d9534f;
            background-color: #f2dede;
            border: 1px solid #d9534f;
        }

        .success {
            color: #4cae4c;
            background-color: #dff0d8;
            border: 1px solid #4cae4c;
        }

        @media (max-width: 600px) {
            form {
                padding: 20px;
                width: 90%;
            }
        }

    </style>
</head>
<body>

    <form action="addprocess.php" method="post" name="form">
        <h1>ADD STUDENT</h1>
        
        <label for="id">ID</label>
        <input type="number" id="id" name="id" required>

        <label for="firstname">Firstname</label>
        <input type="text" id="firstname" name="firstname" required>

        <label for="midname">Middle Name</label>
        <input type="text" id="midname" name="midname" required>

        <label for="lastname">Lastname</label>
        <input type="text" id="lastname" name="lastname" required>

        <label for="departments">Department</label>
        <select name="college" id="departments" required>
            <option value="" disabled>Select College</option>
            <?php if ($department->rowCount() > 0): ?>
                <?php foreach ($department->fetchAll() as $row): ?>
                    <option value="<?php echo htmlspecialchars($row['collid']); ?>"><?php echo htmlspecialchars($row['collfullname']); ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>


        <label for="programs">Program</label>
        <select name="programs" id="programs" required>
            <option value="" disabled>Select Program</option>
            <?php if($program->rowCount() > 0): ?>
                    <?php foreach ($program->fetchALL() as $prog): ?>
                        <option value="<?php echo htmlspecialchars($prog['progid']); ?>"><?php echo htmlspecialchars($prog['progfullname']); ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
        </select>

        <label for="year">Year</label>
        <select name="year" id="year" required>
            <option value="" disabled>Select Year</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <button type="submit"><strong>Add</strong></button>
        <button type="reset"><strong>Clear</strong></button>
        <a href="home.php"><button type="button">Back</button></a>
        <?php
            if (isset($_GET['status'])) {
                $status = htmlspecialchars($_GET['status']);
                switch ($status) {
                    case 'invalid':
                        echo "<div class='error'>Error: Invalid Entry</div>";
                        break;
                    case 'exists':
                        echo "<div class='error'>Error: ID already exists!</div>";
                        break;
                    case 'success':
                        echo "<div class='success'>Student successfully added!</div>";
                        break;
                } 
            }
        ?>
    </form>

</body>
</html>
