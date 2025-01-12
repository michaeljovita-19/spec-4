<?php
    $id = $_POST['studid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="deleteprocess.php" method="post">
        Are you sure you want to delete this student?
        <input type="hidden" name="studid" value="<?php echo $id; ?>">
        <button type="submit">Confirm</button>
        <a href="home.php"><button type="button">Cancel</button></a>
    </form>
</body>
</html>