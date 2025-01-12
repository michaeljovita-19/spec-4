<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $password = $_POST['pass'];

    $servername = "localhost";
    $username = "root";  
    $dbpassword = "mike";  

    try {
        $conn = new PDO("mysql:host=$servername;dbname=usjr", $username, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $conn->prepare("SELECT * FROM appusers WHERE name = ?");
        $sql->execute([$name]);
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            header("Location: home.php");
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=invalid");
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>