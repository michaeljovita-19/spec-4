<?php
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operator = $_POST['operator'];

    if($operator == 'add'){
        $result = $num1 + $num2;
    } elseif($operator == 'sub'){
        $result = $num1 - $num2;
    } elseif($operator == 'mul'){
        $result = $num1 * $num2;
    } elseif($operator == 'div'){
        $result = $num1 / $num2;
    }

    header("Location: " . $_SERVER['HTTP_REFERER'] . "?answer=$result");
    exit();
?>