<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['username'];
    $password = $_POST['password'];
    $verify = $_POST['verify_password'];
 
   
    if ($password !== $verify) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=error");
        exit();
    }

    $dsn = "mysql:host=localhost;dbname=usjr";
    $username = "root";  
    $dbpassword = "mike";    

    try {
        $pdo = new PDO($dsn, $username, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       
        $stmt = $pdo->prepare("SELECT * FROM appusers WHERE name = ?");
        $stmt->execute([$name]);
        if ($stmt->rowCount() > 0) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=exists");
            exit(); 
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO appusers (name, password) VALUES (?, ?)");
        $stmt->execute([$name, $hashed_password]);

        header("Location: login.php" );


    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>