<?php
$servername = "localhost";
$username = "root";  
$dbpassword = "mike";    

if (isset($_POST['edit']) && isset($_POST['studid'])) {
    $iid = $_POST['studid'];
    $firstname = $_POST['firstname'];
    $midname = $_POST['midname'];
    $lastname = $_POST['lastname'];
    $program = $_POST['programs'];
    $college = $_POST['colleges'];
    $year = $_POST['year'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=usjr", $username, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = $conn->prepare("SELECT * FROM students WHERE studid = ?");
        $sql->execute([$iid]);
        
        if ($sql->rowCount() > 0) {
            $sql = $conn->prepare("UPDATE students SET studfirstname = ?, studlastname = ?, studmidname = ?, studprogid = ?, studcollid = ?, studyear = ? WHERE studid = ?");
            $sql->execute([$firstname, $lastname, $midname, $program, $college, $year, $iid]);

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