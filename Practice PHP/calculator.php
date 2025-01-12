<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }
        .calculator {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .calculator input, .calculator select, .calculator button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .calculator button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .calculator button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            font-size: 1.2em;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <form action="calculatorprocess.php" method="post">
            <input type="text" name="num1" placeholder="Enter first number" required>
            <input type="text" name="num2" placeholder="Enter second number" required>
            <select name="operator" id="">
                <option value="add">Add</option>
                <option value="sub">Subtract</option>
                <option value="mul">Multiply</option>
                <option value="div">Divide</option>
            </select>
            <button type="submit" name="submit">Calculate</button>
        </form>

        <?php
        if (isset($_GET['answer'])) {
            $answer = htmlspecialchars($_GET['answer']);
            echo "<p class='result'>The answer is: $answer</p>";
        }
        ?>

        <form action="calculator.php" method="get">
            <button type="submit">Refresh</button>
        </form>
    </div>
</body>
</html>