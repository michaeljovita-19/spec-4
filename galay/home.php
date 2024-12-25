<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
$servername = "localhost";
$username = "root";  
$dbpassword = "mike";    

$rows = []; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=usjr", $username, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = $conn->prepare("SELECT * FROM students");
    $sql->execute();

    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Masterlist</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 1.5rem;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid black;
            background-color: lightyellow;
        }
        th {
            background-color: lightgreen;
        }
        .actions button {
            margin: 5px;
        }
    </style>
</head>
<body>
    <form action="add.php" method="POST">
        <button type="submit" name="add">Add</button>
    </form>
    <br><br>
    <form action="logout.php" method="POST">
        <button type="submit" name="logout">Log Out</button>
    </form>
    <h1 style="text-align: center;">Student Masterlist</h1>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Firstname</th>
            <th>Middlename</th>
            <th>Lastname</th>
            <th>Department</th>
            <th>Program</th>
            <th>Year</th>
            <th>Edit Student</th>
            <th>Delete Student</th>
        </tr>
        <?php if (count($rows) > 0): ?>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['studid']); ?></td>
                    <td><?php echo htmlspecialchars($row['studfirstname']); ?></td>
                    <td><?php echo htmlspecialchars($row['studlastname']); ?></td>
                    <td><?php echo htmlspecialchars($row['studmidname']); ?></td>
                    <td><?php echo htmlspecialchars($row['studprogid']); ?></td>
                    <td><?php echo htmlspecialchars($row['studcollid']); ?></td>
                    <td><?php echo htmlspecialchars($row['studyear']); ?></td>
                    <td>
                        <a href="edit.php?studid=<?php echo urlencode($row['studid']); ?>">
                            <button class="edit-btn">Edit</button>
                        </a>
                    </td>
                    <td>
                        <a href="delete.php?studid=<?php echo urlencode($row['studid']); ?>">
                            <button class="delete-btn">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">No data available</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
