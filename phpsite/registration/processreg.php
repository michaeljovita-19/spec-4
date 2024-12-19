<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $password = $_POST['pass'];
    $verify_password = $_POST['verify'];

    if ($password !== $verify_password) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=error");
        exit();
    }

    $servername = "localhost";
    $username = "root";  
    $dbpassword = "mike";    

    try {
        $conn = new PDO("mysql:host=$servername;dbname=usjr", $username, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $conn->prepare("SELECT * FROM appusers WHERE name = ?");
        $sql->execute([$name]);
        if ($sql->rowCount() > 0) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=exists");
            exit();
        }
        $sql = $conn->prepare("INSERT INTO appusers (name, password) VALUES (?, ?)");
        $sql->execute([$name, $password]);
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=success");
        
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
