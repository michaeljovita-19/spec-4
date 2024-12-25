<?php
$servername = "localhost";
$username = "root";  
$dbpassword = "mike";    

    if (isset($_POST['studid'])) {
        $iid = $_POST['studid'];

        try {
            $conn = new PDO("mysql:host=$servername;dbname=usjr", $username, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $conn->prepare("SELECT * FROM students WHERE studid = ?");
            $sql->execute([$iid]);

            if ($sql->rowCount() > 0) {
                $sql = $conn->prepare("DELETE FROM students WHERE studid = ?");
                $sql->execute([$iid]);

                header("Location: home.php");
                exit();
            } else {
                header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=notfound");
                exit();
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
?>
