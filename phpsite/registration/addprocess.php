<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['midname'];
    $lastname = $_POST['lastname'];
    $college = $_POST['college'];
    $program = $_POST['programs'];
    $year = $_POST['year'];
}

if(isset($_POST['cancel'])){
    header("Refresh:1; url=home.php");
    exit();
}

if($id == null || $firstname == null || $lastname == null || $middlename == null || $college == null || $program == null || $year == null){
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=invalid");
    exit();
}

$servername = "localhost";
$username = "root";  
$dbpassword = "mike";    

try {
    $conn = new PDO("mysql:host=$servername;dbname=usjr", $username, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = $conn->prepare("SELECT * FROM students WHERE studid = ?");
        $sql->execute([$id]);
        if ($sql->rowCount() > 0){
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=exists");
            exit();
        }
        
        $sql = $conn->prepare("INSERT INTO students (studid, studfirstname, studlastname, studmidname, studprogid, studcollid, studyear) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$id, $firstname, $lastname, $middlename, $program, $college, $year]);
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=success");
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}