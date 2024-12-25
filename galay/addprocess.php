<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required_fields = ['id', 'firstname', 'lastname', 'middlename', 'colleges', 'programs', 'year'];
    $missing_fields = [];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $missing_fields[] = $field;
        }
    }

    if (!empty($missing_fields)) {
        $missing_fields_str = implode(", ", $missing_fields);
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=error&message=Missing fields: $missing_fields_str");
        exit();
    }

    $student_id = $_POST['id'];
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $midname = htmlspecialchars(trim($_POST['middlename']));
    $college = $_POST['colleges'];
    $program = $_POST['programs'];
    $year = $_POST['year'];

    
    $servername = "localhost";
    $username = "root";  
    $dbname = "usjr";
    $dbpassword = "mike";    

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
       
        $sql = $conn->prepare("SELECT * FROM students WHERE studfirstname = ? AND studlastname = ?");
        $sql->execute([$firstname, $lastname]);
        
        if ($sql->rowCount() > 0) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=exists");
            exit();
        }


        $sql = $conn->prepare("SELECT * FROM students WHERE studid = ?");
        $sql->execute([$student_id]);
        if ($sql->rowCount() > 0) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=error&message=Student ID already exists");
            exit();
        }

        $sql = $conn->prepare("INSERT INTO students (studid, studfirstname, studlastname, studmidname, studprogid, studcollid, studyear) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$student_id, $firstname, $lastname, $midname, $program, $college, $year]);
        
        header("Location: home.php");
        exit();

    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=error&message=Database error");
        exit();
    }
} else {
    header("Location: addprocesslogin.php"); 
    exit();
}
?>