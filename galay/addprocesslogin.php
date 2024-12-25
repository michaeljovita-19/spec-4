<?php
$servername = "localhost";
$username = "root";
$password = "mike";
$dbname = "students";
$dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = htmlspecialchars(trim($_POST['studentID']));
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $colleges = htmlspecialchars(trim($_POST['colleges']));
    $department = htmlspecialchars(trim($_POST['department']));
    $school = htmlspecialchars(trim($_POST['school']));

    if (empty($studentID) || empty($firstName) || empty($lastName) || empty($colleges) || empty($department) || empty($school)) {
        die("All fields are required.");
    }

    try {
        $stmt = $conn->prepare("INSERT INTO student_info (student_id, first_name, last_name, department, school) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$studentID, $firstName, $lastName, $department, $school]);
        
        echo "Student information added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>