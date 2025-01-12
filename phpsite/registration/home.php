<?php
    session_start();
    if ($_SESSION['loggedin'] !== true) {
        header("Location: login.php");
    }

    $servername = "localhost";
    $username = "root";  
    $dbpassword = "mike";    
                
    try {
        $conn = new PDO("mysql:host=$servername;dbname=usjr", $username, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
        $sql = $conn->prepare("SELECT * FROM students");
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);

        $programNames = [];
        $progQuery = $conn->prepare("SELECT progid, progfullname FROM programs");
        $progQuery->execute();
        $progQueryResult = $progQuery->fetchAll(PDO::FETCH_ASSOC);

        foreach ($progQueryResult as $program) {
            $programNames[$program['progid']] = $program['progfullname'];
        };

        $colName = [];
        $colQuery = $conn->prepare("SELECT collid, collshortname FROM colleges");
        $colQuery->execute();
        $colQueryResult = $colQuery->fetchALL(PDO::FETCH_ASSOC);

        foreach($colQueryResult as $college){
            $colName[$college['collid']] = $college['collshortname'];
        };

    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Student Masterlist</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            font-weight: 400;
            color: #333;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2.5rem;
            color: #4A4A4A;
        }

        .header h2 {
            font-size: 1.5rem;
            color: #7D7D7D;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        #cal-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #cal-table th, #cal-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 1rem;
        }

        #cal-table th {
            background-color: #f2f2f2;
            font-weight: 500;
        }

        #cal-table td {
            background-color: #ffffff;
        }

        #cal-table tr:hover {
            background-color: #f9f9f9;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
        }

        .footer button {
            background-color: #ff4c4c;
        }

        .footer button:hover {
            background-color: #e04a4a;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.2rem;
            }

            button {
                width: 100%;
                margin-top: 10px;
            }

            #cal-table th, #cal-table td {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Student Masterlist</h1>
            <h2>Overview of all registered students</h2>
        </div>
        <div class="action-buttons" style="text-align: right; margin-bottom: 20px;">
            <form action="login.php" method="post" style="display: inline;">
                <button type="submit"><h2>Log Out</h2></button>
            </form>
            <form action="add.php" method="post" style="display: inline;">
                <button type="submit" name="add"><h2>Add New Student</h2></button>
            </form>
        </div>
        <table id="cal-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Middle Name</th>
                    <th>Program</th>
                    <th>College</th>
                    <th>Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($rows) > 0): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['studid']); ?></td>
                            <td><?php echo htmlspecialchars($row['studfirstname']); ?></td>
                            <td><?php echo htmlspecialchars($row['studmidname']); ?></td>
                            <td><?php echo htmlspecialchars($row['studlastname']); ?></td>
                            <td><?php echo htmlspecialchars($programNames[$row['studprogid']] ?? 'Unknown Program');?></td>
                            <td><?php echo htmlspecialchars($colName[$row['studcollid']] ?? 'Unknown College'); ?></td>
                            <td><?php echo htmlspecialchars($row['studyear']); ?></td>
                            <td>
                                <a href="delete.php?studid=<?php echo urlencode($row['studid']); ?>">
                                    <button class="delete-btn">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </a>
                                <a href="edit.php?studid=<?php echo urlencode($row['studid']); ?>">
                                    <button>
                                            <i class="fas fa-edit"></i> Edit
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">No data available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
