<?php
    session_start();
    if(!isset($_SESSION["humanScore"])){
        $_SESSION["humanScore"] = 0;
    }
    if(!isset($_SESSION["computerScore"])){
        $_SESSION["computerScore"] = 0;
    }

    if(isset($_POST['submet'])){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $input = $_POST['choice'];
            $computer = rand(0, 2);

            if($input == 0){
                $hImage = 'rck-l.gif';
                if($computer == 2){
                    $cImage = 'sciss-r.gif';
                    $_SESSION["humanScore"]++;
                    $hcolor = 'green';
                    $ccolor = 'red'; 
                }else if($computer == 1){
                    $cImage = 'paper-r.gif';
                    $_SESSION["computerScore"]++;
                    $ccolor = 'green'; 
                    $hcolor = 'red';
                }else{
                    $cImage = 'rck-r.gif';
                    $ccolor = 'pink'; 
                    $hcolor = 'pink';
                }
            }else if($input == 1){
                $hImage = 'paper-l.gif';
                if($computer == 0){
                    $cImage = 'rck-r.gif';
                    $_SESSION["humanScore"]++;
                    $hcolor = 'green';
                    $ccolor = 'red'; 
                }else if($computer == 2){
                    $cImage = 'sciss-r.gif';
                    $_SESSION["computerScore"]++;
                    $ccolor = 'green'; 
                    $hcolor = 'red';
                }else{
                    $cImage = 'paper-r.gif';
                    $ccolor = 'pink'; 
                    $hcolor = 'pink';
                }
            }else{
                $hImage = 'sciss-l.gif';
                if($computer == 1){
                    $cImage = 'paper-r.gif';
                    $_SESSION["humanScore"]++;
                    $hcolor = 'green';
                    $ccolor = 'red'; 
                }else if($computer == 0){
                    $cImage = 'rck-r.gif';
                    $_SESSION["computerScore"]++; 
                    $ccolor = 'green'; 
                    $hcolor = 'red';
                }else{
                    $cImage = 'sciss-r.gif';
                    $ccolor = 'pink'; 
                    $hcolor = 'pink';
                }
            }
        }
    }else{
        session_unset();
        session_destroy();
        $_SESSION['humanScore'] = 0;
        $_SESSION['computerScore'] = 0; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        button{
            font-size: 1rem;
            justify-content: center;
        }
        table, th, td{
            border: 2px solid black;
            width: 50%;
            font-size: 2rem;
            text-align: center;
            border-collapse: collapse;
            background-color: pink;
        }
        img{
            height: 20rem;
            width: auto;
        }
    </style>
</head>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        <table style="width: 100%; border: 1px solid black">
            <tr>
                <th colspan= "2">Rock Paper Scissor Game</th>
            </tr>
            <tr>
                <td style="height: 40rem; background-color: <?php echo $hcolor; ?>"><img src="<?php echo $hImage;?>" alt=""></td>
                <td style="background-color: <?php echo $ccolor ?>"><img src="<?php echo $cImage; ?>" alt=""></td>
            </tr>
            <tr>
                <td>Human Player</td>
                <td>Computer Player</td>
            </tr>
            <tr>
                <td colspan= "2" style="text-align: left;">Rock<input type="radio" value="0" name="choice">  Paper<input type="radio" value="1" name="choice">  Scissor<input type="radio" value="2" name="choice"> </td>
            </tr>
            <tr>
                <td colspan= "2" style="text-align: left;">Your Score:<?php echo $_SESSION["humanScore"];?><br>Computer Score:<?php echo $_SESSION["computerScore"];?> </td>
            </tr>
        </table>
        <br>
        <button type="submit" name="submet">Submit</button>
        <button type="submit" name="reset">Reset</button>
    </form>
</body>
</html>