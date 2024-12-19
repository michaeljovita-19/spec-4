<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $password = $_POST['pass'];

    if (empty($name) || empty($password)) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=empty");
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
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=success");
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=invalid");
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>