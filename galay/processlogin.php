<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "mike";
$dbname = "usjr";


$dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $password = $_POST['password'];


    if (empty($name) || empty($password)) {
        die("Both fields are required.");
    }

    $stmt = $conn->prepare("SELECT password FROM appusers WHERE name = ?");
    $stmt->execute([$name]);

    if ($stmt->rowCount() > 0) {
        $hashed_password = $stmt->fetchColumn();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            header("Location: home.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }
}
$conn = null; 
?>