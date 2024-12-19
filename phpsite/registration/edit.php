<?php
$servername = "localhost";
$username = "root";
$dbpassword = "mike";

if (isset($_GET['studid'])) {
    $iid = $_GET['studid'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=usjr", $username, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $conn->prepare("
            SELECT s.*, p.progfullname, c.collfullname, p.progid, c.collid
            FROM students s
            LEFT JOIN programs p ON s.studprogid = p.progid
            LEFT JOIN colleges c ON s.studcollid = c.collid
            WHERE s.studid = ?
        ");
        $sql->execute([$iid]);

        if ($sql->rowCount() > 0) {
            $student = $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=notfound");
            exit();
        }

        $programs = $conn->query("SELECT progid, progfullname FROM programs")->fetchAll(PDO::FETCH_ASSOC);
        $colleges = $conn->query("SELECT collid, collfullname FROM colleges")->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Edit Student</title>
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

        select{
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
            <h1>Edit Student Details</h1>
            <form action="editprocess.php" method="post">
                <label for="id">Student ID</label>
                <input type="text" id="id" name="studid" value="<?php echo htmlspecialchars($student['studid']); ?>" readonly><br>

                <label for="firstname">Firstname</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($student['studfirstname']); ?>"><br>

                <label for="lastname">Lastname</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($student['studlastname']); ?>"><br>

                <label for="midname">Middle Name</label>
                <input type="text" id="midname" name="midname" value="<?php echo htmlspecialchars($student['studmidname']); ?>"><br>

                <label for="program">Program</label>
                <select id="program" name="program">
                    <?php foreach ($programs as $program): ?>
                        <option value="<?php echo $program['progid']; ?>" 
                            <?php echo $program['progid'] == $student['studprogid'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($program['progfullname']); ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>

                <label for="college">College</label>
                <select id="college" name="college">
                    <?php foreach ($colleges as $college): ?>
                        <option value="<?php echo $college['collid']; ?>" 
                            <?php echo $college['collid'] == $student['studcollid'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($college['collfullname']); ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>

                <label for="year">Year</label>
                <select name="year" id="year" required>
                    <option value="1" <?php echo $student['studyear'] == 1 ? 'selected' : ''; ?>>1</option>
                    <option value="2" <?php echo $student['studyear'] == 2 ? 'selected' : ''; ?>>2</option>
                    <option value="3" <?php echo $student['studyear'] == 3 ? 'selected' : ''; ?>>3</option>
                    <option value="4" <?php echo $student['studyear'] == 4 ? 'selected' : ''; ?>>4</option>
                    <option value="5" <?php echo $student['studyear'] == 5 ? 'selected' : ''; ?>>5</option>
                </select>
                <div class="button-container">
                    <button type="submit" name="edit"><strong>Save Changes</strong></button>
                    <button type="button" onclick="window.location.href='home.php'"><strong>Cancel</strong></button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <p>Student not found.</p>
    <?php endif; ?>
</body>
</html>
