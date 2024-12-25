<?php
$servername = "localhost";
$username = "root";  
$dbpassword = "mike";    

if (isset($_GET['studid'])) {
    $iid = $_GET['studid'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=usjr", $username, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql1 = $conn->prepare("SELECT * FROM programs");
        $sql1->execute();
        $sql2 = $conn->prepare("SELECT * FROM colleges");
        $sql2->execute();

        $sql = $conn->prepare("SELECT * FROM students WHERE studid = ?");
        $sql->execute([$iid]);
        
        if ($sql->rowCount() > 0) {
            // Fetch the student's details
            $student = $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=notfound");
            exit();
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            width: 100%;
            max-width: 700px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            box-sizing: border-box;
        }

        h1 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            text-align: center;
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: #555;
        }

        label {
            font-size: 1rem;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        select {
            width: 100%;
            padding:5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button[type="button"] {
            background-color: #d9534f;
            margin-top: 10px;
        }

        button[type="button"]:hover {
            background-color: #c9302c;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .cancel {
            width: 100%;
            background-color: #f8f9fa;
            color: #495057;
            border: 1px solid #ccc;
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

        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <?php if (isset($student)): ?>
        <div class="container">
            <h1>Confirm Edition of Student</h1>
            
            <p>Are you sure you want to delete the following student?</p>
            
            <form action="editprocess.php" method="post">
                <label for="id">Student ID</label>
                <input type="text" id="id" name="studid" value="<?php echo htmlspecialchars($student['studid']); ?>" readonly><br>

                <label for="firstname">Firstname</label>
                <input type="text" id="firstname" name="firstname" pattern="[A-Za-z]+" value="<?php echo htmlspecialchars($student['studfirstname']);  ?>"><br>

                <label for="lastname">Lastname</label>
                <input type="text" id="lastname" name="lastname" pattern="[A-Za-z]+" value="<?php echo htmlspecialchars($student['studlastname']); ?>"><br>
                
                <label for="midname">Middle Name</label>
                <input type="text" id="midname" name="midname" pattern="[A-Za-z]+" value="<?php echo htmlspecialchars($student['studmidname']); ?>"><br>

                <label for="colleges">College:</label>
                    <select name="colleges" id="colleges">
                        <?php if ($sql2->rowCount() > 0): ?>
                            <?php foreach ($sql2->fetchAll() as $row): ?>
                                <option value="<?php echo htmlspecialchars($row['collid']); ?>"><?php echo htmlspecialchars($row['collfullname']); ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>

                <label for="programs">Program:</label>
                    <select name="programs" id="programs">
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

                <div class="button-container">
                    <button type="submit" name="edit"><strong>Confirm</strong></button>
                    <button type="button" onclick="window.location.href='home.php'"><strong>Cancel</strong></button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <p>Student not found.</p>
    <?php endif; ?>

</body>
</html>